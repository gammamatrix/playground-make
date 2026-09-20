<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Building\Concerns;

use Illuminate\Support\Str;
use Playground\Make\Configuration\Model;

/**
 * \Playground\Make\Building\Concerns\BuildModel
 */
trait BuildModel
{
    protected function buildClass_model(string $name): void
    {
        $model = $this->model?->model() ?? '';
        $model_attribute = '';
        if ($model) {
            $model_attribute = $this->model->model_attribute() ?: 'title';
        }

        if (Str::camel($model) === 'user') {
            // TODO is this user handling really necessary?
            $dummyModel = 'model';
        } else {
            $dummyModel = $model;
        }

        $fqdn = $this->model?->fqdn();

        $properties = [
            'model_fqdn' => $fqdn ?? '',
            'model_camel' => $this->model?->model_camel() ?: Str::of($dummyModel)->camel()->toString(),
            'model_camels' => $this->model?->model_camels() ?: Str::of($dummyModel)->plural()->camel()->toString(),
            'model_label' => $this->model?->model_label() ?: Str::of($dummyModel)->headline()->toString(),
            'model_labels' => $this->model?->model_labels() ?: Str::of($dummyModel)->headline()->plural()->toString(),
            'model_lower' => $this->model?->model_lower() ?: Str::of($dummyModel)->lower()->toString(),
            'model_lowers' => $this->model?->model_lowers() ?: Str::of($dummyModel)->lower()->plural()->toString(),
            'model_kebab' => $this->model?->model_kebab() ?: Str::of($dummyModel)->kebab()->toString(),
            'model_kebabs' => $this->model?->model_kebabs() ?: Str::of($dummyModel)->plural()->kebab()->toString(),
            'model_slug' => $this->model?->model_slug() ?: Str::of($dummyModel)->slug()->toString(),
            'model_slugs' => $this->model?->model_slugs() ?: Str::of($dummyModel)->slug()->plural()->toString(),
            'model_snake' => $this->model?->model_snake() ?: Str::of($dummyModel)->snake()->toString(),
            'model_snakes' => $this->model?->model_snakes() ?: Str::of($dummyModel)->plural()->snake()->toString(),
            'model_studly' => $this->model?->model_studly() ?: Str::of($dummyModel)->studly()->toString(),
            'model_studlies' => $this->model?->model_studlies() ?: Str::of($dummyModel)->plural()->studly()->toString(),
            'model_variable' => $this->model?->model_variable() ?: Str::of($dummyModel)->camel()->toString(),
            'model_variables' => $this->model?->model_variables() ?: Str::of($dummyModel)->camel()->plural()->toString(),
        ];

        $model_camel = $this->model?->model_camel() ?: Str::of($dummyModel)->camel()->toString();
        $model_camels = $this->model?->model_camels() ?: Str::of($dummyModel)->plural()->camel()->toString();
        $model_label = $this->model?->model_label() ?: Str::of($dummyModel)->headline()->toString();
        $model_labels = $this->model?->model_labels() ?: Str::of($dummyModel)->headline()->plural()->toString();
        $model_lower = $this->model?->model_lower() ?: Str::of($dummyModel)->lower()->toString();
        $model_lowers = $this->model?->model_lowers() ?: Str::of($dummyModel)->lower()->plural()->toString();
        $model_kebab = $this->model?->model_kebab() ?: Str::of($dummyModel)->kebab()->toString();
        $model_kebabs = $this->model?->model_kebabs() ?: Str::of($dummyModel)->plural()->kebab()->toString();
        $model_slug = $this->model?->model_slug() ?: Str::of($dummyModel)->slug()->toString();
        $model_slugs = $this->model?->model_slugs() ?: Str::of($dummyModel)->slug()->plural()->toString();
        $model_snake = $this->model?->model_snake() ?: Str::of($dummyModel)->snake()->toString();
        $model_snakes = $this->model?->model_snakes() ?: Str::of($dummyModel)->plural()->snake()->toString();
        $model_studly = $this->model?->model_studly() ?: Str::of($dummyModel)->studly()->toString();
        $model_studlies = $this->model?->model_studlies() ?: Str::of($dummyModel)->plural()->studly()->toString();
        $model_variable = $this->model?->model_variable() ?: Str::of($dummyModel)->camel()->toString();
        $model_variables = $this->model?->model_variables() ?: Str::of($dummyModel)->camel()->plural()->toString();
        //         if (!empty($model)) {
        //            dd([
        //                '__METHOD__' => __METHOD__,
        //                '$name' => $name,
        //                '$properties' => $properties,
        //                //'$this->model' => $this->model->toArray(),
        // //                '$this->c->type()' => $this->c->type(),
        // //                '$this->model->module()' => $this->model->module(),
        // //                '$this->model->module_slug()' => $this->model->module_slug(),
        // //                '$this->model->module_slugs()' => $this->model->module_slugs(),
        // //                '$dummyModel' => $dummyModel,
        // //                '$model' => $model,
        // //                '$model_label' => $model_label,
        // //                '$model_labels' => $model_labels,
        // //                '$this->model?->model_labels()' => $this->model?->model_labels(),
        // //                'model_labels' => Str::of($dummyModel)->headline()->plural()->toString(),
        //            ]);
        //         }

        foreach ($properties as $property => $value) {
            if (in_array($property, [
                'model_fqdn',
            ])) {
                $this->searches[$property] = $this->parseClassInput($value);
            } else {
                $this->searches[$property] = $value;
            }
        }

        $this->c->setOptions($properties)->apply();
        // TODO some of these will be empty without a model file.

        $this->searches['namespacedModel'] = $this->parseClassInput($fqdn);
        $this->searches['NamespacedDummyModel'] = $this->parseClassInput($fqdn);

        $this->searches['DummyModel'] = $model;
        $this->searches['model'] = $model;
        $this->searches['dummyModel'] = $model_camel;
        $this->searches['modelVariable'] = $model_variable;
        $this->searches['modelSlugPlural'] = $model_slugs;
        $this->searches['modelVariablePlural'] = $model_variables;
        $this->searches['model_variable_plural'] = $model_variables;

        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$name' => $name,
        //            '$model' => $model,
        //            '$model_label' => $model_label,
        //            '$model_labels' => $model_labels,
        //            '$this->configurationType' => $this->configurationType,
        //            // '$modelConfiguration' => $modelConfiguration,
        //            '$this->option(model-file)' => $this->option('model-file'),
        //            '$this->searches' => $this->searches,
        //            '$this->type' => $this->type,
        //        ]);

        if (empty($model)
            && $this->hasOption('model')
            && $this->option('model')
            && is_string($this->option('model'))
        ) {
            $model = $this->option('model');
        }

        if (empty($model) && $this->c->model()) {
            $model = $this->c->model();
        }

        if (empty($model) || ! is_string($model)) {
            return;
        }

        if (! $fqdn) {
            $fqdn = $model;
        }

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$name' => $name,
        //     '$model' => $model,
        // ]);

        // $model = class_basename(trim($model, '\\'));

        $userProviderModel = $this->userProviderModel();
        $dummyUser = ! is_string($userProviderModel) ? 'DummyUser' : class_basename($userProviderModel);

        $this->searches['modelLabel'] = $model_label;

        $this->searches['DummyUser'] = $dummyUser;
        $this->searches['user'] = $dummyUser;
        $this->searches['$user'] = '$'.Str::camel($dummyUser);

        $this->searches['model_attribute'] = $model_attribute;
        $this->searches['model_label'] = $model_label;
        $this->searches['model_label_plural'] = $model_labels;

        if (method_exists($this->c, 'privilege')) {
            $this->searches['module_privilege'] = $this->c->privilege();
        }

        $this->searches['model_slug'] = $this->searches['modelVariable'];
        $this->searches['slug_plural'] = $this->searches['modelSlugPlural'];
        $this->searches['model_slug_plural'] = $this->searches['modelSlugPlural'];
        $this->searches['module_label'] = $this->searches['module'];
        if (ctype_upper($this->searches['module'])) {
            $this->searches['module_label_plural'] = Str::of($this->searches['module'])->finish('s')->toString();
        } else {
            $this->searches['module_label_plural'] = Str::of($this->searches['module'])->plural()->toString();
        }

        if (empty($this->searches['module_route']) && ! empty($this->searches['route'])) {
            $this->searches['module_route'] = Str::of($this->searches['route'])->beforeLast('.')->toString();
        }
        // $this->searches['module_slug'] = $dummyUser;
        // $this->searches['table'] = $dummyUser;
        // $this->searches['view'] = $dummyUser;

        if (empty($this->searches['table']) || ! is_string($this->searches['table'])) {
            if (! empty($this->configuration['table']) && is_string($this->configuration['table'])) {
                $this->searches['table'] = $this->configuration['table'];
            }
            if (empty($this->searches['table'])
                && $this->model?->table()
            ) {
                $this->searches['table'] = $this->model->table();
            }
        }

        // dd([
        //    '__METHOD__' => __METHOD__,
        //    'exists' => ! empty($this->model),
        //    '$model' => $model,
        //    '$this->searches' => $this->searches,
        //    'static' => static::class,
        // ]);
    }

    /**
     * @return ?array<string, mixed>
     */
    protected function buildClass_model_meta(
        string $column,
        Model $model
    ): ?array {
        if (empty($model->create())) {
            return null;
        }

        $sections = [
            'ids',
            'dates',
            'permissions',
            'status',
            'ui',
            'flags',
            'columns',
            'matrix',
            'json',
        ];

        foreach ($sections as $section) {
            if (! empty($model->create()->{$section}())
                && ! empty($model->create()->{$section}()[$column])
            ) {
                return $model->create()->{$section}()[$column]->toArray();
            }
        }

        return null;
    }
}
