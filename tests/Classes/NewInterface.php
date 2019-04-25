<?php

namespace Tests\Classes;

interface NewInterface
{
    const TYPE_CLASS = 'class';
    const TYPE_INTERFACE = 'interface';
    const TYPE_TRAIT = 'trait';
    const TYPE_CONSTANT = 'constant';
    const TYPE_ARGUMENT = 'argument';
    const TYPE_METHOD = 'method';
    const TYPE_PROPERTY = 'property';

    const CLASS_TYPES = [
        T_CLASS => self::TYPE_CLASS,
        T_TRAIT => self::TYPE_TRAIT,
        T_INTERFACE => self::TYPE_INTERFACE
    ];
    
    /**
     * @return string
     */
    public static function getNodeType(): string;
}
