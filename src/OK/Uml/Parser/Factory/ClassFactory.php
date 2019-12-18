<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\ClassNode;
use OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClassFactory implements NodeFactoryInterface
{
    /**
     * @param \ReflectionClass $class
     *
     * @return ClassNode
     */
    public function create($class): NodeInterface
    {
        $classNode = new ClassNode($class->getName());
        $classNode->extend = $class->getParentClass() ? $class->getParentClass()->getName() : null;
        
        /**
         * @var \ReflectionMethod $method
         */
        foreach ($class->getMethods() as $method) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_METHOD)->create($method);
            $classNode->addMethod($node);
        }
        
        /**
         * @var \ReflectionProperty $property
         */
        foreach ($class->getProperties() as $property) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_PROPERTY)->create($property);
            $classNode->addProperty($node);
        }

        foreach ($class->getConstants() as $key => $value) {
            $node = NodeFactory::getFactory(NodeInterface::TYPE_CONSTANT)->create([$key, $value]);
            $classNode->addConstant($node);
        }
        
        /**
         * @var \ReflectionInterface $interface
         */
        foreach ($class->getInterfaces() as $interface) {
            $classNode->addInterface($interface->getName());
        }
        
        /**
         * @var \ReflectionClass $trait
         */
        foreach ($class->getTraits() as $trait) {
            $classNode->addTrait($trait->getName());
        }
        
        return $classNode;
    }
}
