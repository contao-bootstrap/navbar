<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2016 netzmacht David Molineus. All rights reserved.
 * @filesource
 *
 */

namespace ContaoBootstrap\Navbar\Module;

use Contao\Module;

/**
 * Class NavbarModule
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
    protected $strTemplate = 'mod_navbar';

    /**
     * Compile the navbar.
     *
     * @return void
     */
    protected function compile()
    {
        $config  = deserialize($this->bootstrap_navbarModules, true);
        $modules = array();
        $models  = $this->prefetchModules($config);

        foreach ($config as $module) {
            $id = $module['module'];

            if ($id != '' && !$module['inactive'] && array_key_exists($id, $models)) {
                $modules[] = $this->generateModule($module, $models[$id]);
            }
        }

        $cssID= $this->cssID;

        if ($this->cssID[1] == '') {
            $cssID[1] = 'navbar-light bg-faded';
        }

        if ($this->bootstrap_isResponsive && $this->bootstrap_toggleableSize) {
            $cssID[1] = trim($cssID[1]  . ' navbar-toggleable-' . $this->bootstrap_toggleableSize);
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

        return array(
            'type'   => 'module',
            'module' => $this->getFrontendModule($model),
            'id'     => $module['module'],
            'class'  => $class,
        );
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
        $ids = array();

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
        $models = array();

        if ($ids) {
            // prefetch modules, so only 1 query is required
            $ids        = implode(',', $ids);
            $collection = \ModuleModel::findBy(array('tl_module.id IN(' . $ids . ')'), array());

            if ($collection) {
                while ($collection->next()) {
                    $model                     = $collection->current();
                    $model->bootstrap_inNavbar = true;
                    $models[$model->id]        = $model;
                }
            }
        }

        return $models;
    }
}
