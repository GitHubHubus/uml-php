<?php

namespace Tests;

use OK\Uml\Uml;
use OK\Uml\Parser\Parser;
use OK\Uml\Serializer\JsonSerializer;

class Test {
    public function __construct() {
        require_once __DIR__.'/../vendor/autoload.php';

        $uml = new Uml(
            __DIR__ . '/../src',
            new Parser(),
            new JsonSerializer()
        );
        
        echo $uml->get();
    }
}

$test = new Test();
