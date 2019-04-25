<?php

namespace OK\Uml\Entity;

use OK\Uml\Entity\CommonNode;
use OK\Uml\Entity\ConstantNode;
use OK\Uml\Entity\MethodNode;
use OK\Uml\Entity\PropertyNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClassNode implements NodeInterface
{
    use CommonNode;

    public $methods = [];
    public $properties = [];
    public $constants = [];
    public $interfaces = [];
    public $traits = [];
    public $extend;

    /**
     * @param string|null $name
     */
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

    /**
     * @param PropertyNode $property
     */
    public function addProperty(PropertyNode $property)
    {
        $this->properties[] = $property;
    }

    /**
     * @param ConstantNode $constant
     */
    public function addConstant(ConstantNode $constant)
    {
        $this->constants[] = $constant;
    }

    /**
     * @param string $interface
     */
    public function addInterface(string $interface)
    {
        $this->interfaces[] = $interface;
    }

    /**
     * @param string $trait
     */
    public function addTrait(string $trait)
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
