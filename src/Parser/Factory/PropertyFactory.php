<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\NodeInterface;
use OK\Uml\Entity\PropertyNode;
use OK\Uml\Parser\DocCommentParser;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class PropertyFactory implements NodeFactoryInterface
{
    use ModifiersTrait;

    /**
     * @param \ReflectionProperty $object
     * @return PropertyNode
     */
    public function create($object): NodeInterface
    {
        $propertyNode = new PropertyNode();
        $propertyNode->name = $object->getName();
        $propertyNode->setModifiers(self::getModifiers($object));

        if ($object->getDocComment()) {
            $propertyNode->type = DocCommentParser::getVarType($object->getDocComment());
        }

        return $propertyNode;
    }
}
