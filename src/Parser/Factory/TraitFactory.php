<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\NodeInterface;
use OK\Uml\Entity\TraitNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class TraitFactory implements NodeFactoryInterface
{
    /**
     * @param \ReflectionClass $trait
     * @return TraitNode
     */
    public function create($trait): NodeInterface
    {
        $traitNode = new TraitNode();
        $traitNode->name = $trait->getName();

        /**
         * @var \ReflectionMethod $method
         */
        foreach ($trait->getMethods() as $method) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_METHOD)->create($method);
            $traitNode->addMethod($node);
        }
        
        /**
         * @var \ReflectionProperty $property
         */
        foreach ($trait->getProperties() as $property) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_PROPERTY)->create($property);
            $traitNode->addProperty($node);
        }

        /**
         * @var \ReflectionClass $class
         */
        foreach ($trait->getTraits() as $class) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_TRAIT)->create($class);
            $traitNode->addTrait($node);
        }
        
        return $traitNode;
    }
}
