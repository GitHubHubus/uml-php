# uml-php

uml-php is a library for crawling and generating data structors from project's classes. Information about classes based on doc comments and signature of classes, methods, properties and etc.
Information about classes is represented by a number of nodes:

* [ArgumentNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/ArgumentNode.php)

* [ClassNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/ClassNode.php)

* [ConstantNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/ConstantNode.php)

* [InterfaceNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/InterfaceNode.php)

* [MethodNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/MethodNode.php)

* [PropertyNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/PropertyNode.php)

* [TraitNode](https://github.com/GitHubHubus/uml-php/blob/master/src/Entity/TraitNode.php)

# Install

`composer require ok/uml-php`

# Usage

Simple way to use it is create a some cli command
```php
<?php

namespace Tests;

use OK\Uml\Uml;
use OK\Uml\Parser\Parser;
use OK\Uml\Serializer\JsonSerializer;

class Test {
    public function __construct() {
        $uml = new Uml('path_to_project', new Parser(), new JsonSerializer());
        
        echo $uml->get();
    }
}

$test = new Test();
```
run this using terminal and write output in file

```sh
$ php test.php >> file
```
The result `file` will contains a data about project's classes, serialized to JSON. You can write and use your own serializer if needed.
If you will use default serializer you can interpret data via simple [uml-viewer](https://github.com/GitHubHubus/uml-viewer). But it is ugly right now.

If you want to get data as is array of php nodes, just use getRaw method in your code

```php
$uml->getRaw();
```
