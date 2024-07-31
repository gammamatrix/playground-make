<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Configuration\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use Tests\Unit\Playground\Make\TestCase;
use Playground\Make\Configuration\Model;
use Playground\Make\Configuration\Model\Concerns\Attributes;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\AttributesTest
 */
#[CoversClass(Model::class)]
#[CoversTrait(Attributes::class)]
class AttributesTest extends TestCase
{
    public function test_addModelProperties_with_empty_options(): void
    {
        $instance = new Model;

        $this->assertInstanceOf(Model::class, $instance);

        $options = [];

        $instance->addModelProperties($options);

        $this->assertEmpty($instance->attributes());
        $this->assertEmpty($instance->casts());
        $this->assertEmpty($instance->fillable());
    }

    public function test_addAttribute_with_invalid_column(): void
    {
        $instance = new Model([
            // 'name' => 'model',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

        $column = null;
        $value = false;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Attributes.invalid', [
            'name' => 'model',
            'column' => 'NULL',
        ]));

        $instance->addAttribute($column, $value);
    }

    public function test_addAttribute_with_invalid_default_value_of_array(): void
    {
        $instance = new Model([
            // 'name' => 'model',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

        $column = 'some_column';
        $value = ['arrays-are-not-allowed'];

        $instance->addAttribute($column, $value);

        $attributes = $instance->attributes();
        $this->assertArrayHasKey($column, $attributes);
        $this->assertEmpty($attributes[$column]);
    }

    public function test_addCast_with_invalid_column_and_set_empty_string(): void
    {
        $instance = new Model([
            'name' => 'Widget',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

        $column = true;
        $value = false;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Casts.invalid', [
            'name' => 'Widget',
            'column' => 'boolean',
        ]));

        $instance->addCast($column, $value);
    }

    public function test_addCast_with_invalid_cast_value_and_treat_as_string(): void
    {
        $instance = new Model([
            'name' => 'Widget',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

        $column = 'some_column';
        $value = false;

        $instance->addCast($column, $value);
        $casts = $instance->casts();
        $this->assertArrayHasKey($column, $casts);
        $this->assertSame('string', $casts[$column]);
    }

    public function test_addFillable_with_invalid_column(): void
    {
        $instance = new Model([
            'name' => 'Thing',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

        $column = ['invalid-stuff'];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Fillable.invalid', [
            'name' => 'Thing',
            'column' => 'array',
        ]));

        $instance->addFillable($column);
    }
}
