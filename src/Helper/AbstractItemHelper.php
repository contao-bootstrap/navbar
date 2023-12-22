<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Helper;

use Contao\StringUtil;
use Netzmacht\Html\Attributes;
use Netzmacht\Html\Exception\InvalidArgumentException;

use function implode;
use function in_array;
use function sprintf;
use function str_starts_with;
use function strlen;
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

            if (! empty($this->item['nofollow'])) {
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
            if (! ($item[$attribute] ?? false)) {
                continue;
            }

            // Detect if attribute is prerendered, for example target is as ' target="..."'
            $key = sprintf(' %s="', $attribute);
            /** @psalm-suppress PossiblyUndefinedArrayOffset */
            if (str_starts_with($item[$attribute], $key)) {
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

    /** {@inheritDoc}*/
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
        $classes = StringUtil::trimsplit(' ', $this->item['class']);
        foreach ($classes as $class) {
            $this->itemClass[] = $class;
        }

        if (! in_array('trail', $this->itemClass)) {
            return;
        }

        $this->addClass('active');
    }
}
