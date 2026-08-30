<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Configuration\Model;

use Illuminate\Support\Str;
use Playground\Make\Configuration;

/**
 * \Playground\Make\Configuration\Model\HasManyThrough
 */
class HasManyThrough extends ModelConfiguration implements Configuration\Contracts\WithSkeleton
{
    use Configuration\Concerns\WithSkeleton;

    protected string $comment = '';

    protected string $accessor = '';

    protected string $related = '';

    protected string $firstKey = '';

    protected string $secondLocalKey = '';

    protected string $localKey = '';

    protected string $secondKey = '';

    protected string $through = '';

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'comment' => '',
        'accessor' => '',
        'related' => '',
        'firstKey' => '',
        'secondKey' => '',
        'localKey' => '',
        'secondLocalKey' => '',
        'through' => '',
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        if (! empty($options['comment'])
            && is_string($options['comment'])
        ) {
            $this->comment = $options['comment'];
        }

        if (! empty($options['accessor'])
            && is_string($options['accessor'])
        ) {
            $this->accessor = $options['accessor'];
        }

        if (! empty($options['related'])
            && is_string($options['related'])
        ) {
            $this->related = $options['related'];
        }

        if (! empty($options['firstKey'])
            && is_string($options['firstKey'])
        ) {
            $this->firstKey = $options['firstKey'];
        }

        if (! empty($options['secondKey'])
            && is_string($options['secondKey'])
        ) {
            $this->secondKey = $options['secondKey'];
        }

        if (! empty($options['localKey'])
            && is_string($options['localKey'])
        ) {
            $this->localKey = $options['localKey'];
        }

        if (! empty($options['secondLocalKey'])
            && is_string($options['secondLocalKey'])
        ) {
            $this->secondLocalKey = $options['secondLocalKey'];
        }

        if (! empty($options['through'])
            && is_string($options['through'])
        ) {
            $this->through = $options['through'];
        }

        if ($this->skeleton() && $this->accessor && $parent = $this->getParent()) {

            if (! $this->comment) {
                $this->comment = sprintf(
                    'The %1$s of the %2$s.',
                    Str::of($this->accessor)->kebab()->replace('-', ' ')->toString(),
                    Str::of($parent->name())->kebab()->replace('-', ' ')->toString()
                );
            }

            if (! $this->localKey) {
                $this->localKey = 'id';
            }

            if (! $this->secondKey) {
                $this->secondKey = 'id';
            }

            if (! $this->secondLocalKey) {
                $this->secondLocalKey = Str::of($this->accessor)->snake()->finish('_id')->toString();
            }

            if (! $this->related) {
                $this->related = Str::of($this->accessor)->studly()->singular()->toString();
            }
        }

        return $this;
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function accessor(): string
    {
        return $this->accessor;
    }

    public function related(): string
    {
        return $this->related;
    }

    public function firstKey(): string
    {
        return $this->firstKey;
    }

    public function secondKey(): string
    {
        return $this->secondKey;
    }

    public function localKey(): string
    {
        return $this->localKey;
    }

    public function secondLocalKey(): string
    {
        return $this->secondLocalKey;
    }

    public function through(): string
    {
        return $this->through;
    }
}
