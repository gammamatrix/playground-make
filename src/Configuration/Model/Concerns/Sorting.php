<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model\Concerns;

use Playground\Make\Configuration\Model\Sortable;

/**
 * \Playground\Make\Configuration\Model\Concerns\Sorting
 */
trait Sorting
{
    /**
     * @var array<int, Sortable>
     */
    protected array $sortable = [];

    /**
     * @param array<string, mixed> $options
     */
    public function addSorting(array $options): self
    {
        if (! empty($options['sortable'])
            && is_array($options['sortable'])
        ) {
            foreach ($options['sortable'] as $i => $meta) {
                $this->addSortable($meta, $i);
            }
        }

        return $this;
    }

    public function addSortable(
        mixed $meta,
        int $i = null
    ): self {

        if (empty($meta)
            || ! is_array($meta)
            || empty($meta['column'])
            || ! is_string($meta['column'])
        ) {
            throw new \RuntimeException(__('playground-make::model.Sorting.invalid', [
                'name' => $this->name() ?: 'model',
                'i' => $i ?? '-',
            ]));
        }

        $sortable = new Sortable;
        $sortable->setParent($this)->setOptions($meta)->apply();

        if (is_numeric($i)) {
            $this->sortable[$i] = $sortable;
        } else {
            $this->sortable[] = $sortable;
        }

        return $this;
    }

    /**
     * @return array<int, Sortable>
     */
    public function sortable(): array
    {
        return $this->sortable;
    }
}
