<?php

namespace OK\Uml\Parser;

use OK\Uml\Entity\ArgumentNode;
use OK\Uml\Entity\ClassNode;
use OK\Uml\Entity\ConstantNode;
use OK\Uml\Entity\InterfaceNode;
use OK\Uml\Entity\MethodNode;
use OK\Uml\Entity\PropertyNode;
use OK\Uml\Entity\TraitNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Parser {

    public static function getClassInformation(string $class)
    {
        $classReflection = new \ReflectionClass($class);

        $classNode = new ClassNode($classReflection->getName());
        $classNode->extend = $classReflection->getParentClass() ? $classReflection->getParentClass()->getName() : null;
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
            $classNode->addConstant(self::createConstant($constant));
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
        
        return $classNode;
    }
    
    public static function createMethod(\ReflectionMethod $method)
    {
        $methodNode = new MethodNode();
            
        $methodNode->name = $method->getName();
        $methodNode->type = $method->getReturnType();
                
         return $methodNode;
    }
    
    public static function createProperty(\ReflectionProperty $property)
    {
        $propertyNode = new PropertyNode();
            
        $propertyNode->name = $property->getName();
        
        if ($property->getDocComment()) {
            $propertyNode->type = $property->getDocComment();
        }
                
        return $propertyNode;
    }
    
    public static function createStaticProperty(array $property)
    {
        $propertyNode = new PropertyNode();
            
        $propertyNode->name = $property['name'];
        $propertyNode->type = $property['type'];
                
         return $propertyNode;
    }
    
    public static function createConstant(array $property)
    {
        $propertyNode = new ConstantNode();
            
        $propertyNode->name = $property['name'];
                
         return $propertyNode;
    }
    
    public static function createInterface(\ReflectionInterface $interface)
    {
        $interfaceNode = new InterfaceNode();
            
        $interfaceNode->name = $interface->getName();
                
        return $interfaceNode;
    }
    
    public static function createTrait(\ReflectionClass $trait)
    {
        $traitNode = new TraitNode();
            
        $traitNode->name = $trait->getName();
                
         return $traitNode;
    }
}
