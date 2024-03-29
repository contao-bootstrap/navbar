<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Module;

use Contao\Controller;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\Model;
use Contao\Model\Collection;
use Contao\ModuleModel;
use Contao\StringUtil;
use Netzmacht\Contao\Toolkit\Controller\FrontendModule\AbstractFrontendModuleController;
use Netzmacht\Contao\Toolkit\Response\ResponseTagger;
use Netzmacht\Contao\Toolkit\Routing\RequestScopeMatcher;
use Netzmacht\Contao\Toolkit\View\Template\TemplateRenderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use function array_key_exists;
use function assert;
use function implode;
use function trim;

/** @FrontendModule("bs_navbar", category="navigationMenu") */
final class NavbarFrontendModuleController extends AbstractFrontendModuleController
{
    /** @var Adapter<Controller> */
    private Adapter $controllerAdapter;

    /** @param Adapter<Controller> $controllerAdapter */
    public function __construct(
        TemplateRenderer $templateRenderer,
        RequestScopeMatcher $scopeMatcher,
        ResponseTagger $responseTagger,
        RouterInterface $router,
        TranslatorInterface $translator,
        Adapter $controllerAdapter
    ) {
        parent::__construct($templateRenderer, $scopeMatcher, $responseTagger, $router, $translator);

        $this->controllerAdapter = $controllerAdapter;
    }

    /**
     * {@inheritDoc}
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function prepareTemplateData(array $data, Request $request, Model $model): array
    {
        assert($model instanceof ModuleModel);

        $config  = StringUtil::deserialize($model->bs_navbarModules, true);
        $modules = [];
        $models  = $this->prefetchModules($config);

        foreach ($config as $module) {
            $moduleId = $module['module'];

            if ($moduleId === '' || $module['inactive'] || ! array_key_exists($moduleId, $models)) {
                continue;
            }

            $modules[] = $this->generateModule($module, $models[$moduleId]);
        }

        $class = $data['class'];
        $cssID = $data['cssID'];

        if (! isset($cssID[1]) || $cssID[1] === '') {
            $class = trim($class . ' navbar-light bg-light');
        }

        if ($model->bs_isResponsive && $model->bs_toggleableSize) {
            $class = trim($class . ' navbar-expand-' . $model->bs_toggleableSize);
        }

        $data['class']   = $class;
        $data['modules'] = $modules;

        return $data;
    }

    /**
     * Generate a frontend module.
     *
     * @param array<string,mixed> $module Module configuration.
     * @param ModuleModel         $model  Module model.
     *
     * @return array<string,mixed>
     */
    protected function generateModule(array $module, ModuleModel $model): array
    {
        $class = $module['cssClass'];

        return [
            'type'   => 'module',
            'module' => $this->controllerAdapter->getFrontendModule($model),
            'id'     => $module['module'],
            'class'  => $class,
        ];
    }

    /**
     * Extract module ids from navbar config.
     *
     * @param array<int,array<string,mixed>> $config The navbar config.
     *
     * @return array<int, int>
     */
    protected function extractModuleIds(array $config): array
    {
        $ids = [];

        foreach ($config as $index => $module) {
            if ($module['inactive']) {
                continue;
            }

            $ids[$index] = (int) $module['module'];
        }

        return $ids;
    }

    /**
     * Prefetch modules.
     *
     * @param array<int,array<string,mixed>> $config Navbar config.
     *
     * @return array<int|string,ModuleModel>
     */
    protected function prefetchModules(array $config): array
    {
        $ids    = $this->extractModuleIds($config);
        $models = [];

        if ($ids) {
            // prefetch modules, so only 1 query is required
            $ids        = implode(',', $ids);
            $collection = ModuleModel::findBy(['tl_module.id IN(' . $ids . ')'], []);

            if ($collection instanceof Collection) {
                foreach ($collection as $model) {
                    assert($model instanceof ModuleModel);

                    $model->bs_inNavbar = true;
                    $models[$model->id] = $model;
                }
            }
        }

        return $models;
    }
}
