<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\InterfaceNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class InterfaceFactory implements NodeFactoryInterface
{
    /**
     * @param \ReflectionClass $interface
     * @return InterfaceNode
     */
    public function create($interface)
    {
        $interfaceNode = new InterfaceNode();
        $interfaceNode->name = $interface->getName();
        $interfaceNode->extend = $interface->getParentClass() ? $interface->getParentClass()->getName() : null; //return null why?
        /**
         * @var ReflectionMethod $method
         */
        foreach ($interface->getMethods() as $method) {
            $node = NodeFactory::getFactory(NodeFactory::TYPE_METHOD)->create($method);
            $interfaceNode->addMethod($node);
        }

        return $interfaceNode;
    }
}
