<?php

namespace OK\Uml\Parser\Factory;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class NodeFactory
{
    const TYPE_CLASS = 'class';
    const TYPE_INTERFACE = 'interface';
    const TYPE_TRAIT = 'trait';
    const TYPE_CONSTANT = 'constant';
    const TYPE_ARGUMENT = 'argument';
    const TYPE_METHOD = 'method';
    const TYPE_PROPERTY = 'property';
  
    public static function getFactory(string $type)
    {
        $classFactory = __NAMESPACE__ . '\\' . ucfirst($type) . 'Factory';
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new \Exception(printf('Factory %s doesn\'t exist', $classFactory));
        }
    }
}
