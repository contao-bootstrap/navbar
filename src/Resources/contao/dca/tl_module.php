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
$GLOBALS['TL_DCA']['tl_module']['metapalettes']['navbar'] = array
(
    'title'                     => array('name', 'type'),
    'config'                    => array('bootstrap_isResponsive', 'bootstrap_addBrand', 'bootstrap_navbarModules'),
    'protected'                 => array(':hide', 'protected'),
    'expert'                    => array(':hide', 'guests', 'cssID', 'space'),
    'template'                  => array(':hide', 'customTpl'),
);

/**
 * subpalettes
 */
$GLOBALS['TL_DCA']['tl_module']['metasubpalettes']['bootstrap_addBrand'] = array
(
    'bootstrap_navbarBrandTemplate',
);


/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_navClass'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navClass'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class' => 'w50'),
    'sql'                     => "varchar(100) NOT NULL default ''",
);


$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_isResponsive'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_isResponsive'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'default'                 => true,
    'eval'                    => array('tl_class' => 'w50'),
    'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_addBrand'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_addBrand'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class' => 'w50', 'submitOnChange' => true),
    'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_navbarModules'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules'],
    'exclude'                 => true,
    'inputType'               => 'multiColumnWizard',
    'eval'                    => array(
        'tl_class'     => 'clr',
        'columnFields' => array
        (
            'module'   => array
            (
                'label'            => $GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules_module'],
                'inputType'        => 'select',
                'options_callback' => array('ContaoBootstrap\Core\DataContainer\Module', 'getAllModules'),
                'eval'             => array('style' => 'width: 250px', 'includeBlankOption' => true, 'chosen' => true),
            ),
            'cssClass' => array
            (
                'label'     => $GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules_cssClass'],
                'inputType' => 'text',
                'eval'      => array('style' => 'width: 350px', 'rgxp' => 'txt'),
            ),

            'inactive' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarModules_inactive'],
                'inputType' => 'checkbox',
                'eval'      => array('style' => 'width: 80px'),
            ),
        )
    ),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['bootstrap_navbarBrandTemplate'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['bootstrap_navbarBrandTemplate'],
    'default'                 => 'mod_navbar',
    'exclude'                 => true,
    'inputType'               => 'select',
    'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
    'options_callback'        => array('ContaoBootstrap\Core\DataContainer\Module', 'getTemplates'),
    'eval'                    => array('templatePrefix' => 'navbar_brand', 'chosen' => true, 'tl_class' => 'clr'),
    'sql'                     => "varchar(64) NOT NULL default ''",
);
