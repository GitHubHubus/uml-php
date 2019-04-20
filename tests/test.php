<?php

namespace Tests;

use OK\Uml\Entity\ClassNode;
use OK\Uml\Parser\Parser;

class Test {
    public function __construct() {
        include __DIR__ . '/../src/Entity/ArgumentNode.php';
        include __DIR__ . '/../src/Entity/CommonNode.php';
        include __DIR__ . '/../src/Entity/MethodNode.php';
        include __DIR__ . '/../src/Entity/PropertyNode.php';
        include __DIR__ . '/../src/Entity/InterfaceNode.php';
        include __DIR__ . '/../src/Entity/ConstantNode.php';
        include __DIR__ . '/../src/Entity/TraitNode.php';
        include __DIR__ . '/../src/Entity/ClassNode.php';
        include __DIR__ . '/../src/Parser/DocCommentParser.php';
        include __DIR__ . '/../src/Parser/Parser.php';
        $class = Parser::getClassInformation(ClassNode::class);

//var_dump($class);   
    }
}

$test = new Test();
