<?php

namespace OK\Uml\Parser;

use OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface ParserInterface
{
    /**
     * @param string $className
     * @param string $type
     *
     * @return NodeInterface|null
     */
    public static function getClassMetadata(string $className, string $type): ?NodeInterface;
}
