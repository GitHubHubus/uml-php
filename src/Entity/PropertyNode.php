<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class PropertyNode implements NodeInterface {
    use CommonNode;

    public $type;
    
    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_PROPERTY;
    }
}
