<?php

namespace Tests\Classes;


class NewClass extends AbstractClass implements NewInterface
{
    use NewTrait;

    /**
     * @var string
     */
    public $data = '';

    /**
     * @param string|null $name
     */
    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_CLASS;
    }
}
