<?php

namespace OK\Uml\Parser;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class DocCommentParser
{
    /**
     * @param string $comment
     *
     * @return string|null
     */
    public static function getReturnType(string $comment): ?string
    {
        preg_match('/@return[\s]+([A-Za-z_0-9-]+)\n/', $comment, $matches);
        
        return $matches[1] ?? null;
    }
    
    /**
     * @param string $comment
     *
     * @return string|null
     */
    public static function getArguments(string $comment): ?array
    {
        preg_match_all('/@param[\s]+[A-Za-z$0-9_\-\s]+\n/', $comment, $matches);

        if (empty($matches)) {
            return null;
        }
        
        $arguments = [];
        foreach (reset($matches) as $key => $match) {
            $data = preg_split('/\s+/', trim($match));
            array_shift($data);

            if (count($data) === 2) {
                $arguments[] = stristr($data[1], '$') ? $data : array_reverse($data);
            } else if (count($data) === 1) {
                $arguments[] = stristr($data[0], '$') ? [null, $data[0]] : [$data[0], null];
            }
        }
        
        return $arguments;
    }
}
