<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ArgumentNode implements NodeInterface
{
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var tring|null
     */
    public $type = null;

    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_ARGUMENT;
    }
}
