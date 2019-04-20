<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClassNode {
    private $modificators = [];
    protected $name;
    protected $implements = [];
    protected $extend;
    protected $scope;
}
