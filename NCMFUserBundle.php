<?php

namespace NCMF\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NCMFSiteBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
