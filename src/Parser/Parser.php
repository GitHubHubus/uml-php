<?php

namespace OK\Uml\Parser;

use OK\Uml\Entity\{ArgumentNode, ClassNode, ConstantNode, InterfaceNode, MethodNode, PropertyNode, TraitNode};

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Parser {

    public static function getClassInformation(string $class)
    {
        $classReflection = new \ReflectionClass($class);

        $classNode = new ClassNode($classReflection->getName());
        $classNode->extend = $classReflection->getParentClass()->getName();
        $classNode->modifiers = $classReflection->getModifiers();
        
        /**
         * @var ReflectionMethod $method
         */
        foreach ($classReflection->getMethods() as $method) {
            $classNode->addMethod(self::createMethod($method));
        }
        
        /**
         * @var ReflectionPrperty $property
         */
        foreach ($classReflection->getProperties() as $property) {
            $classNode->addProperty(self::createProperty($property));
        }
        
        /**
         * @var array $property
         */
        foreach ($classReflection->getStaticProperties() as $property) {
            $classNode->addProperty(self::createStaticProperty($property));
        }
        
        /**
         * @var array $constant
         */
        foreach ($classReflection->getConstants() as $constant) {
            $classNode->addConstant(self::createStaticProperty($constant));
        }
        
        /**
         * @var ReflectionInterface $interface
         */
        foreach ($classReflection->getInterfaces() as $interface) {
            $classNode->addInterface(self::createInterface($interface));
        }
        
        /**
         * @var ReflectionInterface $interface
         */
        foreach ($classReflection->getTraits() as $trait) {
            $classNode->addTrait(self::createTrait($trait));
        }
    }
    
    public static function createMethod(ReflectionMethod $method)
    {
        $methodNode = new MethodNode();
            
        $methodNode->name = $method->getName();
        $methodNode->type = $method->getReturnType();
                
         return $methodNode;
    }
    
    public static function createProperty(ReflectionProperty $property)
    {
        $propertyNode = new PropertyNode();
            
        $propertyNode->name = $property->getName();
        $propertyNode->type = $property->getReturnType();
                
         return $propertyNode;
    }
    
    public static function createStaticProperty(array $property)
    {
        $propertyNode = new PropertyNode();
            
        $propertyNode->name = $property['name'];
        $propertyNode->type = $property['type'];
                
         return $propertyNode;
    }
    
    public static function createInterface(ReflectionInterface $interface)
    {
        $interfaceNode = new InterfaceNode();
            
        $interfaceNode->name = $interface->getName();
                
         return $interfaceNode;
    }
    
    public static function createTrait(ReflectionTrait $trait)
    {
        $traitNode = new TraitNode();
            
        $traitNode->name = $trait->getName();
                
         return $traitNode;
    }
}
