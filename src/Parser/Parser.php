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
     * @return NodeInterface|null
     */
    public static function getClassInformation(string $className): ?NodeInterface
    {
        try {
            $class = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            return null;
        }

        return NodeFactory::getFactory(NodeInterface::TYPE_CLASS)->create($class);
    }
}
