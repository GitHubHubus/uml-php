<?php

namespace OK\Uml\Parser\Factory;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
trait MethodTrait
{
    public static $magicMethods = [
        '__destruct',
        '__call',
        '__callStatic',
        '__get',
        '__set',
        '__isset',
        '__unset',
        '__sleep',
        '__wakeup',
        '__toString',
        '__invoke',
        '__set_state',
        '__clone',
        '__autoload'
    ];

    /**
     * @param \ReflectionMethod $method
     * @return bool
     */
    public function isNotExtended(\ReflectionMethod $method): bool
    {
        $isNotExtended = true;
        if (!in_array($method->name, self::$magicMethods)) {
            $isNotExtended = false;
            try {
                $method->getPrototype();
            } catch (\ReflectionException $ex) {
                $isNotExtended = true;
            }
        }

        return $isNotExtended;
    }
}
