<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class TraitNode implements NodeInterface {
    use CommonNode;

    private $traits = [];
    private $methods = [];
    private $properties = [];

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

    public function addTrait(TraitNode $trait)
    {
        $this->traits[] = $trait;
    }
    
    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_TRAIT;
    }
}
