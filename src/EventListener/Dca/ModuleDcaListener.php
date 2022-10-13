<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\EventListener\Dca;

use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Contao\Input;
use ContaoBootstrap\Core\Environment;
use ContaoBootstrap\Core\Environment\ThemeContext;

final class ModuleDcaListener
{
    /** @param Adapter<Input> $inputAdapter */
    public function __construct(private readonly Environment $environment, private readonly Adapter $inputAdapter)
    {
    }

    /**
     * Enter a bootstrap environment context.
     *
     * @Callback(table="tl_module", target="config.onload")
     */
    public function enterContext(DataContainer $dataContainer): void
    {
        if ($this->inputAdapter->get('act') !== 'edit') {
            return;
        }

        $this->environment->enterContext(ThemeContext::forTheme((int) $dataContainer->currentPid));
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
