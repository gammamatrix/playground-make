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
use Playground\Make\Configuration\Model\Concerns\Scopes;
use TiMacDonald\Log\LogEntry;
use TiMacDonald\Log\LogFake;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\ScopesTest
 */
#[CoversClass(Model::class)]
#[CoversTrait(Scopes::class)]
class ScopesTest extends TestCase
{
    public function test_addScopes_with_sort(): void
    {
        $instance = new Model([
            'name' => 'SomeModel',
        ]);

        $this->assertInstanceOf(Model::class, $instance);

        $options = [
            'scopes' => [
                'sort' => [
                    'include' => 'minus',
                    'builder' => 'CustomBuilder',
                ],
            ],
        ];


        $this->assertEmpty($instance->scopes());
        $instance->addScopes($options);
        $this->assertNotEmpty($instance->scopes());
    }

    public function test_addScope_with_invalid_scope(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertInstanceOf(Model::class, $instance);

        $this->assertEmpty($instance->scopes());

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(__('playground-make::model.Scope.invalid', [
            'name' => 'SomeModel',
            'scope' => 'NULL',
        ]));
        $instance->addScope(null, null);
    }

    public function test_addScope_for_sort_without_meta(): void
    {
        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertInstanceOf(Model::class, $instance);

        $this->assertEmpty($instance->scopes());
        $instance->addScope('sort', null);
        // dump($instance);
        $this->assertNotEmpty($instance->scopes());
    }

    public function test_addScope_unsupported_scope_and_ignore(): void
    {
        $log = LogFake::bind();

        $withSkeleton = true;
        $instance = new Model([
            'name' => 'SomeModel',
        ], $withSkeleton);

        $this->assertInstanceOf(Model::class, $instance);

        // dump($instance);
        $this->assertEmpty($instance->scopes());
        $instance->addScope('someScope', null);
        $this->assertEmpty($instance->scopes());

        // $log->dump();

        $log->assertLogged(
            fn (LogEntry $log) => $log->level === 'warning'
        );

        $log->assertLogged(
            fn (LogEntry $log) => is_string($log->message) && str_contains(
                $log->message,
                __('playground-make::model.Scope.ignored', [
                    'name' => 'SomeModel',
                    'scope' => 'NULL',
                ])
            )
        );
    }
}
