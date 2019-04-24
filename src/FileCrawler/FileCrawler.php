<?php

namespace OK\Uml\FileCrawler;

use OK\Uml\FileCrawler\Exception\FileCrawlerException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class FileCrawler
{
    /**
     * @param string $directory
     *
     * @return array
     * @throws FileCrawlerException
     */
    public static function get(string $directory): array
    {
        $objects = @scandir($directory);
        
        if (!$objects) {
            $error = error_get_last();
            throw new FileCrawlerException($error['message'] . '[' . $directory . ']');
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

    /**
     * @param string $file
     *
     * @return array
     * @throws FileCrawlerException
     */
    public static function getClassInfo(string $file): array
    {
        $fp = fopen($file, 'r');
        $class = $namespace = $buffer = '';
        $type = null;
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

            for (;$i < count($tokens); $i++) {
                $token = $tokens[$i][0];

                if ($token === T_NAMESPACE) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[$j][0] === T_STRING) {
                             $namespace .= '\\'.$tokens[$j][1];
                        } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                             break;
                        }
                    }
                }

                if (in_array($token, [T_CLASS, T_TRAIT, T_INTERFACE])) {
                    $type = $token;
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[$j] === '{') {
                            $class = $tokens[$i+2][1];
                        }
                    }
                }
            }
        }

        if ($type === null) {
            throw new FileCrawlerException('Type of class is undefined');
        }

        return [$namespace . '\\' . $class, $type];
    }
    
    /**
     * @param string $name
     *
     * @return bool
     */
    private static function isDirectory(string $name): bool
    {
        return (is_dir($name) && substr($name, -1) !== '.');
    }
    
    /**
     * @param string $name
     *
     * @return bool
     */
    private static function isPhpFile(string $name): bool
    {
        return stripos($name, '.php') !== false;
    }
}
