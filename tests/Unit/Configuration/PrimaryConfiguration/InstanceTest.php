<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Configuration\PrimaryConfiguration;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use Tests\Unit\Playground\Make\TestCase;
use Playground\Make\Configuration\PrimaryConfiguration;
use Playground\Make\Configuration\Concerns\Properties;

/**
 * \Tests\Unit\Playground\Make\Configuration\PrimaryConfiguration\InstanceTest
 */
#[CoversClass(PrimaryConfiguration::class)]
#[CoversTrait(Properties::class)]
class InstanceTest extends TestCase
{
    public function test_instance(): void
    {
        $instance = new PrimaryConfiguration;

        $this->assertInstanceOf(PrimaryConfiguration::class, $instance);
    }

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

    public function test_instance_apply_without_options(): void
    {
        $instance = new PrimaryConfiguration;

        $properties = $instance->apply()->properties();

        $this->assertIsArray($properties);

        $this->assertSame($this->expected_properties, $properties);

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($properties, $jsonSerialize);
    }

    public function test_folder_is_empty_by_default(): void
    {
        $instance = new PrimaryConfiguration;

        $this->assertInstanceOf(PrimaryConfiguration::class, $instance);

        $this->assertIsString($instance->folder());
        $this->assertEmpty($instance->folder());
    }

    public function test_folder_with_empty_setFolder(): void
    {
        $instance = new PrimaryConfiguration();

        $this->assertInstanceOf(PrimaryConfiguration::class, $instance);

        $this->assertIsString($instance->setFolder()->folder());
        $this->assertEmpty($instance->folder());
    }

    public function test_folder_with_path_for_setFolder(): void
    {
        $instance = new PrimaryConfiguration();

        $this->assertInstanceOf(PrimaryConfiguration::class, $instance);

        $this->assertIsString($instance->setFolder('/tmp')->folder());
        $this->assertNotEmpty($instance->folder());
        $this->assertSame('/tmp', $instance->folder());
    }
}
