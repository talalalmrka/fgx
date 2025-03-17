<?php

namespace Fgx\Tests\Feature;

use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase;

class InputComponentTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Fgx\Providers\FgxServiceProvider'];
    }

    public function test_input_rendering()
    {
        $view = $this->blade(<<<'BLADE'
            <x-fgx-input 
                name="email" 
                label="Email Address" 
                type="email" 
                required
            />
        BLADE);

        $view->assertSee('Email Address')
            ->assertSee('type="email"')
            ->assertSee('required');
    }

    public function test_error_display()
    {
        $errors = ['email' => 'The email field is required.'];
        View::share('errors', \Illuminate\Support\Facades\Validator::make([], [])->errors());

        $view = $this->blade(<<<'BLADE'
            <x-fgx-input 
                name="email" 
                error="The email field is required."
            />
        BLADE);

        $view->assertSee('border-red-300')
            ->assertSee('The email field is required.');
    }
}