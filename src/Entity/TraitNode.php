<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class TraitNode {
    use CommonNode;

    private $methods = [];
    private $properties = [];
    public $implements = [];
    public $extend;
}
