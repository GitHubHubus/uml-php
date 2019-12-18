<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\NodeInterface;
use OK\Uml\Entity\ArgumentNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ArgumentFactory implements NodeFactoryInterface
{
    /**
     * @param \ReflectionParameter $param
     * @param array $args
     *
     * @return ArgumentNode
     * @throws \ReflectionException
     */
    public function create($param, array $args = []): NodeInterface
    {
        $argumentNode = new ArgumentNode();
        $argumentNode->name = $param->getName();

        if (!empty($args) && isset($args[$param->getPosition()])) {
            $argumentNode->type = $args[$param->getPosition()][0];
        } else if ($param->isDefaultValueAvailable()) {
            $argumentNode->type = gettype($param->getDefaultValue());
        } else if ($param->isArray()) {
            $argumentNode->type = 'array';
        }

        return $argumentNode;
    }
}
