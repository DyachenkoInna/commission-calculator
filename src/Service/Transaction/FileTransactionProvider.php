<?php

namespace App\Service\Transaction;

use App\Service\FileReader;
use Iterator;

class FileTransactionProvider implements TransactionProviderInterface
{
    private string $filePath;
    private FileReader $fileReader;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->fileReader = new FileReader();
    }

    public function getTransactions(): Iterator
    {
        return $this->fileReader->readByLine($this->filePath);
    }
}
