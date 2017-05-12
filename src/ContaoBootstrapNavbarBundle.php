<?php

/**
 * @package   contao-bootstrap
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   LGPL 3+
 * @copyright 2013-2017 netzmacht creative David Molineus
 */

namespace ContaoBootstrap\Navbar;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ContaoBootstrap\Core\ContaoBootstrapCoreBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ContaoBootstrapNavbarBundle.
 *
 * @package ContaoBootstrap\Navbar
 */
class ContaoBootstrapNavbarBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        $bundleConfig = BundleConfig::create(ContaoBootstrapNavbarBundle::class)
            ->setLoadAfter([ContaoCoreBundle::class, ContaoBootstrapCoreBundle::class]);

        return [$bundleConfig];
    }
}
