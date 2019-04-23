<?php

namespace OK\Uml\Serializer;

use OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class JsonSerializer implements SerializerInterface
{
    /**
     * @param NodeInterface[] $nodes
     *
     * @return string
     */
    public function serialize(array $nodes): string
    {
        $result = [];

        foreach ($nodes as $node) {
            $result[$node->getNodeType()][] = $this->process($node);
        }

        return json_encode($result);
    }

    private function process(NodeInterface $node)
    {
        $class = new \ReflectionClass(get_class($node));
        $data = [];

        /**
         * @var \ReflectionProperty $property
         */
        foreach ($class->getProperties() as $property) {
            $value = $this->access($node, $property);
            $data[$property->getName()] = $this->modify($value);
        }

        return $data;
    }
    
    private function access($node, $property)
    {
        $value = null;
        $propertyName = $property->getName();

        if ($property->isPublic()) {
            $value = $node->$propertyName;
        } else {
            $methodName = 'get' . ucfirst($propertyName);

            if (method_exists($node, $methodName)) {
                $value = $node->$methodName();
            }
        }

        return $value;
    }

    private function modify($value)
    {
        if (is_array($value)) {
            $data = [];
            foreach ($value as $element) {
                $data[] = $this->modify($element);
            }
        } else if ($value instanceof NodeInterface) {
            $data = $this->process($value);
        } else {
            $data = $value;
        }

        return $data;
    }
}
