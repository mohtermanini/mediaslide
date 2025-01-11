<?php

namespace App\Filters\Booking;

use App\Interfaces\Filters\PipeLineInterface;
use Closure;

class BookingDate implements PipeLineInterface
{
    public function handle(array $content, Closure $next)
    {
        $tableName = $content['queryBuilder']->getModel()->getTable();

        if (isset($content['params']['fromDate'])) {
            $content['queryBuilder']->whereDate("{$tableName}.booking_date", '>=', $content['params']['fromDate']);
        }

        if (isset($content['params']['toDate'])) {
            $content['queryBuilder']->whereDate("{$tableName}.booking_date", '<=', $content['params']['toDate']);
        }

        return $next($content);
    }
}