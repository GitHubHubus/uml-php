<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class MethodNode {
    use CommonNode;

    public $arguments = [];
    public $type;
}
