<?php

namespace OK\Uml\File;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class File
{
    /**
     * @param string $directory
     * @return array
     */
    public static function get(string $directory): array
    {
        $objects = @scandir($directory);
        
        if (!$objects) {
            $error = error_get_last();
            throw new \Exception($error['message'] . '[' . $directory . ']');
        }
        
        $files = [];

        foreach ($objects as $object) {
            $name = $directory . '/' . $object;

            if (self::isDirectory($name)) {
                $data = self::get($name);
                $files = array_merge($files, $data);
            } else if (self::isPhpFile($name)) {
                $files[] = $name;
            }
        }

        return $files;
    }
    
    public static function getClassName(string $file)
    {
        $fp = fopen($file, 'r');
        $class = $namespace = $buffer = '';
        $i = 0;

        while (!$class) {
            if (feof($fp)) {
                break;
            }

            $buffer .= fread($fp, 512);
            $tokens = token_get_all($buffer);

            if (strpos($buffer, '{') === false) {
                continue;
            }

            for (;$i<count($tokens);$i++) {
                if ($tokens[$i][0] === T_NAMESPACE) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[$j][0] === T_STRING) {
                             $namespace .= '\\'.$tokens[$j][1];
                        } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                             break;
                        }
                    }
                }

                if ($tokens[$i][0] === T_CLASS || $tokens[$i][0] === T_TRAIT || $tokens[$i][0] === T_INTERFACE) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[$j] === '{') {
                            $class = $tokens[$i+2][1];
                        }
                    }
                }
            }
        }
        
        return $namespace . '\\' . $class;
    }
    
    /**
     * 
     * @param string $name
     * @return type
     */
    private static function isDirectory(string $name)
    {
        return (is_dir($name) && substr($name, -1) !== '.');
    }
    
    /**
     * @param string $name
     * @return bool
     */
    private static function isPhpFile(string $name): bool
    {
        return stripos($name, '.php') !== false;
    }
}
