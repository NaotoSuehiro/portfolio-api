<?php

namespace App\Domain\Common\Interface;

interface TransactionManagerInterface
{
    public function transaction(callable $callback): mixed;
}
