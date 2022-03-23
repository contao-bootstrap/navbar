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
 * Palettes
 */

$GLOBALS['TL_DCA']['tl_module']['metapalettes']['bs_navbar'] = [
    'title'     => ['name', 'type'],
    'config'    => ['bs_isResponsive', 'bs_addBrand', 'bs_navbarModules'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID', 'space'],
    'template'  => [':hide', 'customTpl'],
];

/*
 * Subpalettes
 */

$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bs_addBrand'] = [
    'bs_navbarBrandTemplate',
];

$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bs_isResponsive'] = [
    'bs_toggleableSize',
];

/*
 * Fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navClass'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_navClass'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(100) NOT NULL default ''",
];


$GLOBALS['TL_DCA']['tl_module']['fields']['bs_isResponsive'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_isResponsive'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'default'   => true,
    'eval'      => ['tl_class' => 'w50 m12', 'submitOnChange' => true],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_addBrand'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_addBrand'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr w50', 'submitOnChange' => true],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navbarModules'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_navbarModules'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'tl_class'     => 'clr ctb-mcw ctb-navbar-mcw',
        'columnFields' =>
            [
                'module'   => [
                    'label'            => $GLOBALS['TL_LANG']['tl_module']['bs_navbarModules_module'],
                    'inputType'        => 'select',
                    'options_callback' => ['contao_bootstrap.core.listener.module_dca', 'getAllModules'],
                    'eval'             => [
                        'style'              => 'width: 250px',
                        'includeBlankOption' => true,
                        'chosen'             => true,
                    ],
                ],
                'cssClass' => [
                    'label'     => $GLOBALS['TL_LANG']['tl_module']['bs_navbarModules_cssClass'],
                    'inputType' => 'text',
                    'eval'      => ['rgxp' => 'txt'],
                ],

                'inactive' => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_navbarModules_inactive'],
                    'inputType' => 'checkbox',
                    'eval'      => [],
                ],
            ],
    ],
    'sql'       => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navbarBrandTemplate'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_module']['bs_navbarBrandTemplate'],
    'default'          => 'navbar_brand',
    'exclude'          => true,
    'inputType'        => 'select',
    'reference'        => &$GLOBALS['TL_LANG']['tl_module'],
    'options_callback' => ['contao_bootstrap.core.listener.module_dca', 'getTemplates'],
    'eval'             => ['templatePrefix' => 'navbar_brand', 'chosen' => true, 'tl_class' => 'clr'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_toggleableSize'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_toggleableSize'],
    'default'   => '',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => ['xs', 'sm', 'md', 'lg', 'xl'],
    'eval'      => [
        'chosen'             => true,
        'tl_class'           => 'w50',
        'includeBlankOption' => true,
    ],
    'sql'       => "char(2) NOT NULL default ''",
];
