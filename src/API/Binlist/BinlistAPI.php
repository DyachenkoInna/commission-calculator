<?php

declare(strict_types=1);

namespace App\API\Binlist;

use App\API\Binlist\DTO\Card;
use App\Exception\ApiException;

/**
 * Class BinlistAPI
 *
 * This class is responsible for fetching card information from Binlist API
 */
class BinlistAPI
{
    /**
     * Base URL for Binlist API
     *
     * @var string $baseUrl
     */
    private string $baseUrl;

    public function __construct()
    {
        // ToDo: take from configs
        $this->baseUrl = 'https://lookup.binlist.net';
    }

    /**
     * Fetch card information by BIN
     *
     * @param string $bin
     * @return Card
     * @throws ApiException
     */
    public function lookup(string $bin): Card
    {
        $result = file_get_contents("$this->baseUrl/$bin");

        if (empty($result) || !json_validate($result)) {
            throw new ApiException('Error while fetching data from Binlist API. Invalid response.');
        }

        $cardData = json_decode($result, true);

        if (empty($cardData) || empty($cardData['country']['alpha2'])) {
            throw new ApiException('Error while fetching data from Binlist API. Required data missing.');
        }

        return new Card($cardData);
    }
}
