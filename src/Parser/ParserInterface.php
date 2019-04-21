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
     * @return NodeInterface|null
     */
    public static function getClassInformation(string $className): ?NodeInterface;
}
