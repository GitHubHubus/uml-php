<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class InterfaceNode implements NodeInterface {
    use CommonNode;

    public $methods = [];
    public $extend;
    
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
