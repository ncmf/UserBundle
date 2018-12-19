# UserBundle

## Installation

### Install package 
```
php composer.phar require ncmf/user-bundle:dev-master
```

### Add bundles to app/AppKernel.php

            new \NCMF\UserBundle\NCMFUserBundle(),
            new \FOS\UserBundle\FOSUserBundle(),
            
### Edit app/config/config.yml like this

    imports:
        ...
        # - { resource: security.yml } # comment standard security config
        ...
        - { resource: "@NCMFUserBundle/Resources/config/config.yml" }
        - { resource: "@NCMFUserBundle/Resources/config/security.yml" }
        ...

### Add user bundle routes to app/config/routing.yml

    ncmf_user_bundle:
        resource: "@NCMFUserBundle/Resources/config/routing.yml"

### Add bundles to app/AppKernel.php
            $bundles = [
                ...
                new FOS\UserBundle\FOSUserBundle(),
                new NCMF\UserBundle\NCMFUserBundle(),

### Run commands
    composer dump-autoload --optimize
    php bin/console doctrine:schema:validate
    php bin/console doctrine:schema:update --force
