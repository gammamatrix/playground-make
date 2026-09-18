<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Make\Configuration\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversTrait;
use Playground\Make\Configuration\Model;
use Playground\Make\Configuration\Model\Concerns\Sorting;
use Tests\Unit\Playground\Make\TestCase;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\SortingTest
 */
#[CoversClass(Model::class)]
#[CoversTrait(Sorting::class)]
class SortingTest extends TestCase
{
    public function test_add_sortable_without_column(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertEmpty($instance->scopes());

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs(__('playground-make::model.Sorting.invalid', [
            'name' => 'SomeModel',
            'i' => '-',
        ]));
        $instance->addSortable(null, null);
    }

    public function test_add_sortable_with_index(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertEmpty($instance->sortable());
        $instance->addSortable([
            'column' => 'some_column',
        ], 1);
        $sortable = $instance->sortable();
        $this->assertIsArray($sortable);
        $this->assertArrayHasKey(1, $sortable);
        $this->assertInstanceOf(Model\Sortable::class, $sortable[1]);
    }

    public function test_add_sortable_without_index(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertEmpty($instance->sortable());
        $instance->addSortable([
            'column' => 'some_column',
        ]);
        $sortable = $instance->sortable();
        $this->assertIsArray($sortable);
        $this->assertArrayHasKey(0, $sortable);
        $this->assertInstanceOf(Model\Sortable::class, $sortable[0]);
    }
}
