<?php

namespace OK\Uml\Parser;

use OK\Uml\Entity\ArgumentNode;
use OK\Uml\Entity\ClassNode;
use OK\Uml\Entity\ConstantNode;
use OK\Uml\Entity\InterfaceNode;
use OK\Uml\Entity\MethodNode;
use OK\Uml\Entity\TraitNode;
use OK\Uml\Parser\Factory\NodeFactory;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Parser
{
    
    
    public static function getClassInformation(string $class)
    {
        $classReflection = new \ReflectionClass($class);

        $classNode = new ClassNode($classReflection->getName());
        $classNode->extend = $classReflection->getParentClass() ? $classReflection->getParentClass()->getName() : null;
        
        /**
         * @var ReflectionMethod $method
         */
        foreach ($classReflection->getMethods() as $method) {
            $node = NodeFactory::getFactory(NodeFactory::TYPE_METHOD)->create($method);
            $classNode->addMethod($node);
        }
        
        /**
         * @var ReflectionProperty $property
         */
        foreach ($classReflection->getProperties() as $property) {
            $node = NodeFactory::getFactory(NodeFactory::TYPE_PROPERTY)->create($property);
            $classNode->addProperty($node);
        }

        foreach ($classReflection->getConstants() as $key => $value) {
            $node = NodeFactory::getFactory(NodeFactory::TYPE_CONSTANT)->create([$key, $value]);
            $classNode->addConstant($node);
        }
        
        /**
         * @var ReflectionInterface $interface
         */
        foreach ($classReflection->getInterfaces() as $interface) {
            $node = NodeFactory::getFactory(NodeFactory::TYPE_INTERFACE)->create($interface);
            $classNode->addInterface($node);
        }
        
        /**
         * @var ReflectionInterface $interface
         */
        foreach ($classReflection->getTraits() as $trait) {
            //$classNode->addTrait(self::createTrait($trait));
        }
        
        return $classNode;
    }

    public static function createTrait(\ReflectionClass $trait)
    {
        $traitNode = new TraitNode();
        $traitNode->name = $trait->getName();
                
        return $traitNode;
    }
}
