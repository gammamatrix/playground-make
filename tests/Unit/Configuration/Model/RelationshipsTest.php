<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Make\Configuration\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use Playground\Make\Configuration\Model;
use Playground\Make\Configuration\Model\Concerns\Relationships;
use Tests\Unit\Playground\Make\TestCase;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\RelationshipsTest
 */
#[CoversClass(Model::class)]
#[CoversTrait(Relationships::class)]
class RelationshipsTest extends TestCase
{
    public function test_add_relationships_for_has_one_with_invalid_accessor(): void
    {
        $instance = new Model([
            'name' => 'SomeModel',
        ]);

        $options = [
            'HasOne' => [
                'ownedBy' => [

                ],
                2 => 'HasOne',
            ],
        ];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.HasOne.invalid', [
            'name' => 'SomeModel',
            'accessor' => 'integer',
        ]));

        $instance->addRelationships($options);
    }

    public function test_add_relationships_for_has_many_with_invalid_accessor(): void
    {
        $instance = new Model([
            'name' => 'SomeModel',
        ]);

        $options = [
            'HasMany' => [
                'ownedBy' => [
                    'comment' => 'comment',
                    'related' => 'related',
                    'foreignKey' => 'foreignKey',
                    'localKey' => 'localKey',
                ],
                'HasMany',
            ],
        ];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.HasMany.invalid', [
            'name' => 'SomeModel',
            'accessor' => 'integer',
        ]));

        $instance->addRelationships($options);
    }

    public function test_add_has_one_without_meta(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertEmpty($instance->HasOne());
        $instance->addHasOne('someAccessor', null);
        $this->assertNotEmpty($instance->HasOne());
        // dump($instance);
    }

    public function test_add_has_many_without_meta(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        // dump($instance);
        $this->assertEmpty($instance->HasMany());
        $instance->addHasMany('someAccessor', null);
        $this->assertNotEmpty($instance->HasMany());
    }
}
