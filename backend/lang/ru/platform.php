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
    ],
    'fuilds' => [
        'title'         => 'Название',
        'full_name'     => 'ФИО',
        'last_name'     => 'Фамилия',
        'first_name'    => 'Имя',
        'sur_name'      => 'Отчество',
        'email'         => 'Почта',
        'address'       => 'Адрес',
        'phone'         => 'Телефон',
        'branch'        => 'Филиал',
    ],
    'masks' => [
        'phone' => '+7 (999) 999-9999',
    ]
];