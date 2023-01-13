backend:

php bin/console doctrine:schema:create

INSERT INTO "user" ("id", "login", "fio", "is_public", "password", "roles")
VALUES ('f8682394-a849-4966-a2ce-7bc675f1fe0a',
        'usr123',
        'Test user FIO',
        true,
        '$2y$13$.TjDFrDdaXy/6iqdZKKd5OcXSpckfHQByhjIgQ0MPvhCVoI5IIXxG',
        '[]');

axios body {
    "login": 'usr123',
    "password": '123456',
}

bin/console doctrine:database:drop --force

bin/console doctrine:database:create

php bin/console make:migration

bin/console doctrine:migrations:migrate