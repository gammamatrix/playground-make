<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Building\Concerns;

/**
 * \Playground\Make\Building\Concerns\BuildImplements
 */
trait BuildImplements
{
    protected function buildClass_implements(): void
    {
        if (! method_exists($this->c, 'implements')) {
            return;
        }

        $use = '';
        $implements = '';

        $i = 0;
        $count = count($this->c->implements());
        foreach ($this->c->implements() as $key => $value) {
            if (is_string($key)) {
                if ($key) {
                    $implements .= sprintf(
                        '%1$s%2$s%3$s%4$s',
                        ($count === 1) ? '' : PHP_EOL,
                        ($count === 1) ? ' ' : static::INDENT,
                        $key,
                        (($count !== 1) && ($count - 2) >= $i) ? ',' : ''
                    );
                }
                if ($value) {
                    $this->buildClass_uses_add($value);
                }
            }
            $i++;
        }

        $this->searches['implements'] = empty($implements) ? '' : sprintf(
            ' implements%1$s', $implements
        );
    }
}
