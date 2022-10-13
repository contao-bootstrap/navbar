<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Helper;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

use function implode;
use function in_array;
use function sprintf;
use function strlen;
use function strpos;
use function substr;

abstract class AbstractItemHelper extends Attributes implements ItemHelper
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
     * @throws InvalidArgumentException If a broken html attribute is created.
     */
    public function __construct(protected readonly array $item)
    {
        parent::__construct();

        if ($this->getTag() === 'a') {
            $this->setAttribute('href', $item['href']);
            $this->setAttribute('itemprop', 'url');
            $this->addClass('nav-link');

            if ($this->item['nofollow']) {
                $this->setAttribute('rel', 'nofollow');
            }
        } else {
            $this->setAttribute('itemprop', 'name');
        }

        if ($item['isActive']) {
            $this->addClass('active');
        }

        $attributes = ['accesskey', 'tabindex', 'target'];
        foreach ($attributes as $attribute) {
            if (! $item[$attribute]) {
                continue;
            }

            // Detect if attribute is prerendered, for example target is as ' target="..."'
            $key = sprintf(' %s="', $attribute);
            if (strpos($item[$attribute], $key) === 0) {
                $this->setAttribute($attribute, substr($item[$attribute], strlen($key), -1));
            } else {
                $this->setAttribute($attribute, $item[$attribute]);
            }
        }

        $title = $this->item['pageTitle'] ?: $this->item['title'];
        $this->setAttribute('title', $title);

        $this->initializeItemClasses();
    }

    public function getItemClass(): string
    {
        return implode(' ', $this->itemClass);
    }

    /** {@inheritdoc}*/
    public function getItemClassAsArray(): array
    {
        return $this->itemClass;
    }

    public function getTag(): string
    {
        return $this->item['isActive'] ? 'strong' : 'a';
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
