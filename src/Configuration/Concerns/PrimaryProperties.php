<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Configuration\Concerns;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Configuration\Concerns\PrimaryProperties
 */
trait PrimaryProperties
{
    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'class' => '',
        'config' => '',
        'extends' => '',
        'fqdn' => '',
        'extends_use' => '',
        'model' => '',
        'model_fqdn' => '',
        'model_camel' => '',
        'model_camels' => '',
        'model_label' => '',
        'model_labels' => '',
        'model_lower' => '',
        'model_lowers' => '',
        'model_kebab' => '',
        'model_kebabs' => '',
        'model_slug' => '',
        'model_slugs' => '',
        'model_snake' => '',
        'model_snakes' => '',
        'model_studly' => '',
        'model_studlies' => '',
        'model_variable' => '',
        'model_variables' => '',
        'module' => '',
        'module_label' => '',
        'module_labels' => '',
        'module_slug' => '',
        'module_slugs' => '',
        'name' => '',
        'names' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        'playground' => false,
        'type' => '',
        // 'implements' => [],
        // 'models' => [],
        // 'uses' => [],
    ];

    protected string $class = '';

    protected string $config = '';

    protected string $extends = '';

    protected string $extends_use = '';

    protected string $fqdn = '';

    protected string $model = '';

    protected string $model_fqdn = '';

    protected string $model_camel = '';

    protected string $model_camels = '';

    protected string $model_kebab = '';

    protected string $model_kebabs = '';

    protected string $model_label = '';

    protected string $model_labels = '';

    protected string $model_lower = '';

    protected string $model_lowers = '';

    protected string $model_slug = '';

    protected string $model_slugs = '';

    protected string $model_snake = '';

    protected string $model_snakes = '';

    protected string $model_studly = '';

    protected string $model_studlies = '';

    protected string $model_variable = '';

    protected string $model_variables = '';

    protected string $module = '';

    protected string $module_label = '';

    protected string $module_labels = '';

    protected string $module_slug = '';

    protected string $module_slugs = '';

    protected string $name = '';

    protected string $names = '';

    protected string $namespace = '';

    protected string $organization = '';

    protected string $package = '';

    protected bool $playground = false;

    protected string $type = '';

    /**
     * @var array<string, class-string>
     */
    protected array $implements = [];

    /**
     * @var array<string, string>
     */
    protected array $models = [];

    /**
     * @var array<int|string, string>
     */
    protected array $uses = [];

    /**
     * @param  array<mixed, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        if (! empty($options['class'])
            && is_string($options['class'])
        ) {
            $this->class = $options['class'];
        }

        if (! empty($options['config'])
            && is_string($options['config'])
        ) {
            $this->config = $options['config'];
        }

        if (! empty($options['organization'])
            && is_string($options['organization'])
        ) {
            $this->organization = $options['organization'];
        }

        if (! empty($options['extends'])
            && is_string($options['extends'])
        ) {
            $this->extends = $options['extends'];
        }

        if (! empty($options['extends_use'])
            && is_string($options['extends_use'])
        ) {
            $this->extends_use = $options['extends_use'];
        }

        if (! empty($options['fqdn'])
            && is_string($options['fqdn'])
        ) {
            $this->fqdn = $options['fqdn'];
        }

        if (! empty($options['model'])
            && is_string($options['model'])
        ) {
            $this->model = $options['model'];
        }

        if (! empty($options['model_fqdn'])
            && is_string($options['model_fqdn'])
        ) {
            $this->model_fqdn = $options['model_fqdn'];
        }

        if (! empty($options['model_camel'])
            && is_string($options['model_camel'])
        ) {
            $this->model_camel = $options['model_camel'];
        }

        if (! empty($options['model_camels'])
            && is_string($options['model_camels'])
        ) {
            $this->model_camels = $options['model_camels'];
        }

        if (! empty($options['model_label'])
            && is_string($options['model_label'])
        ) {
            $this->model_label = $options['model_label'];
        }

        if (! empty($options['model_labels'])
            && is_string($options['model_labels'])
        ) {
            $this->model_labels = $options['model_labels'];
        }

        if (! empty($options['model_lower'])
            && is_string($options['model_lower'])
        ) {
            $this->model_lower = $options['model_lower'];
        }

        if (! empty($options['model_lowers'])
            && is_string($options['model_lowers'])
        ) {
            $this->model_lowers = $options['model_lowers'];
        }

        if (! empty($options['model_kebab'])
            && is_string($options['model_kebab'])
        ) {
            $this->model_kebab = $options['model_kebab'];
        }

        if (! empty($options['model_kebabs'])
            && is_string($options['model_kebabs'])
        ) {
            $this->model_kebabs = $options['model_kebabs'];
        }

        if (! empty($options['model_slug'])
            && is_string($options['model_slug'])
        ) {
            $this->model_slug = $options['model_slug'];
        }

        if (! empty($options['model_slugs'])
            && is_string($options['model_slugs'])
        ) {
            $this->model_slugs = $options['model_slugs'];
        }

        if (! empty($options['model_snake'])
            && is_string($options['model_snake'])
        ) {
            $this->model_snake = $options['model_snake'];
        }

        if (! empty($options['model_snakes'])
            && is_string($options['model_snakes'])
        ) {
            $this->model_snakes = $options['model_snakes'];
        }

        if (! empty($options['model_studly'])
            && is_string($options['model_studly'])
        ) {
            $this->model_studly = $options['model_studly'];
        }

        if (! empty($options['model_studlies'])
            && is_string($options['model_studlies'])
        ) {
            $this->model_studlies = $options['model_studlies'];
        }

        if (! empty($options['model_variable'])
            && is_string($options['model_variable'])
        ) {
            $this->model_variable = $options['model_variable'];
        }

        if (! empty($options['model_variables'])
            && is_string($options['model_variables'])
        ) {
            $this->model_variables = $options['model_variables'];
        }

        if (! empty($options['module'])
            && is_string($options['module'])
        ) {
            $this->module = $options['module'];
            if (empty($options['module_label']) && empty($this->module_label)) {
                $this->module_label = Str::of($this->module)->headline()->toString();
            }
            if (empty($options['module_labels']) && empty($this->module_labels)) {
                $this->module_labels = Str::of($this->module)->plural()->headline()->toString();
            }
        }

        if (! empty($options['module_label'])
            && is_string($options['module_label'])
        ) {
            $this->module_label = $options['module_label'];
            if (empty($options['module_labels']) && empty($this->module_labels)) {
                $this->module_labels = Str::of($this->module_label)->plural()->toString();
            }
        }

        if (! empty($options['module_labels'])
            && is_string($options['module_labels'])
        ) {
            $this->module_labels = $options['module_labels'];
        }

        if (! empty($options['module_slug'])
            && is_string($options['module_slug'])
        ) {
            $this->module_slug = $options['module_slug'];
            if (empty($options['module_slugs']) && empty($this->module_slugs)) {
                $this->module_slugs = Str::of($this->module_slug)->plural()->finish('s')->toString();
            }
        }

        if (! empty($options['module_slugs'])
            && is_string($options['module_slugs'])
        ) {
            $this->module_slugs = $options['module_slugs'];
        }

        if (! empty($options['name'])
            && is_string($options['name'])
        ) {
            $this->name = $options['name'];
            if (empty($options['names']) && empty($this->names)) {
                $this->names = Str::of($this->name)->plural()->finish('s')->toString();
            }
        }

        if (! empty($options['names'])
            && is_string($options['names'])
        ) {
            $this->names = $options['names'];
        }

        if (! empty($options['namespace'])
            && is_string($options['namespace'])
        ) {
            $this->namespace = $options['namespace'];
        }

        if (! empty($options['package'])
            && is_string($options['package'])
        ) {
            $this->package = $options['package'];
        }

        if (array_key_exists('playground', $options)) {
            $this->playground = ! empty($options['playground']);
        }

        if (! empty($options['type'])
            && is_string($options['type'])
        ) {
            $this->type = $options['type'];
        }

        $this->addModels($options);
        $this->addImplements($options);
        $this->addUses($options);

        return $this;
    }

    public function class(): string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function config(): string
    {
        return $this->config;
    }

    public function setConfig(string $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function fqdn(): string
    {
        return $this->fqdn;
    }

    public function setFqdn(string $fqdn): self
    {
        $this->fqdn = $fqdn;

        return $this;
    }

    /**
     * @return array<string, class-string>
     */
    public function implements(): array
    {
        return $this->implements;
    }

    /**
     * Model should only contain the class_basename($model).
     */
    public function model(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function model_fqdn(): string
    {
        return $this->model_fqdn;
    }

    public function setModelFqdn(string $model_fqdn): self
    {
        $this->model_fqdn = $model_fqdn;

        return $this;
    }

    public function model_camel(): string
    {
        return $this->model_camel;
    }

    public function model_camels(): string
    {
        return $this->model_camels;
    }

    public function model_kebab(): string
    {
        return $this->model_kebab;
    }

    public function model_kebabs(): string
    {
        return $this->model_kebabs;
    }

    public function model_label(): string
    {
        return $this->model_label;
    }

    public function model_labels(): string
    {
        return $this->model_labels;
    }

    public function model_lower(): string
    {
        return $this->model_lower;
    }

    public function model_lowers(): string
    {
        return $this->model_lowers;
    }

    public function model_slug(): string
    {
        return $this->model_slug;
    }

    public function model_slugs(): string
    {
        return $this->model_slugs;
    }

    public function model_snake(): string
    {
        return $this->model_snake;
    }

    public function model_snakes(): string
    {
        return $this->model_snakes;
    }

    public function model_studly(): string
    {
        return $this->model_studly;
    }

    public function model_studlies(): string
    {
        return $this->model_studlies;
    }

    public function model_variable(): string
    {
        return $this->model_variable;
    }

    public function model_variables(): string
    {
        return $this->model_variables;
    }

    /**
     * @return array<string, string>
     */
    public function models(): array
    {
        return $this->models;
    }

    /**
     * Module may contain spaces.
     */
    public function module(): string
    {
        return $this->module;
    }

    public function setModule(string $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function module_label(): string
    {
        return $this->module_label;
    }

    public function setModuleLabel(string $module_label): self
    {
        $this->module_label = $module_label;

        return $this;
    }

    public function module_labels(): string
    {
        return $this->module_labels;
    }

    public function setModuleLabels(string $module_labels): self
    {
        $this->module_labels = $module_labels;

        return $this;
    }

    public function module_slug(): string
    {
        return $this->module_slug;
    }

    public function setModuleSlug(string $module_slug): self
    {
        $this->module_slug = $module_slug;

        return $this;
    }

    public function module_slugs(): string
    {
        return $this->module_slugs;
    }

    public function setModuleSlugs(string $module_slugs): self
    {
        $this->module_slugs = $module_slugs;

        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function names(): string
    {
        return $this->names;
    }

    public function setNames(string $names): self
    {
        $this->names = $names;

        return $this;
    }

    public function namespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function organization(): string
    {
        return $this->organization;
    }

    public function setOrganization(string $organization): self
    {
        $this->organization = $organization;

        return $this;
    }

    public function package(): string
    {
        return $this->package;
    }

    public function setPackage(string $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function playground(): bool
    {
        return $this->playground;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array<int|string, string>
     */
    public function uses(): array
    {
        return $this->uses;
    }

    public function extends(): string
    {
        return $this->extends;
    }

    public function extends_use(): string
    {
        return $this->extends_use;
    }

    /**
     * @return array<string, mixed>
     */
    public function properties(): array
    {
        return $this->properties;
    }
}
