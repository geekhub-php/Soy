<?php

namespace Soy\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SoyUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
