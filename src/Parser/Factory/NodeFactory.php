<?php

namespace OK\Uml\Parser\Factory;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class NodeFactory
{
    public static function getFactory(string $type): NodeFactoryInterface
    {
        $classFactory = __NAMESPACE__ . '\\' . ucfirst($type) . 'Factory';
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new \Exception(printf('Factory %s doesn\'t exist', $classFactory));
        }
    }
}
