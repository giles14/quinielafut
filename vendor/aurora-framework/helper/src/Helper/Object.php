<?php

namespace Aurora\Helper;

use ArrayAccess;

class Object implements ArrayAccess
{
    private $strict = false;

    use ObjectTrait,
        ArrayTrait,
        CallablePropertyTrait;
}
