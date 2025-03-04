<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Console\Commands\Concerns;

use function Laravel\Prompts\text;

/**
 * \Playground\Make\Console\Commands\Concerns\InteractiveCommands
 */
trait InteractiveCommands
{
    protected bool $interactive = true;

    /**
     * @var array<string, mixed>
     */
    protected $prompts = [
        'namespace' => [],
        'organization' => [],
        'package' => [],
        'name' => [],
    ];

    protected function interactive(): string
    {
        $name = '';

        if (array_key_exists('name', $this->prompts)) {
            $name = $this->interactivePromptForName();
            if (empty($name)) {
                return '';
            }
        }

        if (array_key_exists('namespace', $this->prompts)) {
            $this->interactivePromptForNamespace();
        }

        if (array_key_exists('organization', $this->prompts)) {
            $this->interactivePromptForOrganization();
        }

        if (array_key_exists('package', $this->prompts)) {
            $this->interactivePromptForPackage();
        }

        return $name;
    }

    protected function interactivePromptInput(
        string $label,
        string $placeholder = '',
        string $default = '',
        string $hint = ''
    ): string {
        $input = text(
            label: $label,
            placeholder: $placeholder,
            default: $default,
            hint: $hint
        );

        return empty($input) || strtolower($input) === 'cancel' ? '' : $input;
    }

    protected function interactivePromptForName(): string
    {
        return $this->interactivePromptInput(
            'What should the '.strtolower($this->type).' be named?',
            match ($this->type) {
                'Cast' => 'E.g. Json',
                'Channel' => 'E.g. OrderChannel',
                'Console command' => 'E.g. SendEmails',
                'Component' => 'E.g. Alert',
                'Controller' => 'E.g. UserController',
                'Event' => 'E.g. PodcastProcessed',
                'Exception' => 'E.g. InvalidOrderException',
                'Factory' => 'E.g. PostFactory',
                'Job' => 'E.g. ProcessPodcast',
                'Listener' => 'E.g. SendPodcastNotification',
                'Mailable' => 'E.g. OrderShipped',
                'Middleware' => 'E.g. EnsureTokenIsValid',
                'Model' => 'E.g. Flight',
                'Notification' => 'E.g. InvoicePaid',
                'Observer' => 'E.g. UserObserver',
                'Package' => 'E.g. Acme/Orders',
                'Policy' => 'E.g. PostPolicy',
                'Provider' => 'E.g. ElasticServiceProvider',
                'Request' => 'E.g. StorePodcastRequest',
                'Resource' => 'E.g. UserResource',
                'Rule' => 'E.g. Uppercase',
                'Scope' => 'E.g. TrendingScope',
                'Seeder' => 'E.g. UserSeeder',
                'Test' => 'E.g. UserTest',
                default => '',
            },
            '',
            'This will be turned into a class name.'
        );
    }

    protected function interactivePromptForNamespace(): string
    {
        $namespace = $this->interactivePromptInput(
            'What namespace should be used?',
            'App',
            $this->getConfigurationByKeyAsString('namespace', 'App'),
            'The default namespace is for the Laravel application.'
        );

        $this->setConfigurationByKey('namespace', $namespace);

        return $namespace;
    }

    protected function interactivePromptForOrganization(): string
    {
        $organization = $this->interactivePromptInput(
            'What organization should be used?',
            'App',
            $this->getConfigurationByKeyAsString('organization'),
            'Use a short name.'
        );

        $this->setConfigurationByKey('organization', $organization);

        return $organization;
    }

    protected function interactivePromptForPackage(): string
    {
        $package = $this->interactivePromptInput(
            'What package should be used?',
            'app',
            $this->getConfigurationByKeyAsString('package'),
            'Use a packagist safe slug.'
        );

        $this->setConfigurationByKey('package', $package);

        return $package;
    }
}
