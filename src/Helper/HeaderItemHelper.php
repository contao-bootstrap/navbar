<?php

declare(strict_types=1);

/**
 * Contao Bootstrap Navbar.
 *
 * @filesource
 */

namespace ContaoBootstrap\Navbar\Helper;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;
use Override;

use function implode;
use function in_array;

/**
 * Class HeaderItemHelper creates the header navigation item.
 */
final class HeaderItemHelper extends Attributes implements ItemHelper
{
    /**
     * Item classes.
     *
     * @var list<string>
     */
    protected array $itemClass = [];

    /**
     * @param array<string,mixed> $item Navigation item.
     *
     * @throws InvalidArgumentException When invalid attributes are given.
     */
    public function __construct(private readonly array $item)
    {
        parent::__construct();

        $this->addClass('dropdown-header');

        $this->initializeItemClasses();
    }

    #[Override]
    public function getItemClass(): string
    {
        return implode(' ', $this->itemClass);
    }

    /** {@inheritDoc}*/
    #[Override]
    public function getItemClassAsArray(): array
    {
        return $this->itemClass;
    }

    #[Override]
    public function getTag(): string
    {
        return 'div';
    }

    /**
     * Initialize the item classes.
     */
    private function initializeItemClasses(): void
    {
        if (! $this->item['class']) {
            return;
        }

        $classes = StringUtil::trimsplit(' ', $this->item['class']);
        foreach ($classes as $class) {
            $this->itemClass[] = $class;
        }

        if (! in_array('trail', $this->itemClass)) {
            return;
        }

        $this->itemClass[] = 'active';
    }
}
