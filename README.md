Contao-Bootstrap Navigation
===========================

[![Version](http://img.shields.io/packagist/v/contao-bootstrap/navbar.svg?style=for-the-badge&label=Latest)](http://packagist.org/packages/contao-bootstrap/navbar)
[![GitHub issues](https://img.shields.io/github/issues/contao-bootstrap/navbar.svg?style=for-the-badge&logo=github)](https://github.com/contao-bootstrap/navbar/issues)
[![License](http://img.shields.io/packagist/l/contao-bootstrap/navbar.svg?style=for-the-badge&label=License)](http://packagist.org/packages/contao-bootstrap/navbar)
[![Build Status](https://img.shields.io/github/workflow/status/contao-bootstrap/navbar/Code%20Quality%20Diagnostics?logo=githubactions&logoColor=%23fff&style=for-the-badge)](https://github.com/contao-bootstrap/navbar/actions)
[![Downloads](http://img.shields.io/packagist/dt/contao-bootstrap/navbar.svg?style=for-the-badge&label=Downloads)](http://packagist.org/packages/contao-bootstrap/navbar)

This extension provides Bootstrap integration into Contao.

Contao-Bootstrap is a modular integration. The components provides navigation features of the Bootstrap component.

Features
--------

Frontend modules
 * Navbar element

Templates
 * Dropdown templates for quicknav and quicklink navigation
 * Navigation dropdown template

Changelog
---------

See [changelog](CHANGELOG.md)

Requirements
------------

 - PHP ^8.1
 - Contao ^4.13 || ^5.0

Install
-------

### Managed edition

When using the managed edition it's pretty simple to install the package. Just search for the package in the
Contao Manager and install it. Alternatively you can use the CLI.

```bash
# Using the contao manager
$ php contao-manager.phar.php composer require contao-bootstrap/navbar ^3.0

# Using composer directly
$ php composer.phar require contao-bootstrap/navbar ^3.0
```

### Symfony application

If you use Contao in a symfony application without contao/manager-bundle, you have to register following bundles
manually:

```php

class AppKernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Contao\CoreBundle\HttpKernel\Bundle\ContaoModuleBundle('metapalettes', $this->getRootDir()),
            new Contao\CoreBundle\HttpKernel\Bundle\ContaoModuleBundle('multicolumnwizard', $this->getRootDir()),
            new Netzmacht\Html\NetzmachtHtmlBundle(),
            new ContaoBootstrap\Core\ContaoBootstrapCoreBundle(),
            new ContaoBootstrap\Grid\ContaoBootstrapNavbarBundle()
        ];
    }
}

```
