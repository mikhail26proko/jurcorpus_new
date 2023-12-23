<?php

declare(strict_types=1);

return [
    'pages' => [
        'menu' => [
            'main' => [
                'index'         => 'Главная',
                'description'   => 'Главная страница'
            ],
            'СRM'=> [
                'index' => 'CRM',
                'description'   => 'Работа с заявками и контактами',
                'leads'=> [
                    'index' => 'Заявки',
                    'description'   => 'Страница заявок',
                ],
                'clients'=> [
                    'index' => 'Клиенты',
                    'description'   => 'Страница работы с клиентами',
                ],
            ],
            'employees'=> [
                'index' => 'Сотрудники',
                'description'   => 'Страница сотрудников',
            ],
            'branches'=> [
                'index' => 'Филиалы',
                'description'   => 'Страница филиалов',
            ],
            'publications'=> [
                'index' => 'Публикации',
                'description'   => 'Страница по работе с публикациями',
                'new'=> [
                    'index' => 'Новости',
                    'description'   => 'Страница по работе с новостями',
                ],
                'smi'=> [
                    'index' => 'СМИ о нас',
                    'description'   => 'Страница по работе с медиа материалами сми',
                ],
            ],
            'vacancies'=> [
                'index' => 'Вакансии',
                'description'   => 'Страница настроек',
            ],

            'system'  => [
                'index' => 'Система',
                'description'   => 'Страница настроек',
                'users' => [
                    'index' => 'Пользователи',
                    'description'   => 'Страница управления пользователями',
                ],
                'roles' => [
                    'index' => 'Роли',
                    'description'   => 'Страница управления правами',
                ],
                'directories'=>[
                    'index' => 'Справочник',
                    'description'   => 'Страница управления доп полями',
                    'job_titles' => [
                        'index' => 'Должности',
                        'description'   => 'Страница управления должностями',
                    ],
                    'directions' => [
                        'index' => 'Направления работы',
                        'description'   => 'Страница управления направлениями работ',
                    ],
                ],
                'lang'=> [
                    'index' => 'Язык',
                    'description'   => 'Страница управления языковыми файлами',
                ],
            ],
            "examples"  => [
                'index' => "Примеры",
                'description'   => 'Cтраница с примерами',
            ],
            "logout" => [
                'index' => "Выход"
            ]
        ]
    ],
    'messages' => [
        'WasCreated'    => 'Создано',
        'WasUpdated'    => 'Обновлено',
        'WasDeleted'    => 'Удалено',
        'SureDelete'    => 'Подтвердите удаление',
        'UnsetedValue'  => 'Отсутствует',
    ],
    'fuilds' => [
        'title'         => 'Название',
        'full_name'     => 'ФИО',
        'last_name'     => 'Фамилия',
        'first_name'    => 'Имя',
        'sur_name'      => 'Отчество',
        'photo'         => 'Фото',
        'job_titles'    => 'Должности',
        'job_title'     => 'Должность',
        'email'         => 'Почта',
        'address'       => 'Адрес',
        'phone'         => 'Телефон',
        'description'   => 'Описание',
        'branch'        => 'Филиал',
        'directions'    => 'Направления работы',
        'direction'     => 'Направление работы',
        'employee_count'=> 'Кол-во сотрудников',
    ],
    'masks' => [
        'phone' => '+7 (999) 999-9999',
    ]
];