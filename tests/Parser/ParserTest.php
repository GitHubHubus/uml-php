<?php

namespace Tests\Parser;

use Tests\TestCase;
use Tests\Classes\NewClass;
use OK\Uml\Entity\NodeInterface;
use OK\Uml\Parser\Parser;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ParserTest extends TestCase
{
    /**
     * @dataProvider getClassMetadataProvider
     */
    public function testGetClassMetadata($className, $type, $result)
    {
        $node = Parser::getClassMetadata($className, $type);

        $this->assertEquals($result, $node instanceof NodeInterface);
    }
    
    public function getClassMetadataProvider()
    {
        return [
            [NewClass::class, NodeInterface::TYPE_CLASS, true],
            ['Tests\\Classes\\InvalidClass', NodeInterface::TYPE_CLASS, false],
        ];
    }
}
