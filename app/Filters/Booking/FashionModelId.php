<?php

namespace App\Filters\Booking;

use App\Interfaces\Filters\PipeLineInterface;
use Closure;

class FashionModelId implements PipeLineInterface
{
    public function handle(array $content, Closure $next)
    {
        if (isset($content['params']['modelIds'])) {
            $tableName = $content['queryBuilder']->getModel()->getTable();
            $content['queryBuilder']->whereIn("$tableName.fashion_model_id", $content['params']['modelIds']);
        }

        return $next($content);
    }
}