<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Parser\Factory\NodeFactoryInterface;
use OK\Uml\Parser\Factory\Exception\NodeFactoryException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class NodeFactory
{
    /**
     * @param string $type
     *
     * @return NodeFactoryInterface
     * @throws NodeFactoryException
     */
    public static function getFactory(string $type): NodeFactoryInterface
    {
        $classFactory = __NAMESPACE__ . '\\' . ucfirst($type) . 'Factory';
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new \NodeFactoryException(printf('Factory %s doesn\'t exist', $classFactory));
        }
    }
}
