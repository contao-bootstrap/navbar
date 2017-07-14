<?php

/**
 * @package   contao-bootstrap
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   LGPL 3+
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

/**
 * palettes
 */
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['bootstrap_navbar'] = [
    'title'     => ['name', 'type'],
    'config'    => ['bootstrap_isResponsive', 'bootstrap_addBrand', 'bootstrap_navbarModules'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID', 'space'],
    'template'  => [':hide', 'customTpl'],
];

/**
 * subpalettes
 */
$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bootstrap_addBrand'] = [
    'bootstrap_navbarBrandTemplate',
];

$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bootstrap_isResponsive'] = [
    'bootstrap_toggleableSize',
];

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_navClass'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navClass'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(100) NOT NULL default ''",
];


$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_isResponsive'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_isResponsive'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'default'   => true,
    'eval'      => ['tl_class' => 'w50 m12', 'submitOnChange' => true],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_addBrand'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_addBrand'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr w50', 'submitOnChange' => true],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_navbarModules'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'tl_class'     => 'clr',
        'columnFields' =>
            [
                'module'   =>
                    [
                        'label'            => $GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules_module'],
                        'inputType'        => 'select',
                        'options_callback' => ['ContaoBootstrap\Core\DataContainer\Module', 'getAllModules'],
                        'eval'             => [
                            'style'              => 'width: 250px',
                            'includeBlankOption' => true,
                            'chosen'             => true
                        ],
                    ],
                'cssClass' =>
                    [
                        'label'     => $GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules_cssClass'],
                        'inputType' => 'text',
                        'eval'      => ['style' => 'width: 500px', 'rgxp' => 'txt'],
                    ],

                'inactive' =>
                    [
                        'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules_inactive'],
                        'inputType' => 'checkbox',
                        'eval'      => ['style' => 'width: 20px'],
                    ],
            ]
    ],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_navbarBrandTemplate'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarBrandTemplate'],
    'default'          => 'mod_navbar',
    'exclude'          => true,
    'inputType'        => 'select',
    'reference'        => &$GLOBALS['TL_LANG']['tl_module'],
    'options_callback' => ['ContaoBootstrap\Core\DataContainer\Module', 'getTemplates'],
    'eval'             => ['templatePrefix' => 'navbar_brand', 'chosen' => true, 'tl_class' => 'clr'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_toggleableSize'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_toggleableSize'],
    'default'   => '',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => ['xs', 'sm', 'md', 'lg', 'xl'],
    'eval'      => [
        'templatePrefix'     => 'navbar_brand',
        'chosen'             => true,
        'tl_class'           => 'w50',
        'includeBlankOption' => true
    ],
    'sql'       => "char(2) NOT NULL default ''",
];
