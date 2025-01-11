<?php

namespace App\Filters\FashionModel;

use App\Filters\BaseFilters;

class FashionModelFilters extends BaseFilters
{
    public function __construct(public $filters = null)
    {
        $this->filters = $filters ?? [
            CategoryId::class,
            FashionModelSearchBy::class,
        ];
    }

    protected function getFilters(): array
    {
        return $this->filters;
    }
}
