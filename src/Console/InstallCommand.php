<?php

namespace Abitae\AbitaeUi\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'abitae-ui:install {--force : Overwrite any existing files}';
    protected $description = 'Instala Abitae UI y publica assets/config.';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--tag' => 'abitae-ui-config',
            '--force' => (bool) $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'abitae-ui-assets',
            '--force' => (bool) $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'abitae-ui-views',
            '--force' => (bool) $this->option('force'),
        ]);

        $this->info('Abitae UI instalado. Importa los assets en tu layout y Tailwind.');

        return self::SUCCESS;
    }
}
