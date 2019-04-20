<?php

namespace OK\Uml\Entity;

use OK\Uml\Entity\CommonNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClassNode {
    use CommonNode;

    public $methods = [];
    public $properties = [];
    public $constants = [];
    public $implements = [];
    public $traits = [];
    public $extend;
    
    public function __construct(string $name = null)
    {
        $this->name = $name;
    }
    
    public function addMethod(MethodNode $method)
    {
        $this->methods[] = $method;
    }
    
    public function addProperty(PropertyNode $property)
    {
        $this->property[] = $property;
    }
    
    public function addConstant(ConstantNode $constant)
    {
        $this->constant[] = $constant;
    }
    
    public function addInterface(InterfaceNode $interface)
    {
        $this->interface[] = $interface;
    }
    
    public function addTrait(TraitNode $trait)
    {
        $this->trait[] = $trait;
    }
}
