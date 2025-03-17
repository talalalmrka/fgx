<?php

namespace Fgx\Tests\Feature;

use Orchestra\Testbench\TestCase;

class FgxTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Fgx\Providers\FgxServiceProvider'];
    }

    public function test_service_provider_registered()
    {
        $this->assertTrue($this->app->providerIsLoaded(Fgx\Providers\FgxServiceProvider::class));
    }

    public function test_button_component_rendering()
    {
        $view = $this->blade('<x-fgx-button type="primary">Test</x-fgx-button>');
        $view->assertSee('bg-blue-600');
    }

    public function test_config_publishing()
    {
        $this->artisan('vendor:publish', ['--tag' => 'fgx-assets']);
        $this->assertFileExists(config_path('fgx.php'));
    }
}