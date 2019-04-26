<?php

namespace Tests;

use OK\Uml\Parser\Parser;

class Test {
    public function __construct() {
        require_once __DIR__.'/../vendor/autoload.php';

        $uml = new \OK\Uml\Uml(__DIR__ . '/../src', new Parser(), new \OK\Uml\Serializer\JsonSerializer());
        
        echo $uml->get();
    }
}

$test = new Test();
