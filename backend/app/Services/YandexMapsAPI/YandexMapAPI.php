<?php

namespace App\Services\YandexMapsAPI;
use Illuminate\Support\Facades\Http;

class YandexMapAPI
{
    private string $url = 'https://geocode-maps.yandex.ru/1.x';
    private string $lang            = 'ru_RU';
    private string $yandexApiKey    = '04b55e07-942b-4e2f-b66a-db3f7b7ee35b';

    public function send(string $query)
    {
        $params = [
            // 'apikey'    => config('app.yandex_apikey'),
            'apikey'    => $this->yandexApiKey,
            'geocode'   => $query,
            'lang'      => $this->lang,
            'format'    => 'json'
        ];

        $response = Http::get($this->url,$params);

        $result = [];

        if (!empty($geoObjects = $response['response']['GeoObjectCollection']['featureMember'])) {

            foreach ($geoObjects as $key => $geoObject) {

                $pos = explode(' ',$geoObject['GeoObject']['Point']['pos']);

                $result[$key] = [
                    'address'   => $geoObject['GeoObject']['metaDataProperty']['GeocoderMetaData']['text'],
                    'latitude'  => $pos[1],
                    'longitude' => $pos[0],
                ];
            }
        }
        return $result;
    }
}
