<?php

declare(strict_types=1);

return [
    'pages' => [
        'menu' => [
            'main' => [
                'index'         => 'Главная',
                'description'   => 'Главная страница'
            ],
            'crm'=> [
                'index' => 'CRM',
                'description'   => 'Работа с заявками и контактами',
                'leads'=> [
                    'index' => 'Заявки',
                    'uno'   => 'Заявка',
                    'description'   => 'Страница заявок',
                ],
                'user_leads'=> [
                    'index' => 'Мои заявки',
                    'uno'   => 'Заявка',
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
                'system_log'=>[
                    'index' => 'Системный лог',
                    'description' => 'Список всех действий с сущностями всех пользователей',
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
    'actions' => [
        'full'      => 'Полный доступ',
        'create'    => 'Создание',
        'read'      => 'Чтение',
        'update'    => 'Обновление',
        'delete'    => 'Удаление'
    ],
    'messages' => [
        'Open'          => 'Открыть',
        'WasAdded'      => 'Добавлено',
        'WasCreated'    => 'Создано',
        'WasUpdated'    => 'Обновлено',
        'WasDeleted'    => 'Удалено',
        'SureDelete'    => 'Подтвердите удаление',
        'UnsetedValue'  => 'Отсутствует',
    ],
    'entityes' => [
        'App\Models\Lead'       => 'Заявки',
        'App\Models\Branch'     => 'Филиалы',
        'App\Models\Direction'  => 'Направления работы',
        'App\Models\Employee'   => 'Сотрудники',
        'App\Models\JobTitle'   => 'Должности',
        'App\Models\Journal'    => 'Журнал заявки',
        'App\Models\User'       => 'Пользователи',
        'App\Models\Role'       => 'Роли',
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
        'contact'       => 'Контактные данные',
        'description'   => 'Описание',
        'message'       => 'Сообщение',
        'journals'      => 'Журнал',
        'journal'       => 'Обращение',
        'branch'        => 'Филиал',
        'directions'    => 'Направления работы',
        'direction'     => 'Направление работы',
        'employee_count'=> 'Кол-во сотрудников',
        'created_at'    => 'Дата создания',
        'edited_at'     => 'Дата редактирования',
        'user_id'       => 'Ответственный',
        'system_log'    => [
            'type'          => 'Тип',
            'entity'        => 'Сущность',
            'created_at'    => 'Дата',
            'data'          => 'Данные',
            'user'          => 'Пользователь',
        ],
    ],
    'tabs' => [
        'all'       => 'Все',
        'new'       => 'Новая',
        'process'   => 'В процессе',
        'processed' => 'Обработана',
        'done'      => 'Готово',
        'refuse'    => 'Отказ',
        'draft'     => 'Черновик',
    ],
    'masks' => [
        'email' => '',
        'phone' => '+{0,1}9 999 999 99 99',
    ]
];