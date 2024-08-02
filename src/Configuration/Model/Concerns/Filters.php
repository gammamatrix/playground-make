<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model\Concerns;

use Playground\Make\Configuration\Model;

/**
 * \Playground\Make\Configuration\Model\Concerns\Filters
 */
trait Filters
{
    protected ?Model\Filters $filters = null;

    /**
     * @param array<string, mixed> $options
     */
    public function addFilters(array $options, bool $apply = false): self
    {
        // if (empty($this->filters)) {
        //     $this->filters = new Model\Filters;
        // }

        // if (! empty($options['filters'])
        //     && is_array($options['filters'])
        // ) {
        //     if ($this->skeleton()) {
        //         $this->filters->withSkeleton();
        //     }
        //     $this->filters->setParent($this)->setOptions($options['filters']);
        //     // $this->filters->setParent($this)->setOptions($options['filters'])->apply();

        //     if ($apply) {
        //         $this->filters->apply();
        //     }
        // }

        if (! empty($options['filters']) && is_array($options['filters'])) {
            $this->addFilter($options['filters']);
        }

        return $this;
    }

    /**
     * @param array<string, mixed> $options
     */
    public function addFilter(array $options = [], bool $apply = true): self
    {
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        // ]);
        if (empty($this->filters)) {
            $this->filters = new Model\Filters;
        }

        if ($this->skeleton()) {
            $this->filters->withSkeleton();
        }

        $this->filters->setParent($this);

        if ($options) {
            $this->filters->setOptions($options);
        }

        if ($apply) {
            $this->filters->apply();
        }

        return $this;
    }

    public function filters(): ?Model\Filters
    {
        return $this->filters;
    }
}
