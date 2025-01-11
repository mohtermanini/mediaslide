<?php

namespace App\Filters\Booking;

use App\Interfaces\Filters\PipeLineInterface;
use Closure;

class CustomerName implements PipeLineInterface
{
    public function handle(array $content, Closure $next)
    {
        if (isset($content['params']['customerName'])) {
            $tableName = $content['queryBuilder']->getModel()->getTable();
            $customerName = $content['params']['customerName'];
            $content['queryBuilder']->where("$tableName.customer_name", 'like', "%$customerName%");
        }

        return $next($content);
    }
}
