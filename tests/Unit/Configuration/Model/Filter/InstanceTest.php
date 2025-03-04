<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make\Configuration\Model\Filter;

use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\Playground\Make\TestCase;
use Playground\Make\Configuration\Model;

/**
 * \Tests\Unit\Playground\Make\Configuration\Model\InstanceTest
 */
#[CoversClass(Model\Filter::class)]
class InstanceTest extends TestCase
{
    public function test_instance(): void
    {
        $instance = new Model\Filter;

        $this->assertInstanceOf(Model\Filter::class, $instance);
    }

    public function test_instance_apply_without_options(): void
    {
        $parent = new Model\Filters;
        $instance = new Model\Filter;

        $instance->setParent($parent);

        $this->assertSame($parent, $instance->getParent());
    }
}
