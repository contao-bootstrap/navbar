<?php

declare(strict_types=1);

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

$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bs_addBrand'] = ['bs_navbarBrandTemplate'];

$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bs_isResponsive'] = ['bs_toggleableSize'];

/*
 * Fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navClass'] = [
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(100) NOT NULL default ''",
];


$GLOBALS['TL_DCA']['tl_module']['fields']['bs_isResponsive'] = [
    'exclude'   => true,
    'inputType' => 'checkbox',
    'default'   => true,
    'eval'      => ['tl_class' => 'w50 m12', 'submitOnChange' => true],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_addBrand'] = [
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr w50', 'submitOnChange' => true],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navbarModules'] = [
    'exclude'   => true,
    'inputType' => 'group',
    'palette'   => ['module', 'cssClass', 'inactive'],
    'fields'    => [
        'module'   => [
            'label'            => &$GLOBALS['TL_LANG']['tl_module']['bs_navbarModules_module'],
            'inputType'        => 'select',
            'options_callback' => ['contao_bootstrap.core.listener.module_dca', 'getAllModules'],
            'eval'             => [
                'includeBlankOption' => true,
                'chosen'             => true,
                'tl_class'           => 'w50',
            ],
        ],
        'cssClass' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_navbarModules_cssClass'],
            'inputType' => 'text',
            'eval'      => [
                'rgxp'     => 'txt',
                'tl_class' => 'w50',
            ],
        ],
        'inactive' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_module']['bs_navbarModules_inactive'],
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
        ],
    ],
    'eval'      => ['tl_class' => 'clr ctb-mcw ctb-navbar-mcw'],
    'sql'       => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_navbarBrandTemplate'] = [
    'default'          => 'navbar_brand',
    'exclude'          => true,
    'inputType'        => 'select',
    'reference'        => &$GLOBALS['TL_LANG']['tl_module'],
    'options_callback' => ['contao_bootstrap.core.listener.module_dca', 'getTemplates'],
    'eval'             => ['templatePrefix' => 'navbar_brand', 'chosen' => true, 'tl_class' => 'clr'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['bs_toggleableSize'] = [
    'default'   => '',
    'exclude'   => true,
    'inputType' => 'select',
    'eval'      => [
        'chosen'             => true,
        'tl_class'           => 'w50',
        'includeBlankOption' => true,
    ],
    'sql'       => "char(2) NOT NULL default ''",
];
