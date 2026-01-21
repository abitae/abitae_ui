<?php

namespace Abitae\AbitaeUi;

use Abitae\AbitaeUi\Console\InstallCommand;
use Abitae\AbitaeUi\Console\PublishCommand;
use Abitae\AbitaeUi\Livewire\Accordion;
use Abitae\AbitaeUi\Livewire\Autocomplete;
use Abitae\AbitaeUi\Livewire\Button;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AbitaeUiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/abitae-ui.php', 'abitae-ui');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'abitae-ui');

        Livewire::component('abitae-ui.button', Button::class);
        Livewire::component('abitae-ui.accordion', Accordion::class);
        Livewire::component('abitae-ui.autocomplete', Autocomplete::class);

        Blade::componentNamespace('Abitae\\AbitaeUi\\View\\Components', 'abitae');

        Blade::directive('abitaeAppearance', function () {
            $css = config('abitae-ui.assets.css');
            return "<link rel=\"stylesheet\" href=\"{$css}\">";
        });

        Blade::directive('abitaeScripts', function () {
            $js = config('abitae-ui.assets.js');
            return "<script src=\"{$js}\" defer></script>";
        });

        $this->publishes([
            __DIR__ . '/../config/abitae-ui.php' => config_path('abitae-ui.php'),
        ], 'abitae-ui-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/abitae-ui'),
        ], 'abitae-ui-views');

        $this->publishes([
            __DIR__ . '/../resources/css/abitae-ui.css' => public_path('vendor/abitae-ui/abitae-ui.css'),
            __DIR__ . '/../resources/js/abitae-ui.js' => public_path('vendor/abitae-ui/abitae-ui.js'),
        ], 'abitae-ui-assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                PublishCommand::class,
            ]);
        }
    }
}
