<?php

namespace OK\Uml\Entity;

use \OK\Uml\Entity\MethodNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class InterfaceNode implements NodeInterface
{
    use CommonNode;

    /**
     * @var array
     */
    public $methods = [];

    /**
     * @var string
     */
    public $extend;

    /**
     * @param MethodNode $method
     */
    public function addMethod(MethodNode $method)
    {
        $this->methods[] = $method;
    }

    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_INTERFACE;
    }
}
