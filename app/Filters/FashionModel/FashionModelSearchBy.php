<?php

namespace App\Filters\FashionModel;

use App\Interfaces\Filters\PipeLineInterface;
use Closure;

class FashionModelSearchBy implements PipeLineInterface
{
    public function handle(array $content, Closure $next)
    {
        if (isset($content['params']['searchBy'])) {
            $tableName = $content['queryBuilder']->getModel()->getTable();
            $searchBy = $content['params']['searchBy'];
            $content['queryBuilder']->where(
                fn($query) =>
                $query->where("$tableName.name", 'like', "%$searchBy%")
                    ->orWhere("$tableName.description", 'like', "%$searchBy%")
            );
        }

        return $next($content);
    }
}
