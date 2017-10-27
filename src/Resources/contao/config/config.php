<?php

/**
 * Contao Bootstrap Navbar.
 *
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @license    LGPL 3.0
 * @filesource
 */

/*
 * Frontend modules
 */

$GLOBALS['FE_MOD']['navigationMenu']['bs_navbar'] = 'ContaoBootstrap\Navbar\Module\NavbarModule';

if (isset($GLOBALS['BE_MOD']['design']['themes']['stylesheet'])) {
    if (!is_array($GLOBALS['BE_MOD']['design']['themes']['stylesheet'])) {
        $GLOBALS['BE_MOD']['design']['themes']['stylesheet'] = [$GLOBALS['BE_MOD']['design']['themes']['stylesheet']];
    }
} else {
    $GLOBALS['BE_MOD']['design']['themes']['stylesheet'] = [];
}

$GLOBALS['BE_MOD']['design']['themes']['stylesheet'][] = 'bundles/contaobootstrapnavbar/backend.css';
