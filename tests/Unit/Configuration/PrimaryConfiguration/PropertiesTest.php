<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Configuration\PrimaryConfiguration;

use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\Playground\Make\TestCase;
use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Tests\Unit\Playground\Make\Configuration\PrimaryConfiguration\PropertiesTest
 */
#[CoversClass(PrimaryConfiguration::class)]
class PropertiesTest extends TestCase
{
    /**
     * @var array<string, mixed>
     */
    protected array $expected_properties = [
        'class' => '',
        'config' => '',
        'extends' => '',
        'fqdn' => '',
        'extends_use' => '',
        'model' => '',
        'model_fqdn' => '',
        'module' => '',
        'module_slug' => '',
        'name' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        'playground' => false,
        'type' => '',
        // 'implements' => [],
        // 'models' => [],
        // 'uses' => [],
    ];

    public function test_properties(): void
    {
        $instance = new PrimaryConfiguration;

        $this->assertInstanceOf(PrimaryConfiguration::class, $instance);

        $properties = $instance->apply()->properties();

        $this->assertIsArray($properties);

        $expected_properties = $this->expected_properties;

        $this->assertSame($expected_properties, $properties);

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($properties, $jsonSerialize);
    }

    public function test_properties_with_all_options_without_apply(): void
    {
        $options = [
            'class' => 'SomeClassRequest',
            'config' => 'some-package',
            'extends' => 'SomeExtendedClass',
            'fqdn' => 'Acme\\SomeClass',
            'extends_use' => 'Illuminate/Foundation/Http/FormRequest',
            'model' => 'Something',
            'module' => 'Some',
            'module_slug' => 'some',
            'name' => 'Some',
            'namespace' => 'Acme',
            'organization' => 'Acme',
            'package' => 'some-package',
            'type' => 'request',
            'uses' => [
                'ImportantClass' => 'Acme\\ImportantClass',
                'Acme/AnotherImportantClass',
            ],
        ];

        $instance = new PrimaryConfiguration($options, true);
        // dump($instance);

        $this->assertTrue($instance->skeleton());

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $expected_properties = $this->expected_properties;
        $expected_properties['uses'] = [];
        $this->assertSame($expected_properties, $jsonSerialize);

        $this->assertSame($options['class'], $instance->class());
        $this->assertSame($options['config'], $instance->config());
        $this->assertSame($options['fqdn'], $instance->fqdn());
        $this->assertSame($options['model'], $instance->model());
        $this->assertSame($options['module'], $instance->module());
        $this->assertSame($options['module_slug'], $instance->module_slug());
        $this->assertSame($options['name'], $instance->name());
        $this->assertSame($options['namespace'], $instance->namespace());
        $this->assertSame($options['organization'], $instance->organization());
        $this->assertSame($options['package'], $instance->package());
        $this->assertSame($options['type'], $instance->type());
        $this->assertSame($options['uses'], $instance->uses());
        $this->assertSame($options['extends'], $instance->extends());
        $this->assertSame($options['extends_use'], $instance->extends_use());
    }

    public function test_properties_with_all_options_with_apply(): void
    {
        $options = [
            'class' => 'SomeClassRequest',
            'config' => 'some-package',
            'extends' => 'SomeExtendedClass',
            'fqdn' => 'Acme\\SomeClass',
            'extends_use' => 'Illuminate/Foundation/Http/FormRequest',
            'model' => 'Something',
            'model_fqdn' => '',
            'module' => 'Some',
            'module_slug' => 'some',
            'name' => 'Some',
            'namespace' => 'Acme',
            'organization' => 'Acme',
            'package' => 'some-package',
            'playground' => true,
            'type' => 'request',
            'uses' => [
                'ImportantClass' => 'Acme\\ImportantClass',
                'Acme/AnotherImportantClass',
            ],
        ];

        $instance = new PrimaryConfiguration($options, true);
        $instance->apply();

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertNotSame($this->expected_properties, $jsonSerialize);

        $this->assertTrue($instance->skeleton());

        $this->assertSame($options['class'], $instance->class());
        $this->assertSame($options['config'], $instance->config());
        $this->assertSame($options['fqdn'], $instance->fqdn());
        $this->assertSame($options['model'], $instance->model());
        $this->assertSame($options['module'], $instance->module());
        $this->assertSame($options['module_slug'], $instance->module_slug());
        $this->assertSame($options['name'], $instance->name());
        $this->assertSame($options['namespace'], $instance->namespace());
        $this->assertSame($options['organization'], $instance->organization());
        $this->assertSame($options['package'], $instance->package());
        $this->assertTrue($instance->playground());
        $this->assertSame($options['type'], $instance->type());
        $this->assertSame($options['uses'], $instance->uses());
        $this->assertSame($options['extends'], $instance->extends());
        $this->assertSame($options['extends_use'], $instance->extends_use());

        $this->assertSame($options, $jsonSerialize);
    }
}
