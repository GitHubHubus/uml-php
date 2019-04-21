<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface NodeInterface
{
    const TYPE_CLASS = 'class';
    const TYPE_INTERFACE = 'interface';
    const TYPE_TRAIT = 'trait';
    const TYPE_CONSTANT = 'constant';
    const TYPE_ARGUMENT = 'argument';
    const TYPE_METHOD = 'method';
    const TYPE_PROPERTY = 'property';

    /**
     * @return string
     */
    public static function getNodeType(): string;
}
