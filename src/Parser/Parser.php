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
class Parser
{
    public static $modifiers = [
        \ReflectionMethod::IS_ABSTRACT => 'abstract',
        \ReflectionMethod::IS_FINAL => 'final',
        \ReflectionMethod::IS_PRIVATE => 'private',
        \ReflectionMethod::IS_PROTECTED => 'protected',
        \ReflectionMethod::IS_PUBLIC => 'public',
        \ReflectionMethod::IS_STATIC => 'static'
    ];
    
    public static function getClassInformation(string $class)
    {
        $classReflection = new \ReflectionClass($class);

        $classNode = new ClassNode($classReflection->getName());
        $classNode->extend = $classReflection->getParentClass() ? $classReflection->getParentClass()->getName() : null;
        
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
        //    $classNode->addProperty(self::createProperty($property));
        }
        
        /**
         * @var array $property
         */
        foreach ($classReflection->getStaticProperties() as $property) {
          //  $classNode->addProperty(self::createStaticProperty($property));
        }
        
        /**
         * @var array $constant
         */
        foreach ($classReflection->getConstants() as $constant) {
            //$classNode->addConstant(self::createConstant($constant));
        }
        
        /**
         * @var ReflectionInterface $interface
         */
        foreach ($classReflection->getInterfaces() as $interface) {
            //$classNode->addInterface(self::createInterface($interface));
        }
        
        /**
         * @var ReflectionInterface $interface
         */
        foreach ($classReflection->getTraits() as $trait) {
            //$classNode->addTrait(self::createTrait($trait));
        }
        
        return $classNode;
    }
    
    public static function createMethod(\ReflectionMethod $method)
    {
        $methodNode = new MethodNode();
        $methodNode->name = $method->getName();
        
        $comment = $method->getDocComment();
        $args = [];

        if ($comment) {
            $args = DocCommentParser::getArguments($comment);
            $methodNode->type = DocCommentParser::getReturnType($comment);
        }

        if ($method->getNumberOfParameters() > 0) {
            foreach ($method->getParameters() as $param) {
                $methodNode->addArgument(self::createArgument($param, $args));
            }
        }
        var_dump($method->getModifiers());die;
        foreach ($method->getModifiers() as $code) {
            $methodNode->addModifier(self::$modifiers[$code]);
        }

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
    
    public static function createArgument(\ReflectionParameter $param, array $args = [])
    {
        $argumentNode = new ArgumentNode();
        $argumentNode->name = $param->getName();

        if ($args) {
            if (!empty($args) && isset($args[$param->getPosition()])) {
                $argumentNode->type = $args[$param->getPosition()][0];
            }
        } else if ($param->isDefaultValueAvailable()) {
            $argumentNode->type = gettype($param->getDefaultValue());
        } else if ($param->isArray()) {
            $argumentNode->type = 'array';
        }

        return $argumentNode;
    }
}
