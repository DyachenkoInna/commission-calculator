<?php

declare(strict_types=1);

namespace App;

use App\DTO\Transaction;
use App\Exception\ValidationException;
use App\Service\{
    Bin\BinInfoProviderInterface,
    CommissionCalculator,
    ExchangeRate\ExchangeRateProviderInterface,
    Transaction\TransactionProviderInterface,
};
use Exception;

class TransactionProcessor
{
    private TransactionProviderInterface $transactionProvider;
    private BinInfoProviderInterface $binInfoProvider;
    private CommissionCalculator $commissionCalculator;

    public function __construct(
        TransactionProviderInterface  $transactionProvider,
        BinInfoProviderInterface      $binInfoProvider,
        ExchangeRateProviderInterface $exchangeRatesProvider,
    ) {
        $this->transactionProvider = $transactionProvider;
        $this->binInfoProvider = $binInfoProvider;
        $this->commissionCalculator = new CommissionCalculator($exchangeRatesProvider);
    }

    public function processTransactions(): void
    {
        foreach ($this->transactionProvider->getTransactions() as $i => $transaction) {
            try {
                $commission = $this->getCommission($transaction);
                echo $commission . "\n";
            } catch (Exception $exception) {
                echo 'Error in line ' . ($i + 1);
                throw $exception;
            }
        }
    }

    private function getCommission(string $transactionData): float
    {
        // validate json
        if (!json_validate($transactionData)) {
            throw new ValidationException('Invalid json.');
        }

        // create and validate transaction
        $transaction = new Transaction(json_decode($transactionData, true));
        if (!$transaction->isValid()) {
            throw new ValidationException('Invalid data in json.');
        }

        // get card info by bin
        $isEu = $this->binInfoProvider->isEu($transaction->getBin());

        // calculate and print commission
        return $this->commissionCalculator->calculate(
            $transaction->getCurrency(),
            $transaction->getAmount(),
            $isEu
        );
    }
}
