<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Interfaces;

use Illuminate\Support\Collection;
use Swis\Laravel\ElasticSearch\Document;

interface IndexableInterface
{
    public function getElasticDocument(): Document;

    public function shouldBeIndexed(): bool;

    /**
     * @return \Illuminate\Support\Collection<int,\Illuminate\Database\Eloquent\Model>
     */
    public function relatedModelsToIndex(): Collection;

    public function index(): void;
}
