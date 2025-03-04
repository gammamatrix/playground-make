<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Configuration\Configuration;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use Tests\Unit\Playground\Make\TestCase;
use Playground\Make\Configuration\Configuration;
use Playground\Make\Configuration\Concerns\Properties;

/**
 * \Tests\Unit\Playground\Make\Configuration\Configuration\PropertiesTest
 */
#[CoversClass(Configuration::class)]
#[CoversTrait(Properties::class)]
class PropertiesTest extends TestCase
{
    /**
     * @var array<string, mixed>
     */
    protected array $expected_properties = [];

    public function test_properties(): void
    {
        $instance = new Configuration;

        $this->assertInstanceOf(Configuration::class, $instance);

        $properties = $instance->apply()->properties();

        $this->assertIsArray($properties);

        $this->assertSame($this->expected_properties, $properties);

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($properties, $jsonSerialize);
    }

    public function test_properties_with_all_options_without_apply(): void
    {
        $options = [
            'type' => 'some-type',
        ];

        $instance = new Configuration($options);
        // dump($instance);

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($this->expected_properties, $jsonSerialize);

        $this->assertSame($options['type'], $instance->type());
    }

    public function test_properties_with_all_options_with_apply(): void
    {
        $options = [
            'type' => 'request',
        ];

        $instance = new Configuration($options);
        $instance->apply();

        $jsonSerialize = $instance->jsonSerialize();

        $this->assertIsArray($jsonSerialize);

        $this->assertSame($this->expected_properties, $jsonSerialize);

        $this->assertSame($options['type'], $instance->type());

        $this->assertNotSame($options, $jsonSerialize);
    }
}
