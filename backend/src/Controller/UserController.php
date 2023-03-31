<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends DefaultController
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private TokenStorageInterface $tokenStorage,
        private EntityManagerInterface $em,
    ) {}

    #[
        Route(
            '/users',
            name:'user_all',
            methods:['GET'],
        )
    ]
    public function all(Request $request): JsonResponse
    {
        $users = $this->em->getRepository(User::class)->findAll();
        return $this->json($users, 200);
    }

    #[
        Route(
            '/user',
            name:'user_create',
            methods:['POST'],
        )
    ]
    public function create(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());

        $uuid = Uuid::v4();
        $user = new User(
            $uuid,
            $result->login,
            $result->fio,
            $result->description,
            $result->isActive,
            "0123456789",
        );

        $user->setPassword(
            $this->passwordHasher
                ->hashPassword($user, $result->password)
        );

        $this->em->persist($user);
        $this->em->flush();

        return $this->json([
            'status' => 'OK',
            'user'   => $user
        ], 200);
    }

    #[
        Route(
            '/user/{id}',
            name:'user_read',
            methods:['GET'],
        )
    ]
    public function read(string $id): JsonResponse
    {
        if (!empty($id)){
            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy(['id' => $id]);
            return $this->json([
                'status' => 'OK',
                'user'   => $user
            ], 200);
        }

        return $this->json([
            'status' => 'Error',
            'message'=> 'Пользователь отсутствует'
        ], 404);    }

    #[
        Route(
            '/user/{id}',
            name:'user_update',
            methods:['PUT'],
        )
    ]
    public function update(string $id, Request $request,): JsonResponse
    {
        $result = json_decode($request->getContent());
        if (!empty($result->id)){

            $user = $this->em
                ->getRepository(User::class)
                    ->findOneBy(['id' => $result->id]);

            $user->setFIO($result->fio ?? $user->getFIO());

            $user->setIsAcive($result->isActive ?? $user->getIsAcive());

            $user->setRoles($result->roles ?? $user->getRoles());

            $user->setDescription($result->description ?? $user->getDescription());

            if (!empty($result->password))
                $user->setPassword(
                    $this->passwordHasher
                        ->hashPassword($user, $result->password)
                );

            $this->em->persist($user);
            $this->em->flush();

            return $this->json([
                'status' => 'OK',
                'user'   => $user
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Пользователь отсутствует'
        ], 404);
    }

    #[
        Route(
            '/user/{id}',
            name:'user_delete',
            methods:['DELETE'],
        )
    ]
    public function delete(string $id): JsonResponse
    {
        if (!empty($id)){
            $user = $this->em
                ->getRepository(User::class)
                    ->findOneBy(['id' => $id]);

            $this->em->remove($user);
            $this->em->flush();

            return $this->json([
                'status'  => 'OK',
                'message' => 'Пользователь успешно удален'
            ], 200);
        }
        return $this->json([
            'status' => 'Error',
            'message'=> 'Пользователь отсутствует'
        ], 404);
    }

    #[
        Route(
            '/api/current',
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
