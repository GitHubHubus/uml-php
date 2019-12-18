<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\InterfaceNode;
use OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class InterfaceFactory implements NodeFactoryInterface
{
    /**
     * @param \ReflectionClass $interface
     *
     * @return InterfaceNode
     * @throws Exception\NodeFactoryException
     */
    public function create($interface): NodeInterface
    {
        $interfaceNode = new InterfaceNode();
        $interfaceNode->name = $interface->getName();
        $interfaceNode->extend = $interface->getParentClass() ? $interface->getParentClass()->getName() : null; //return null why?

        /**
         * @var ReflectionMethod $method
         */
        foreach ($interface->getMethods() as $method) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_METHOD)->create($method);
            $interfaceNode->addMethod($node);
        }

        return $interfaceNode;
    }
}
