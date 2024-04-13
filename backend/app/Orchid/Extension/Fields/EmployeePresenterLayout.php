<?php

declare(strict_types=1);

namespace App\Orchid\Extension\Fields;

use Illuminate\View\View;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Layouts\Persona;

class EmployeePresenterLayout extends Persona
{
    /**
     * @var string
     */
    protected $template = 'platform::layouts.employee_presenter';

    public function render(Personable $user): View
    {
        return view($this->template, [
            'title'         => $user->title(),
            'subTitle'      => $user->subTitle(),
            'image'         => $user->image(),
            'url'           => $user->url(),
            'is_deleted'    => $user->is_deleted(),
        ]);
    }
}
