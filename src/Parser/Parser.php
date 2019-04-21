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
            $classNode->addMethod(self::createMethod($method));
        }
        
        /**
         * @var ReflectionProperty $property
         */
        foreach ($classReflection->getProperties() as $property) {
            $node = NodeFactory::getFactory(NodeFactory::TYPE_PROPERTY)->create($property);
            $classNode->addProperty($node);
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
    
    
}
