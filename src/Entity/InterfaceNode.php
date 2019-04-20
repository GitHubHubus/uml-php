<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class InterfaceNode {
    use CommonNode;

    public $methods = [];
    public $extend;
    
    public function addMethod(MethodNode $method)
    {
        $this->methods[] = $method;
    }
}
