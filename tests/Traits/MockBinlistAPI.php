<?php

declare(strict_types=1);

namespace Tests\Traits;

use App\API\Binlist\{
    BinlistAPI,
    DTO\Card,
    DTO\Country,
};
use Mockery;

trait MockBinlistAPI
{
    private function mockBinlistAPI(bool $isEu = true): BinlistAPI
    {
        $card = $this->getCard($isEu);

        return Mockery::mock(BinlistAPI::class, function ($mock) use ($card) {
            $mock->shouldReceive('lookup')
                ->andReturn($card);
        });
    }

    private function getCard(bool $isEu): Card
    {
        $card = new Card();
        $country = new Country();
        $country->setAlpha2($isEu ? Country::EU_ALPHA2_CODES[0] : 'US');
        $card->setCountry($country);

        return $card;
    }
}
