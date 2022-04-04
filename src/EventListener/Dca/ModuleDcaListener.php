<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\EventListener\Dca;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\Input;
use ContaoBootstrap\Core\Environment;
use ContaoBootstrap\Core\Environment\ThemeContext;

use function defined;

final class ModuleDcaListener
{
    private Environment $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Enter a bootstrap environment context.
     *
     * @Callback(table="tl_module", target="config.onload")
     */
    public function enterContext(): void
    {
        if (Input::get('act') !== 'edit') {
            return;
        }

        if (! defined('CURRENT_ID')) {
            return;
        }

        $this->environment->enterContext(ThemeContext::forTheme((int) CURRENT_ID));
    }

    /**
     * @return list<string>
     *
     * @Callback(table="tl_module", target="fields.bs_toggleableSize.options")
     */
    public function toggleableSizeOptions(): array
    {
        return $this->environment->getConfig()->get(['grid', 'sizes'], ['xs', 'sm', 'md', 'lg', 'xl']);
    }
}
