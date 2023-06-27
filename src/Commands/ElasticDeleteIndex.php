<?php

namespace Swis\Elastic\Commands;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Illuminate\Console\Command;

class ElasticDeleteIndex extends Command
{
    protected $signature = 'elastic:delete-index {--index= : index that needs to be deleted (index from config is used if option is omitted)}';

    protected $description = 'Deletes index in elasticsearch';

    public function handle(Client $client): int
    {
        $index = $this->option('index') ?? config('elastic.index');

        try {
            $client->indices()->delete([
                'index' => $index,
            ]);
        } catch (ClientResponseException $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }
        }

        $this->info(sprintf('Index "%s" deleted', $index));

        return Command::SUCCESS;
    }
}
