<?php

declare(strict_types=1);

namespace App\Orchid\Components;

use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository;
use Orchid\Screen\Layout;


abstract class SimpleLayouts extends Layout
{
    public function build(Repository $repository)
    {
        return LayoutFactory::blank([
            $this->layout(),
        ])->build($repository);
    }

    abstract public function layout();
}
