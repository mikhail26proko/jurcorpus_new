<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends DefaultController
{
    public function __construct(
        private readonly \Doctrine\Persistence\ManagerRegistry $registry,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly TokenStorageInterface $tokenStorage,
    ) {}

    #[
        Route(
            '/api/user/add',
            name:'user_add',
            methods:['POST'],
        )
    ]
    public function addUser(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());
        $entityManager = $this->registry->getManager();
        $uuid = Uuid::v4();
        $user = new User(
            $uuid,
            $result->login,
            $result->fio,
            $result->jobTitle,
            $result->description,
            $result->isPublic,
            "0123456789",
            // '',
        );

        $user->setPassword($this->passwordHasher->hashPassword($user, $result->password));

        $entityManager->persist($user);
        $entityManager->flush();
        return $this->json($user, 200);
    }

    #[
        Route(
            '/api/user/edit',
            name:'user_edit',
            methods:['POST'],
        )
    ]
    public function editUser(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());
        if (!empty($result->login)){
            $entityManager = $this->registry->getManager();
            $user = $entityManager
                ->getRepository(User::class)
                ->findOneBy(['login' => $result->login]);

            $user->setFIO($result->fio ?? $user->getFIO());

            $user->setJobTitle($result->jobTitle ?? $user->getJobTitle());

            $user->setIsPublic($result->isPublic ?? $user->getIsPublic());

            $user->setRoles($result->roles ?? $user->getRoles());

            $user->setDescription($result->description ?? $user->getDescription());

            if (!empty($result->password))
                $user->setPassword($this->passwordHasher->hashPassword($user, $result->password));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($user, 200);
        }
        
        return $this->json(['Error'=>"Логин отсутствует"], 500);
    }

    #[
        Route(
            '/api/user/view/{login}',
            name:'user_view',
            methods:['GET'],
        )
    ]
    public function viewUser(string $login): JsonResponse
    {
        if (!empty($login)){
            $entityManager = $this->registry->getManager();
            $user = $entityManager
                ->getRepository(User::class)
                ->findOneBy(['login' => $login]);
            return $this->json($user, 200);
        }
        return $this->json(['Error'=>"Логин отсутствует"], 500);
    }

    #[
        Route(
            '/api/user/remove/{login}',
            name:'user_remove',
            methods:['GET'],
        )
    ]
    public function removeUser(string $login): JsonResponse
    {
        if (!empty($login)){
            $entityManager = $this->registry->getManager();
            $user = $entityManager
                ->getRepository(User::class)
                ->findOneBy(['login' => $login]);
                $entityManager->remove($user);
                $entityManager->flush();
            return $this->json(['Status'=> "Пользователь успешно удален"], 200);
        }
        return $this->json(['Error'=>"Логин отсутствует"], 500);
    }

    #[
        Route(
            '/api/user/public',
            name:'user_public',
            methods:['GET'],
        )
    ]
    public function publicUsers(): JsonResponse
    {
        $entityManager = $this->registry->getManager();
        $users = $entityManager
            ->getRepository(User::class)
            ->findBy(['isPublic' => true]);
        return $this->json($users, 200);
    }

    #[
        Route(
            '/api/user/all',
            name:'user_all',
            methods:['GET'],
        )
    ]
    public function allUsers(): JsonResponse
    {
        $entityManager = $this->registry->getManager();
        $users = $entityManager
            ->getRepository(User::class)
            ->findBy([]);
        return $this->json($users, 200);
    }

    #[
        Route(
            '/api/user/current',
            name:'user_current',
            methods:['GET'],
        )
    ]
    public function currentUsers(): JsonResponse
    {
        $user = $this->tokenStorage->getToken()->getUser();
        return $this->json($user, 200);
    }
}
