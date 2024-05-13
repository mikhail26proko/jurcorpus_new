<?php

namespace App\Orchid\Layouts\Listeners;

use App\Services\YandexMapsAPI\YandexMapAPI;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class AddressListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'address',
        // 'latitude',
        // 'longitude',
    ];


    // protected $asyncMethod = 'asyncAddress';

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('address')
                    ->title(__('platform.fuilds.address')),

                Group::make([
                    Input::make('latitude')
                        // ->type('number')
                        ->title(__('Latitude'))
                        ->placeholder(__('Latitude')),

                    Input::make('longitude')
                        // ->type('number')
                        ->title(__('Longitude'))
                        ->placeholder(__('Longitude')),
                ])
            ])
        ];
    }

    /**
     * Update state
     *
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        $query = $request->input('address');

        $results = (new YandexMapAPI)->send($query);

        // foreach ($results as $result) {
            // $repository->set('address[]',$result['address']);
        // }
        return $repository
            ->set('address', $results[0]['address'])
            ->set('latitude', $results[0]['latitude'])
            ->set('longitude', $results[0]['longitude']);
    }
}