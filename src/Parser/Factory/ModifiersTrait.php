<?php

namespace OK\Uml\Parser\Factory;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
trait ModifiersTrait
{
    /**
     * @var array
     */
    private static $attributes = [
        'isStatic' => \ReflectionMethod::IS_STATIC, 
        'isFinal' => \ReflectionMethod::IS_FINAL, 
        'isAbstract' => \ReflectionMethod::IS_ABSTRACT
    ];

    /**
     * @var array
     */
    public static $modifiers = [
        \ReflectionMethod::IS_ABSTRACT => 'abstract',
        \ReflectionMethod::IS_FINAL => 'final',
        \ReflectionMethod::IS_PRIVATE => 'private',
        \ReflectionMethod::IS_PROTECTED => 'protected',
        \ReflectionMethod::IS_PUBLIC => 'public',
        \ReflectionMethod::IS_STATIC => 'static'
    ];

    /**
     * @param \ReflectionProperty|\ReflectionMethod $object
     *
     * @return array
     */
    private static function getModifiers($object): array
    {
        $code = $object->getModifiers();
        $modifiers = [];

        foreach (self::$attributes as $function => $key) {
            if (method_exists($object, $function) && $object->$function()) {
                $code -= $key;
                $modifiers[] = self::$modifiers[$key];
            }
        }

        $modifiers[] = self::$modifiers[$code];

        return $modifiers;
    }
}
