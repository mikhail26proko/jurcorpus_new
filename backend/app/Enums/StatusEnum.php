<?php

namespace App\Enums;

enum StatusEnum: string {
    case draft      = "Черновик";
    case new        = "Новая";
    case process    = "В процессе";
    case processed  = "Обработана";
    case done       = "Готово";
    case refuse     = "Отказ";

    public static function toArray(): array
    {
        return array_combine(
            array_column(self::cases(),'value'),
            array_column(self::cases(),'value'),
        );
    }

    public static function value($status)
    {
        return match ($status) {
            'draft'     => StatusEnum::draft->value,
            'new'       => StatusEnum::new->value,
            'process'   => StatusEnum::process->value,
            'processed' => StatusEnum::processed->value,
            'done'      => StatusEnum::done->value,
            'refuse'    => StatusEnum::refuse->value,
        };
    }
}