<?php

namespace OK\Uml\Entity;

use OK\Uml\Entity\CommonNode;
use OK\Uml\Entity\MethodNode;
/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClassNode implements NodeInterface {
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
    
    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
    
    /**
     * @param MethodNode $method
     */
    public function addMethod(MethodNode $method)
    {
        $this->methods[] = $method;
    }
    
    public function addProperty(PropertyNode $property)
    {
        $this->properties[] = $property;
    }
    
    public function addConstant(ConstantNode $constant)
    {
        $this->constants[] = $constant;
    }
    
    public function addInterface(InterfaceNode $interface)
    {
        $this->interfaces[] = $interface;
    }
    
    public function addTrait(TraitNode $trait)
    {
        $this->traits[] = $trait;
    }
    
    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_CLASS;
    }
}
