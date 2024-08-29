<?php

declare(strict_types=1);

use App\Service\{
    Bin\BinlistApiInfoProvider,
    ExchangeRate\ExchangeRateApiLayerProvider,
    Transaction\FileTransactionProvider,
};
use App\TransactionProcessor;

require_once __DIR__ . '/vendor/autoload.php';

(new TransactionProcessor(
    new FileTransactionProvider($argv[1] ?? ''),
    new BinlistApiInfoProvider(),
    new ExchangeRateApiLayerProvider()
))->processTransactions();
