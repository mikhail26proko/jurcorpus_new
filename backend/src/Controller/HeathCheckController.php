<?php

/**
  * Created by Mikhail Prokofiev
  * Date: 28/03/2023
*/

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HeathCheckController extends DefaultController
{
    #[
        Route(
            '/heathcheck',
            name:'heathcheck',
            methods:['GET'],
        )
    ]
    public function helthcheck(): JsonResponse
    {
        return $this->json('true', 200);
    }
}
