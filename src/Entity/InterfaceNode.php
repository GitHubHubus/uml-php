<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class InterfaceNode {
    use CommonNode;

    public $methods = [];
    public $properties = [];
    public $implements = [];
    public $extend;
}
