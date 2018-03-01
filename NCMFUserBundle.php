<?php

namespace NCMF\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NCMFUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
