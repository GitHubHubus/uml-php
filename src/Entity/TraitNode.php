<?php

namespace OK\Uml\Entity;

use OK\Uml\Entity\PropertyNode;
use OK\Uml\Entity\TraitNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class TraitNode implements NodeInterface
{
    use CommonNode;

    /**
     * @var array
     */
    private $traits = [];

    /**
     * @var array
     */
    private $methods = [];

    /**
     * @var array
     */
    private $properties = [];

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return array
     */
    public function getTraits(): array
    {
        return $this->traits;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
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
     * @param TraitNode $trait
     */
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
