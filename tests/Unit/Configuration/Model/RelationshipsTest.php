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
use Playground\Make\Configuration\Model\Concerns\Relationships;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\RelationshipsTest
 */
#[CoversClass(Model::class)]
#[CoversTrait(Relationships::class)]
class RelationshipsTest extends TestCase
{
    public function test_addRelationships_for_HasOne_with_invalid_accessor(): void
    {
        $instance = new Model([
            'name' => 'SomeModel',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

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

    public function test_addRelationships_for_HasMany_with_invalid_accessor(): void
    {
        $instance = new Model([
            'name' => 'SomeModel',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

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

    public function test_addHasOne_without_meta(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertInstanceOf(Model::class, $instance);

        $this->assertEmpty($instance->HasOne());
        $instance->addHasOne('someAccessor', null);
        $this->assertNotEmpty($instance->HasOne());
        // dump($instance);
    }

    public function test_addHasMany_without_meta(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertInstanceOf(Model::class, $instance);

        // dump($instance);
        $this->assertEmpty($instance->HasMany());
        $instance->addHasMany('someAccessor', null);
        $this->assertNotEmpty($instance->HasMany());
    }
}
