<?php

namespace App\Service\Transaction;

use Iterator;

interface TransactionProviderInterface
{
    public function getTransactions(): Iterator;
}
