Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require "janisgruzis/ssh-bundle" "dev-master"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new JanisGruzis\SshBundle\JanisGruzisSshBundle(),
        );

        // ...
    }

    // ...
}
```

Documentation
============

Documentation is stored in the `Resources/doc/index.md` file in this bundle:

[Read the documentation](https://github.com/JanisGruzis/SshBundle/blob/master/Resources/doc/index.md)

License
============

This bundle is under the MIT license. See the complete license in the bundle:

```
Resources/meta/LICENSE
```

About
============

Developed by Janis Gruzis to ease connection through ssh in Symfony2.