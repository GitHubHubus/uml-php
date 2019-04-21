<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\MethodNode;
use OK\Uml\Parser\DocCommentParser;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class MethodFactory implements NodeFactoryInterface
{
    use ModifiersTrait;

    /**
     * @param \ReflectionMethod $object
     * @return MethodNode
     */
    public function create($object)
    {
        $methodNode = new MethodNode();
        $methodNode->name = $object->getName();
        
        $comment = $object->getDocComment();
        $args = [];

        if ($comment) {
            $args = DocCommentParser::getArguments($comment);
            $methodNode->type = DocCommentParser::getReturnType($comment);
        }

        if ($object->getNumberOfParameters() > 0) {
            $argumentFactory = NodeFactory::getFactory(NodeFactory::TYPE_ARGUMENT);
            foreach ($object->getParameters() as $param) {
                $methodNode->addArgument($argumentFactory->create($param, $args));
            }
        }

        $methodNode->setModifiers(self::getModifiers($object));
        
        return $methodNode;
    }
}
