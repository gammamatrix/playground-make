<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Configuration\Contracts;

/**
 * \Playground\Make\Configuration\Contracts\PrimaryConfiguration
 */
interface PrimaryConfiguration
{
    public function class(): string;

    public function setClass(string $class): self;

    public function config(): string;

    public function setConfig(string $config): self;

    public function fqdn(): string;

    public function setFqdn(string $fqdn): self;

    /**
     * @return array<string, class-string>
     */
    public function implements(): array;

    public function model(): string;

    public function resetModel(string $model): self;

    public function setModel(string $model): self;

    public function model_fqdn(): string;

    public function setModelFqdn(string $model_fqdn): self;

    public function model_camel(): string;

    public function model_camels(): string;

    public function model_kebab(): string;

    public function model_kebabs(): string;

    public function model_label(): string;

    public function model_labels(): string;

    public function model_lower(): string;

    public function model_lowers(): string;

    public function model_route_param(): string;

    public function model_slug(): string;

    public function model_slugs(): string;

    public function model_snake(): string;

    public function model_snakes(): string;

    public function model_studly(): string;

    public function model_studlies(): string;

    public function model_variable(): string;

    public function model_variables(): string;

    /**
     * @return array<string, string>
     */
    public function models(): array;

    public function module(): string;

    public function setModule(string $module): self;

    public function module_label(): string;

    public function setModuleLabel(string $module): self;

    public function module_labels(): string;

    public function setModuleLabels(string $module): self;

    public function module_route(): string;

    public function setModuleRoute(string $module): self;

    public function module_slug(): string;

    public function module_slugs(): string;

    public function setModuleSlug(string $module_slug): self;

    public function setModuleSlugs(string $module_slugs): self;

    public function name(): string;

    public function setName(string $name): self;

    public function names(): string;

    public function setNames(string $name): self;

    public function namespace(): string;

    public function setNamespace(string $namespace): self;

    public function organization(): string;

    public function setOrganization(string $organization): self;

    public function package(): string;

    public function setPackage(string $package): self;

    public function playground(): bool;

    public function type(): string;

    public function setType(string $type): self;

    public function apply(): self;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @return array<string, mixed>
     */
    public function properties(): array;

    /**
     * @param  array<mixed, mixed>  $options
     */
    public function setOptions(array $options = []): self;

    /**
     * @return array<int, class-string>
     */
    public function uses(): array;

    public function extends_use(): string;
}
