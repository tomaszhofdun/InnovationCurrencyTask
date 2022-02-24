<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Game;
use App\Models\Currency;
use App\Repository\Interfaces\CurrencyRepository as CurrencyRepositoryInterface;
use App\Service\FakeService;
use Illuminate\Support\Facades\Http;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private Currency $currencyModel;

    public function __construct(Currency $currencyModel)
    {
        $this->currencyModel = $currencyModel;
    }

    public function updateCurrenciesNBP()
    {
        $response = Http::get('https://api.nbp.pl/api/exchangerates/tables/a?format=json');
        $rates = $response->json()[0]['rates'];



        foreach ($rates as $key => $value) {


            $currency =  $this->currencyModel->where('name', $value['code'])->first();


            if($currency) {
                $currency->exchange_rate = $value['mid'];
                $currency->save();

            }
            else {
                $currency = new Currency;
                $currency->name = $value['code'];
                $currency->currency_code = $value['code'];
                $currency->exchange_rate = $value['mid'];
                $currency->save();
            }

        }

    }

}
