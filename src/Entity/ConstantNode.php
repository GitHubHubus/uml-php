<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ConstantNode implements NodeInterface
{
    use CommonNode;

    /**
     * @var tring|null
     */
    public $type = null;

    /**
     * @var mixed
     */
    public $value = null;

    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_CONSTANT;
    }
}
