<?php

namespace App\Infrastructure\Postgres\Transaction;

use App\Domain\Common\Interface\TransactionManagerInterface;
use Illuminate\Support\Facades\DB;

class TransactionManager implements TransactionManagerInterface
{
    public function transaction(callable $callback): mixed
    {
        return DB::transaction($callback);
    }
}
