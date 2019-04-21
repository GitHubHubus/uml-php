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
    
    private static $types = [
        self::TYPE_CLASS,
        self::TYPE_INTERFACE,
        self::TYPE_TRAIT,
        self::TYPE_CONSTANT,
        self::TYPE_ARGUMENT,
        self::TYPE_METHOD,
        self::TYPE_PROPERTY,
    ];
    
    public static function getFactory(string $type)
    {
        if (in_array($type)) {
            $factory = ucfirst($type) . 'Factory';
            return new $factory();
        } else {
            throw new \Exception(printf('Factory %s doesn\'t exist', $type));
        }
    }
}
