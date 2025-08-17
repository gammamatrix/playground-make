<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Make\Configuration\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use Playground\Make\Configuration\Model;
use Playground\Make\Configuration\Model\Concerns\Attributes;
use Tests\Unit\Playground\Make\TestCase;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\AttributesTest
 */
#[CoversClass(Model::class)]
#[CoversTrait(Attributes::class)]
class AttributesTest extends TestCase
{
    public function test_add_model_properties_with_empty_options(): void
    {
        $instance = new Model;

        /** @phpstan-ignore method.alreadyNarrowedType */
        $this->assertInstanceOf(Model::class, $instance);

        $options = [];

        $instance->addModelProperties($options);

        $this->assertEmpty($instance->attributes());
        $this->assertEmpty($instance->casts());
        $this->assertEmpty($instance->fillable());
    }

    public function test_add_attribute_with_invalid_column(): void
    {
        $instance = new Model([
            // 'name' => 'model',
        ]);

        $column = null;
        $value = false;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Attributes.invalid', [
            'name' => 'model',
            'column' => 'NULL',
        ]));

        $instance->addAttribute($column, $value);
    }

    public function test_add_attribute_with_invalid_default_value_of_array(): void
    {
        $instance = new Model([
            // 'name' => 'model',
        ]);

        $column = 'some_column';
        $value = ['arrays-are-not-allowed'];

        $instance->addAttribute($column, $value);

        $attributes = $instance->attributes();
        $this->assertArrayHasKey($column, $attributes);
        $this->assertEmpty($attributes[$column]);
    }

    public function test_add_cast_with_invalid_column_and_set_empty_string(): void
    {
        $instance = new Model([
            'name' => 'Widget',
        ]);

        $column = true;
        $value = false;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Casts.invalid', [
            'name' => 'Widget',
            'column' => 'boolean',
        ]));

        $instance->addCast($column, $value);
    }

    public function test_add_cast_with_invalid_cast_value_and_treat_as_string(): void
    {
        $instance = new Model([
            'name' => 'Widget',
        ]);

        $column = 'some_column';
        $value = false;

        $instance->addCast($column, $value);
        $casts = $instance->casts();
        $this->assertArrayHasKey($column, $casts);
        $this->assertSame('string', $casts[$column]);
    }

    public function test_add_fillable_with_invalid_column(): void
    {
        $instance = new Model([
            'name' => 'Thing',
        ]);

        $column = ['invalid-stuff'];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Fillable.invalid', [
            'name' => 'Thing',
            'column' => 'array',
        ]));

        $instance->addFillable($column);
    }
}
