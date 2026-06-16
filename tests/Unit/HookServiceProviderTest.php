<?php

defined('ABSPATH') || exit;

declare(strict_types=1);

namespace WPZylos\Framework\Hooks\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WPZylos\Framework\Hooks\HookServiceProvider;

/**
 * Tests for HookServiceProvider.
 */
class HookServiceProviderTest extends TestCase
{
    public function testProviderIsInstantiable(): void
    {
        $provider = new HookServiceProvider();
        $this->assertInstanceOf(HookServiceProvider::class, $provider);
    }
}
