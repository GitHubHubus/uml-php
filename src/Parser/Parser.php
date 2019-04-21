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
     * @return NodeInterface
     */
    public static function getClassInformation(string $className): NodeInterface
    {
        $class = new \ReflectionClass($className);

        return NodeFactory::getFactory(NodeInterface::TYPE_CLASS)->create($class);
    }
}
