<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

use Log;

class PageController extends Controller
{
    public function weatherShow()
    {

        try {
            $client = new Client();

            $result = $client->request('GET', 'https://api.weather.yandex.ru/v1/forecast', [
                'query' => [
                    'lat' => '53.2520900',
                    'lon' => '34.3716700',
                    'lang' => 'ru_RU',
                ],
                'headers' => [
                    'X-Yandex-API-Key' => config('general.ya.map'),
                ]
            ]);

            $result = json_decode($result->getBody()->getContents());

            $temp = $result->fact->temp . ' ℃';

        } catch (ClientException $e) {
            $response = $e->getResponse();

            $result = $response->getBody()->getContents();

            // Записываем в свой лог ошибку $result - для системы логирования
            Log::info($result);

            $temp = 'Не удалось получить температуру в текущем городе. Повторите попытку позже.';

        }

        return view('pages.weather', [
            'temp' => $temp,
        ]);

    }

}
