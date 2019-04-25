<?php

namespace Tests;

use OK\Uml\Parser\Parser;

class Test {
    public function __construct() {
        include __DIR__ . '/Classes/AbstractClass.php';
        include __DIR__ . '/Classes/NewTrait.php';
        include __DIR__ . '/Classes/NewInterface.php';
        include __DIR__ . '/Classes/NewClass.php';
        
        include __DIR__ . '/../src/Entity/NodeInterface.php';
        include __DIR__ . '/../src/Entity/ArgumentNode.php';
        include __DIR__ . '/../src/Entity/CommonNode.php';
        include __DIR__ . '/../src/Entity/MethodNode.php';
        include __DIR__ . '/../src/Entity/PropertyNode.php';
        include __DIR__ . '/../src/Entity/InterfaceNode.php';
        include __DIR__ . '/../src/Entity/ConstantNode.php';
        include __DIR__ . '/../src/Entity/TraitNode.php';
        include __DIR__ . '/../src/Entity/ClassNode.php';
        include __DIR__ . '/../src/Parser/DocCommentParser.php';
        
        include __DIR__ . '/../src/Parser/Factory/NodeFactoryInterface.php';
        include __DIR__ . '/../src/Parser/Factory/ModifiersTrait.php';
        include __DIR__ . '/../src/Parser/Factory/ConstantFactory.php';
        include __DIR__ . '/../src/Parser/Factory/ArgumentFactory.php';
        include __DIR__ . '/../src/Parser/Factory/MethodFactory.php';
        include __DIR__ . '/../src/Parser/Factory/InterfaceFactory.php';
        include __DIR__ . '/../src/Parser/Factory/TraitFactory.php';
        include __DIR__ . '/../src/Parser/Factory/ClassFactory.php';
        include __DIR__ . '/../src/Parser/Factory/PropertyFactory.php';
        include __DIR__ . '/../src/Parser/Factory/NodeFactory.php';
        
        include __DIR__ . '/../src/FileCrawler/FileCrawler.php';
        include __DIR__ . '/../src/Serializer/SerializerInterface.php';
        include __DIR__ . '/../src/Serializer/JsonSerializer.php';
        include __DIR__ . '/../src/Parser/ParserInterface.php';
        include __DIR__ . '/../src/Parser/Parser.php';
        include __DIR__ . '/../src/Uml.php';
        
        

        $uml = new \OK\Uml\Uml(__DIR__ . '/../tests/Classes', new Parser(), new \OK\Uml\Serializer\JsonSerializer());
        
        echo $uml->get();
    }
}

$test = new Test();
