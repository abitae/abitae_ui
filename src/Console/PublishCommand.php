<?php

namespace Abitae\AbitaeUi\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'abitae-ui:publish {--tag=* : Tag a publicar} {--force : Overwrite any existing files}';
    protected $description = 'Publica assets, vistas o config de Abitae UI.';

    public function handle(): int
    {
        $tags = (array) $this->option('tag');

        if (empty($tags)) {
            $tags = ['abitae-ui-config', 'abitae-ui-assets', 'abitae-ui-views'];
        }

        foreach ($tags as $tag) {
            $this->call('vendor:publish', [
                '--tag' => $tag,
                '--force' => (bool) $this->option('force'),
            ]);
        }

        $this->info('Publicación completada.');

        return self::SUCCESS;
    }
}
