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
    private static $attributes = [
        'isStatic' => \ReflectionMethod::IS_STATIC, 
        'isFinal' => \ReflectionMethod::IS_FINAL, 
        'isAbstract' => \ReflectionMethod::IS_ABSTRACT
    ];
    
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
         * @var ReflectionProperty $property
         */
        foreach ($classReflection->getProperties() as $property) {
            $classNode->addProperty(self::createProperty($property));
        }
        
        /**
         * @var array $constant
         */
        foreach ($classReflection->getConstants() as $key => $value) {
            $classNode->addConstant(self::createConstant($key, $value));
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

        $methodNode->setModifiers(self::getModifiers($method));
        
        return $methodNode;
    }
    
    public static function createProperty(\ReflectionProperty $property)
    {
        $propertyNode = new PropertyNode();
        $propertyNode->name = $property->getName();
        $propertyNode->setModifiers(self::getModifiers($property));

        if ($property->getDocComment()) {
            $propertyNode->type = DocCommentParser::getVarType($property->getDocComment());
        }

        return $propertyNode;
    }
    
    public static function createConstant(string $name, $value)
    {
        $constantNode = new ConstantNode();
        $constantNode->name = $name;
        $constantNode->type = gettype($value);

        return $constantNode;
    }
    
    public static function createInterface(\ReflectionClass $interface)
    {
        $interfaceNode = new InterfaceNode();
        $interfaceNode->name = $interface->getName();
        $interfaceNode->extend = $interface->getParentClass() ? $interface->getParentClass()->getName() : null; //return null why?
        /**
         * @var ReflectionMethod $method
         */
        foreach ($interface->getMethods() as $method) {
            $interfaceNode->addMethod(self::createMethod($method));
        }

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
    
    private static function getModifiers($object): array
    {
        $code = $object->getModifiers();
        $modifiers = [];

        foreach (self::$attributes as $function => $key) {
            if (method_exists($object, $function) && $object->$function()) {
                $code -= $key;
                $modifiers[] = self::$modifiers[$key];
            }
        }
        
        return $modifiers;
    }
}
