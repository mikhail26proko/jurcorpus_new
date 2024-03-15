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
            'vacansies'=> [
                'index' => 'Вакансии',
                'description'   => 'Страница настроек',
            ],
            'services'=> [
                'index' => 'Услуги',
                'description'   => 'Страница списка услуг (для внешней части сайта)',
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
                        'index'         => 'Должности',
                        'description'   => 'Страница управления должностями',
                    ],
                    'directions' => [
                        'index'         => 'Направления работы',
                        'description'   => 'Страница управления направлениями работ',
                    ],
                    'pub_sources' => [
                        'index'         => 'Источники публикаций',
                        'description'   => 'Страница управления источниками публикаций',
                    ],
                    'pub_types' => [
                        'index'         => 'Тип публикаций',
                        'description'   => 'Страница управления источниками публикаций',
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
        'delete'    => 'Удаление',
        'download'  => 'Загрузка',
    ],
    'messages' => [
        'Open'          => 'Открыть',
        'Success'       => 'Успешно',
        'WasAdded'      => 'Добавлено',
        'WasCreated'    => 'Создано',
        'WasUpdated'    => 'Обновлено',
        'WasDeleted'    => 'Удалено',
        'SureDelete'    => 'Подтвердите удаление',
        'UnsetedValue'  => 'Отсутствует',
        'UnImplemented' => 'Еще не реализованно'
    ],
    'entityes' => [
        'App\Models\Lead'       => 'Заявки',
        'App\Models\Branch'     => 'Филиалы',
        'App\Models\Publication'=> 'Публикации',
        'App\Models\Direction'  => 'Направления работы',
        'App\Models\Employee'   => 'Сотрудники',
        'App\Models\JobTitle'   => 'Должности',
        'App\Models\PubSource'  => 'Источники публикаций',
        'App\Models\Journal'    => 'Журнал заявки',
        'App\Models\User'       => 'Пользователи',
        'App\Models\Role'       => 'Роли',
    ],
    'fuilds' => [
        'title'         => 'Название',
        'pub_title'     => 'Заголовок',
        'sub_title'     => 'Подзаголовок',
        'full_name'     => 'ФИО',
        'last_name'     => 'Фамилия',
        'first_name'    => 'Имя',
        'birthday'      => 'День рождения',
        'sur_name'      => 'Отчество',
        'photo'         => 'Фото',
        'job_titles'    => 'Должности',
        'job_title'     => 'Должность',
        'pub_source'    => 'Источник публикации',
        'pub_type'      => 'Тип публикации',
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
        'employee'      => 'Сотрудник',
        'employee_count'=> 'Кол-во сотрудников',
        'created_at'    => 'Дата создания',
        'edited_at'     => 'Дата редактирования',
        'publicated_at' => 'Дата публикации',
        'link'          => 'Ссылка',
        'user_id'       => 'Ответственный',
        'sort'          => 'Позиция (сортировка)',
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
        'date'      => 'd.m.Y',
        'email'     => '',
        'phone'     => '+{0,1}9 999 999 99 99',
    ]
];