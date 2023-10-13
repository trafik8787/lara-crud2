<?php

namespace Trafik8787\laraCrud2\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Route;
use Trafik8787\laraCrud2\Admin;
use Trafik8787\laraCrud2\Console\Commands\InstallCommand;
use Trafik8787\laraCrud2\Console\Commands\InstallExample;
use Trafik8787\laraCrud2\Console\Commands\ModelGenerate;
use Trafik8787\laraCrud2\Console\Commands\NodeGenerate;
use Trafik8787\laraCrud2\Contracts\ActionTableInterface;
use Trafik8787\laraCrud2\Contracts\AdminInterface;
use Trafik8787\laraCrud2\Contracts\ChildRowsInterface;
use Trafik8787\laraCrud2\Contracts\Component\ComponentManagerBuilderInterface;
use Trafik8787\laraCrud2\Contracts\Component\TabsInterface;
use Trafik8787\laraCrud2\Contracts\Component\UploadFileInterface;
use Trafik8787\laraCrud2\Contracts\FormManagerInterface;
use Trafik8787\laraCrud2\Contracts\NodeModelConfigurationInterface;
use Trafik8787\laraCrud2\Contracts\TableInterface;
use Trafik8787\laraCrud2\Form\Component\ComponentManagerBuilder;
use Trafik8787\laraCrud2\Form\Component\Tabs;
use Trafik8787\laraCrud2\Form\FormTable;
use Trafik8787\laraCrud2\Form\UploadFile;
use Trafik8787\laraCrud2\Models\NodeModelConfiguration;
use Trafik8787\laraCrud2\Table\ActionTable;
use Trafik8787\laraCrud2\Table\ChildRows;
use Trafik8787\laraCrud2\Table\DataTable;


class LaraCrudProvider extends ServiceProvider
{

    protected $navigation = [];
    protected $nodes = [];


    public function nodes()
    {
        return $this->nodes;
    }

    public function navigation()
    {
        return $this->navigation;
    }

    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->singleton(AdminInterface::class, function () {
            return new Admin($this->nodes(), $this->navigation(), $this->app, $this->app->make(Route::class));
        });

        //$this->app->singleton(ModelRouterInterface::class, ModelRouter::class);
        $this->app->singleton(NodeModelConfigurationInterface::class, NodeModelConfiguration::class);
        $this->app->singleton(FormManagerInterface::class, FormTable::class);
        $this->app->singleton(TableInterface::class, DataTable::class);
        $this->app->singleton(ComponentManagerBuilderInterface::class, ComponentManagerBuilder::class);
        $this->app->singleton(TabsInterface::class, Tabs::class);
        $this->app->singleton(UploadFileInterface::class, UploadFile::class);
        $this->app->singleton(ChildRowsInterface::class, ChildRows::class);
        $this->app->singleton(ActionTableInterface::class, ActionTable::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        $this->registerCommands();

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lara');
        $this->mergeConfigFrom(__DIR__ . '/../../config/lara-config.php', 'lara-config');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'lara-crud2');
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->publishes([
            __DIR__.'/../../resources/lang' => $this->app->langPath('vendor/lara-crud2'),
        ]);

        $this->publishes([
            __DIR__ . '/../../src/Console/Commands/Example/migrations' => base_path('database/migrations'),
        ], 'migration');

        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('vendor/lara-crud2'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../../config/lara-config.php' => config_path('lara-config.php'),
        ], 'config');

        view()->composer('lara::common.header', \Trafik8787\laraCrud2\Navigation\Navigation::class);
    }

    protected function getConfig($key)
    {
        return $this->app['config']->get('lara-config.' . $key);
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                NodeGenerate::class,
                ModelGenerate::class,
                InstallCommand::class,
                InstallExample::class
            ]);
        }
    }

}
