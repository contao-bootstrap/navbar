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
use Override;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use function array_key_exists;
use function implode;
use function trim;

/** @FrontendModule("bs_navbar", category="navigationMenu", template="mod_bs_navbar") */
final class NavbarFrontendModuleController extends AbstractFrontendModuleController
{
    /** @param Adapter<Controller> $controllerAdapter */
    public function __construct(
        TemplateRenderer $templateRenderer,
        RequestScopeMatcher $scopeMatcher,
        ResponseTagger $responseTagger,
        RouterInterface $router,
        TranslatorInterface $translator,
        private readonly Adapter $controllerAdapter,
    ) {
        parent::__construct($templateRenderer, $scopeMatcher, $responseTagger, $router, $translator);
    }

    /**
     * {@inheritDoc}
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @psalm-suppress UndefinedMagicPropertyFetch
     */
    #[Override]
    protected function prepareTemplateData(array $data, Request $request, Model $model): array
    {
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
                    $model->bs_inNavbar = true;
                    $models[$model->id] = $model;
                }
            }
        }

        return $models;
    }
}
