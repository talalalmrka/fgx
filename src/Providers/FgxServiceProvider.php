<?php

namespace Fgx\Providers;

use Fgx\FgxTagCompiler;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class FgxServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/fgx.php', 'fgx');
    }

    public function boot()
    {
        $this->registerViews();
        $this->registerComponents();
        $this->registerDirectives();
        $this->registerPublishes();
        $this->bootTagCompiler();
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'fgx');
    }
    protected function registerComponents()
    {
        $componentPath = __DIR__ . '/../../resources/views/components';
        Blade::componentNamespace('Fgx\\Components', 'fgx');
        Blade::anonymousComponentPath($componentPath, 'fgx');
        Blade::component("fgx::components.button", "fgx-button");
        /*if (!File::exists($componentPath)) {
            return;
        }

        foreach (File::files($componentPath) as $file) {
            $componentName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

            Blade::component(
                "fgx::components.{$componentName}", // View path
                "fgx-{$componentName}" // Tag name
            );
        }*/
    }

    protected function registerDirectives()
    {
        Blade::directive('icon', function ($class = null) {
            return "<?php icon($class);?>";
        });

        Blade::directive('content', function ($expression) {
            return "<?php content($expression); ?>";
        });
        Blade::directive('pre', function ($data, $class = '') {
            return "<?php pre($data, $class); ?>";
        });
    }

    protected function registerPublishes()
    {
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/fgx')], 'views');
        $this->publishes([__DIR__ . '/../../config/fgx.php' => config_path('fgx.php')], 'config');
    }
    public function bootTagCompiler()
    {
        $compiler = new FgxTagCompiler(
            app('blade.compiler')->getClassComponentAliases(),
            app('blade.compiler')->getClassComponentNamespaces(),
            app('blade.compiler')
        );

        app()->bind('fgx.compiler', fn() => $compiler);

        app('blade.compiler')->precompiler(function ($in) use ($compiler) {
            return $compiler->compile($in);
        });
    }
}