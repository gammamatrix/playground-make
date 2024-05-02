<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Configuration\Configuration;

use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\Playground\Make\TestCase;
use Playground\Make\Configuration\Configuration;
use Playground\Make\Configuration\Concerns\Properties;

/**
 * \Tests\Unit\Playground\Make\Configuration\Configuration\InstanceTest
 */
#[CoversClass(Configuration::class)]
#[CoversClass(Properties::class)]
class InstanceTest extends TestCase
{
    public function test_instance(): void
    {
        $instance = new Configuration;

        $this->assertInstanceOf(Configuration::class, $instance);
    }

    /**
     * @var array<string, mixed>
     */
    protected array $expected_properties = [];

    public function test_instance_apply_without_options(): void
    {
        $instance = new Configuration;

        $properties = $instance->apply()->properties();

        $this->assertIsArray($properties);

        $this->assertSame($this->expected_properties, $properties);

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($properties, $jsonSerialize);
    }
}