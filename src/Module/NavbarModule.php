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

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Module;

use Contao\Module;

/**
 * Class NavbarModule.
 *
 * @package ContaoBootstrap\Navbar\Module
 */
class NavbarModule extends Module
{
    /**
     * Template name.
     *
     * @var string
     */
    protected $strTemplate = 'mod_bs_navbar';

    /**
     * Compile the navbar.
     *
     * @return void
     */
    protected function compile()
    {
        $config  = deserialize($this->bs_navbarModules, true);
        $modules = [];
        $models  = $this->prefetchModules($config);

        foreach ($config as $module) {
            $id = $module['module'];

            if ($id != '' && !$module['inactive'] && array_key_exists($id, $models)) {
                $modules[] = $this->generateModule($module, $models[$id]);
            }
        }

        $cssID = $this->cssID;

        if ($this->cssID[1] == '') {
            $cssID[1] = 'navbar-light bg-light';
        }

        if ($this->bs_isResponsive && $this->bs_toggleableSize) {
            $cssID[1] = trim($cssID[1] . ' navbar-expand-' . $this->bs_toggleableSize);
        }

        $this->cssID             = $cssID;
        $this->Template->modules = $modules;
    }

    /**
     * Generate a frontend module.
     *
     * @param array        $module Module configuration.
     * @param \ModuleModel $model  Module model.
     *
     * @return array
     */
    protected function generateModule($module, \ModuleModel $model)
    {
        $class = $module['cssClass'];

        if ($module['floating']) {
            if ($class != '') {
                $class .= ' ';
            }

            $class .= 'navbar-' . $module['floating'];
        }

        return [
            'type'   => 'module',
            'module' => $this->getFrontendModule($model),
            'id'     => $module['module'],
            'class'  => $class,
        ];
    }

    /**
     * Extract module ids from navbar config.
     *
     * @param array $config The navbar config.
     *
     * @return array
     */
    protected function extractModuleIds($config)
    {
        $ids = [];

        foreach ($config as $index => $module) {
            if ($module['inactive']) {
                continue;
            }
            $ids[$index] = intval($module['module']);
        }

        return $ids;
    }

    /**
     * Prefetch modules.
     *
     * @param array $config Navbar config.
     *
     * @return array
     */
    protected function prefetchModules($config)
    {
        $ids    = $this->extractModuleIds($config);
        $models = [];

        if ($ids) {
            // prefetch modules, so only 1 query is required
            $ids        = implode(',', $ids);
            $collection = \ModuleModel::findBy(['tl_module.id IN(' . $ids . ')'], []);

            if ($collection) {
                while ($collection->next()) {
                    $model              = $collection->current();
                    $model->bs_inNavbar = true;
                    $models[$model->id] = $model;
                }
            }
        }

        return $models;
    }
}
