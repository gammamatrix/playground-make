<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model;

use Illuminate\Support\Facades\Log;

/**
 * \Playground\Make\Configuration\Model\CreateColumn
 */
class CreateColumn extends ModelConfiguration
{
    protected string $column = '';

    protected string $comment = '';

    /**
     * @var string The description will be used for comments and documentation.
     */
    protected string $description = '';

    protected string $label = '';

    protected string $icon = '';

    protected bool $html = false;

    protected bool $index = false;

    protected ?int $precision = null;

    protected ?int $scale = null;

    protected ?int $size = null;

    protected bool $readOnly = false;

    protected bool $nullable = false;

    protected string $type = 'string';

    protected mixed $default;

    protected bool $hasDefault = false;

    protected bool $unsigned = false;

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'column' => '',
        'label' => '',
        'description' => '',
        'icon' => '',
        // 'default' => null,
        // 'precision' => null,
        // 'scale' => null,
        // 'size' => null,
        'html' => false,
        'index' => false,
        'nullable' => false,
        'readOnly' => false,
        'type' => 'string',
    ];

    /**
     * @var array<int, string>
     */
    public $allowed_types = [
        'uuid',
        'ulid',
        'string',
        'char',
        'smallText',
        'mediumText',
        'text',
        'longText',
        'boolean',
        'integer',
        'bigInteger',
        'mediumInteger',
        'smallInteger',
        'tinyInteger',
        'dateTime',
        'decimal',
        'float',
        'double',
    ];

    /**
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options = []): self
    {
        if (! empty($options['column'])
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (! empty($options['type'])
            && is_string($options['type'])
        ) {
            $this->type = $options['type'];
            if (! in_array($this->type, $this->allowed_types)) {
                Log::warning(__('playground-make::model.CreateColumn.type.unexpected', [
                    'column' => $this->column,
                    'type' => $this->type,
                    'allowed' => implode(', ', $this->allowed_types),
                ]));
            }
        }

        if (in_array($this->type, [
            'integer',
            'bigInteger',
            'mediumInteger',
            'smallInteger',
            'tinyInteger',
        ])) {
            if (array_key_exists('unsigned', $options)) {
                $this->unsigned = ! empty($options['unsigned']);
            }

            $this->properties['unsigned'] = $this->unsigned;
        }

        if (in_array($this->type, [
            'decimal',
            'float',
            'double',
        ])) {
            if (! empty($options['precision'])
                && is_numeric($options['precision'])
                && $options['precision'] > 0
            ) {
                $this->precision = intval($options['precision']);
            }

            $this->properties['precision'] = $this->precision;

            if (! empty($options['scale'])
                && is_numeric($options['scale'])
                && $options['scale'] > 0
            ) {
                $this->scale = intval($options['scale']);
            }

            $this->properties['scale'] = $this->scale;
        }

        if (in_array($this->type, [
            'char',
            'string',
        ])) {
            if (! empty($options['size'])
                && is_numeric($options['size'])
                && $options['size'] > 0
            ) {
                $this->size = intval($options['size']);
                $this->properties['size'] = $this->size;
            }
        }

        if (array_key_exists('html', $options)) {
            $this->html = ! empty($options['html']);
        }

        if (array_key_exists('index', $options)) {
            $this->index = ! empty($options['index']);
        }

        if (array_key_exists('nullable', $options)) {
            $this->nullable = ! empty($options['nullable']);
        }

        if (array_key_exists('readOnly', $options)) {
            $this->readOnly = ! empty($options['readOnly']);
        }

        if (! empty($options['comment']) && is_string($options['comment'])) {
            $this->comment = $options['comment'];
            $this->properties['comment'] = $this->comment;
        }

        if (array_key_exists('default', $options)) {
            $this->hasDefault = true;
            // TODO: Place restrictions on the default?
            $this->default = $options['default'];
            $this->properties['default'] = $this->default;
        }

        if (! empty($options['column'])
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (! empty($options['label'])
            && is_string($options['label'])
        ) {
            $this->label = $options['label'];
        }

        if (! empty($options['icon'])
            && is_string($options['icon'])
        ) {
            $this->icon = $options['icon'];
        }

        if (! empty($options['description'])
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        return $this;
    }

    public function apply(): self
    {
        foreach ($this->properties() as $property => $value) {
            if ($property === 'default' && ! $this->hasDefault) {
                continue;
            }
            if (method_exists($this, $property)) {
                $this->properties[$property] = $this->{$property}();
            }
        }

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        if (! $this->hasDefault
            && array_key_exists('default', $this->properties)
        ) {
            unset($this->properties['default']);
        }

        return $this->properties;
    }

    public function column(): string
    {
        return $this->column;
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function default(): mixed
    {
        return $this->default;
    }

    public function hasDefault(): bool
    {
        return $this->hasDefault;
    }

    public function icon(): string
    {
        return $this->icon;
    }

    public function html(): bool
    {
        return $this->html;
    }

    public function index(): bool
    {
        return $this->index;
    }

    public function nullable(): bool
    {
        return $this->nullable;
    }

    public function readOnly(): bool
    {
        return $this->readOnly;
    }

    public function precision(): ?int
    {
        return $this->precision;
    }

    public function scale(): ?int
    {
        return $this->scale;
    }

    public function unsigned(): bool
    {
        return $this->unsigned;
    }
}
