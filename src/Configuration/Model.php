<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration;

use Playground\Make\Model\Recipe\Model as ModelRecipe;

/**
 * \Playground\Make\Configuration\Model
 */
class Model extends PrimaryConfiguration
{
    use Model\Concerns\Attributes;

    // use Model\Concerns\Classes;
    use Model\Concerns\Components;
    use Model\Concerns\Creating;
    use Model\Concerns\Filters;
    use Model\Concerns\Relationships;
    use Model\Concerns\Scopes;
    use Model\Concerns\Sorting;

    // protected string $extends = 'Model';

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'class' => '',
        'config' => '',
        'fqdn' => '',
        'module' => '',
        'module_slug' => '',
        'name' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        // properties
        'model' => '',
        'model_attribute' => '',
        'model_attribute_required' => false,
        'model_plural' => '',
        'model_singular' => '',
        'model_slug' => '',
        'model_slug_plural' => '',
        'recipe' => '',
        'type' => '',
        'table' => '',
        'perPage' => null,
        'controller' => false,
        'factory' => false,
        'migration' => false,
        'playground' => false,
        'policy' => false,
        'requests' => false,
        'revision' => false,
        'seed' => false,
        'test' => false,
        'extends' => '',
        'implements' => [],
        'HasOne' => [],
        'HasMany' => [],
        'scopes' => [],
        'attributes' => [],
        'casts' => [],
        'fillable' => [],
        'filters' => null,
        'models' => [],
        'sortable' => [],
        'create' => null,
        'uses' => [],
    ];

    public function apply(): self
    {
        $this->properties['class'] = $this->class();
        $this->properties['config'] = $this->config();
        $this->properties['fqdn'] = $this->fqdn();
        $this->properties['module'] = $this->module();
        $this->properties['module_slug'] = $this->module_slug();
        $this->properties['name'] = $this->name();
        $this->properties['namespace'] = $this->namespace();
        $this->properties['organization'] = $this->organization();
        $this->properties['package'] = $this->package();
        $this->properties['model'] = $this->model();
        $this->properties['model_attribute'] = $this->model_attribute();
        $this->properties['model_attribute_required'] = $this->model_attribute_required();
        $this->properties['model_plural'] = $this->model_plural();
        $this->properties['model_singular'] = $this->model_singular();
        $this->properties['model_slug'] = $this->model_slug();
        $this->properties['model_slug_plural'] = $this->model_slug_plural();
        $this->properties['recipe'] = $this->recipe();
        $this->properties['type'] = $this->type();
        $this->properties['table'] = $this->table();
        $this->properties['perPage'] = $this->perPage();
        $this->properties['controller'] = $this->controller();
        $this->properties['factory'] = $this->factory();
        $this->properties['migration'] = $this->migration();
        $this->properties['playground'] = $this->playground();
        $this->properties['policy'] = $this->policy();
        $this->properties['requests'] = $this->requests();
        $this->properties['revision'] = $this->revision();
        $this->properties['seed'] = $this->seed();
        $this->properties['test'] = $this->test();

        $this->properties['extends'] = $this->extends();
        $this->properties['implements'] = $this->implements();

        if ($this->HasOne()) {
            $this->properties['HasOne'] = [];
            foreach ($this->HasOne() as $method => $HasOne) {
                if (is_array($this->properties['HasOne'])) {
                    $this->properties['HasOne'][$method] = $HasOne->toArray();
                }
            }
        }

        if ($this->HasMany()) {
            $this->properties['HasMany'] = [];
            foreach ($this->HasMany() as $method => $HasMany) {
                if (is_array($this->properties['HasMany'])) {
                    $this->properties['HasMany'][$method] = $HasMany->toArray();
                }
            }
        }
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     // '$this->c' => $this->c,
        //     // '$this->c' => $this->c->toArray(),
        //     // '$this->filters()' => $this->filters(),
        //     '$this->filters()' => $this->filters()?->toArray(),
        //     // '$this->analyze' => $this->analyze,
        // ]);

        $this->properties['scopes'] = $this->scopes();
        $this->properties['attributes'] = $this->attributes();
        $this->properties['casts'] = $this->casts();
        $this->properties['fillable'] = $this->fillable();
        $this->properties['filters'] = $this->filters()?->toArray();

        $this->properties['models'] = $this->models();
        $this->properties['sortable'] = $this->sortable();

        if ($this->sortable()) {
            $this->properties['sortable'] = [];
            foreach ($this->sortable() as $i => $sortable) {
                if (is_array($this->properties['sortable'])) {
                    $this->properties['sortable'][$i] = $sortable->toArray();
                }
            }
        }

        $create = $this->create();
        if ($create) {
            $create->apply();
        }
        $this->properties['create'] = $create?->toArray();

        $this->properties['uses'] = $this->uses();

        return $this;
    }

    protected string $model = '';

    protected string $model_attribute = '';

    protected bool $model_attribute_required = false;

    protected string $model_plural = '';

    protected string $model_singular = '';

    protected string $model_slug = '';

    protected string $model_slug_plural = '';

    protected string $recipe = '';

    protected string $type = '';

    protected ?int $perPage = null;

    protected bool $playground = false;

    protected bool $revision = false;

    protected string $table = '';

    /**
     * @var array<string, mixed>
     */
    protected array $attributes = [];

    /**
     * @var array<string, mixed>
     */
    protected array $casts = [];

    /**
     * @var array<int, string>
     */
    protected array $fillable = [];

    public function resetOption(string $option): self
    {

        if ($option === 'attributes') {
            $this->attributes = [];
        } elseif ($option === 'fillable') {
            $this->fillable = [];
        } elseif ($option === 'implements') {
            $this->implements = [];
        } elseif ($option === 'HasOne') {
            $this->HasOne = [];
        } elseif ($option === 'HasMany') {
            $this->HasMany = [];
        } elseif ($option === 'casts') {
            $this->casts = [];
        } elseif ($option === 'filters') {
            $this->filters = null;
        } elseif ($option === 'models') {
            $this->models = [];
        } elseif ($option === 'sortable') {
            $this->sortable = [];
        } elseif ($option === 'create') {
            $this->create = null;
        } elseif ($option === 'uses') {
            $this->uses = [];
        }

        return $this;
    }

    /**
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options = []): self
    {
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        // ]);
        parent::setOptions($options);

        if (array_key_exists('playground', $options)) {
            $this->playground = ! empty($options['playground']);
        }

        if (array_key_exists('revision', $options)) {
            $this->revision = ! empty($options['revision']);
        }

        if (array_key_exists('perPage', $options)) {
            $this->perPage = null;
            if (! empty($options['perPage']) && is_numeric($options['perPage']) && $options['perPage'] > 0) {
                $this->perPage = intval($options['perPage']);
            }
        }

        if (! empty($options['model'])
            && is_string($options['model'])
        ) {
            $this->model = $options['model'];
        }

        if (! empty($options['model_attribute'])
            && is_string($options['model_attribute'])
        ) {
            $this->model_attribute = $options['model_attribute'];
        }

        if (array_key_exists('model_attribute_required', $options)) {
            $this->model_attribute_required = ! empty($options['model_attribute_required']);
        }

        if (! empty($options['model_plural'])
            && is_string($options['model_plural'])
        ) {
            $this->model_plural = $options['model_plural'];
        }

        if (! empty($options['model_singular'])
            && is_string($options['model_singular'])
        ) {
            $this->model_singular = $options['model_singular'];
        }

        if (! empty($options['model_slug'])
            && is_string($options['model_slug'])
        ) {
            $this->model_slug = $options['model_slug'];
        }

        if (! empty($options['model_slug_plural'])
            && is_string($options['model_slug_plural'])
        ) {
            $this->model_slug_plural = $options['model_slug_plural'];
        }

        if (! empty($options['recipe'])
            && is_string($options['recipe'])
        ) {
            $this->recipe = $options['recipe'];
        }

        if (! empty($options['type'])
            && is_string($options['type'])
        ) {
            $this->type = $options['type'];
        }

        if (! empty($options['table'])
            && is_string($options['table'])
        ) {
            $this->table = $options['table'];
        }

        // $this->addExtends($options);
        $this->addComponents($options);
        $this->addImplements($options);
        $this->addRelationships($options);
        $this->addModelProperties($options);
        $this->addSorting($options);
        $this->addScopes($options);
        $this->addFilters($options);
        $this->addModels($options);

        // Create should be called after other options are set.
        if (! empty($options['create'])
            && is_array($options['create'])
        ) {
            $this->addCreate($options);
        }

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function attributes(): array
    {
        return $this->attributes;
    }

    public function playground(): bool
    {
        return $this->playground;
    }

    public function revision(): bool
    {
        return $this->revision;
    }

    public function perPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @return array<string, mixed>
     */
    public function casts(): array
    {
        return $this->casts;
    }

    /**
     * @return array<int, string>
     */
    public function fillable(): array
    {
        return $this->fillable;
    }

    public function recipe(): string
    {
        return $this->recipe;
    }

    public function table(): string
    {
        return $this->table;
    }

    public function module_slug(): string
    {
        return $this->module_slug;
    }

    public function model_attribute(): string
    {
        return $this->model_attribute;
    }

    public function model_attribute_required(): bool
    {
        return $this->model_attribute_required;
    }

    public function model_plural(): string
    {
        return $this->model_plural;
    }

    public function model_singular(): string
    {
        return $this->model_singular;
    }

    public function model_slug(): string
    {
        return $this->model_slug;
    }

    public function model_slug_plural(): string
    {
        return $this->model_slug_plural;
    }

    public function getRecipe(): ?ModelRecipe
    {
        $recipe = null;
        /**
         * @var array<string, class-string<ModelRecipe>> $recipes
         */
        $recipes = config('playground-make-model.recipes');

        $key = $this->recipe();

        if ($key && is_array($recipes) && ! empty($recipes[$key]) && class_exists($recipes[$key])) {
            $recipe = new $recipes[$key]($this->name, $this->type);
        }

        return $recipe;
    }
}
