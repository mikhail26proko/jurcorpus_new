<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Publication;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\Publication;
use App\Models\PubSource;
use App\Models\Employee;
use App\Models\PubType;
use Orchid\Screen\TD;

class PublicationListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'publication';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            TD::make('id', '#')->width(70)
                ->sort(),

            TD::make('publicated_at', __('platform.fuilds.publicated_at'))
                ->sort()
                ->render(function (Publication $publication) {
                    return $publication->publicated_at ? $publication->publicated_at->format(__('platform.masks.date')) : '';
                })
                ->width(150)
                ->cantHide(),

            TD::make('pub_source_id', __('platform.fuilds.pub_source'))
                ->cantHide()
                ->filter(TD::FILTER_SELECT, array_column(PubSource::all()->toArray(),'title','id'))
                ->render(function (Publication $publication) {
                    return $publication->pub_source->title;
                }),

            TD::make('pub_type_id', __('platform.fuilds.pub_type'))
                ->cantHide()
                ->filter(TD::FILTER_SELECT, array_column(PubType::all()->toArray(),'title','id'))
                ->render(function (Publication $publication) {
                    return $publication->pub_type->title;
                }),

            TD::make('title',__('platform.fuilds.title')),

            TD::make('employee_id', __('platform.fuilds.employee'))
                // TODO: Передать список сотрудников у которых есть публикации
                ->filter(TD::FILTER_SELECT,array_column(Employee::publisher()->get()->toArray(),'full_name','id'))
                ->cantHide()
                ->render(function (Publication $publication) {
                    return $publication->employee->full_name ?? '';
                }),

            TD::make(__('Actions'))->alignRight()
                ->render(function (Publication $publication) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editPublication')
                                ->modalTitle(__('Edit'). ' ' . $publication->title)
                                ->method('createOrUpdatePublication')
                                ->asyncParameters(['publication' => $publication->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'publication' => $publication->id,
                                ]),
                        ]);
                }),
        ];
    }
}
