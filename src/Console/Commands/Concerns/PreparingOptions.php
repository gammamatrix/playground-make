<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Console\Commands\Concerns;

/**
 * \Playground\Make\Console\Commands\Concerns\PreparingOptions
 */
trait PreparingOptions
{
    /**
     * @param array<string, mixed> $options
     */
    protected function prepareOptionsTypeDefault(array $options = []): string
    {
        $type = '';

        return $type;
    }

    /**
     * @param array<string, mixed> $options
     */
    protected function prepareOptionsType(array $options = []): string
    {
        $type = $this->c->type();

        if ($this->hasOption('type')
            && $this->option('type')
            && is_string($this->option('type'))
        ) {
            if (! in_array($this->option('type'), $this->options_type_suggested)) {
                $this->components->error(__('playground-make::generator.type.unexpected', [
                    'type' => $this->option('type'),
                    'generator' => $this->type,
                    'types' => implode(', ', $this->options_type_suggested),
                ]));
            } else {
                $type = $this->option('type');
            }
        }

        if (! $type) {
            $type = $this->prepareOptionsTypeDefault($options);
        }

        $this->c->setType($type);

        return $type;
    }
}
