<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\MethodNode;
use OK\Uml\Entity\NodeInterface;
use OK\Uml\Parser\DocCommentParser;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class MethodFactory implements NodeFactoryInterface
{
    use ModifiersTrait;

    /**
     * @param \ReflectionMethod $object
     *
     * @return MethodNode
     * @throws Exception\NodeFactoryException
     */
    public function create($object): NodeInterface
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
            $argumentFactory = NodeFactory::getFactory(NodeInterface::TYPE_ARGUMENT);
            foreach ($object->getParameters() as $param) {
                $methodNode->addArgument($argumentFactory->create($param, $args));
            }
        }

        $methodNode->setModifiers(self::getModifiers($object));

        return $methodNode;
    }
}
