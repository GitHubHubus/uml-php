<?php

namespace OK\Uml\Parser;

use OK\Uml\Entity\NodeInterface;
use OK\Uml\Parser\Factory\NodeFactory;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Parser implements ParserInterface
{
    /**
     * @param string $className
     * @param string $type
     *
     * @return NodeInterface|null
     */
    public static function getClassMetadata(string $className, string $type): ?NodeInterface
    {
        try {
            $class = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            return null;
        }

        return NodeFactory::getFactory($type)->create($class);
    }
}
