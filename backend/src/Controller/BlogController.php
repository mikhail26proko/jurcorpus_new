<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class BlogController extends DefaultController
{
    public function __construct(
        private readonly \Doctrine\Persistence\ManagerRegistry $registry,
        private readonly TokenStorageInterface $tokenStorage,
    ) {}

    #[
        Route(
            '/api/post/add',
            name:'post_add',
            methods:['POST'],
        )
    ]
    public function addPost(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());
        $entityManager = $this->registry->getManager();
        $uuid = Uuid::v4();
        $post = new Post(
            $uuid,
            $result->title,
            $result->text,
            $result->image ?? null,
            false,
            $this->tokenStorage->getToken()->getUser(),
            new \DateTimeImmutable('now'),
            new \DateTimeImmutable('now'),
        );

        $entityManager->persist($post);
        $entityManager->flush();
        return $this->json($post, 200);
    }

    #[
        Route(
            '/api/post/edit',
            name:'post_edit',
            methods:['POST'],
        )
    ]
    public function editPost(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());
        if (!empty($result->id)){
            $entityManager = $this->registry->getManager();
            $post = $entityManager
                ->getRepository(Post::class)
                ->findOneBy(['id' => $result->id]);

            if (!empty($result->title))
                $post->setTitle($result->title);

            if (!empty($result->text))
                $post->setText($result->text);

            if (!empty($result->image))
                $post->setImage($result->image);

            if (!empty($result->status))
                $post->setStatus($result->status);

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->json($post, 200);
        }

        return $this->json(['Error'=>"Пост отсутствует"], 500);
    }

    #[
        Route(
            '/api/post/view/{id}',
            name:'post_view',
            methods:['GET'],
        )
    ]
    public function viewPost(string $id): JsonResponse
    {
        if (!empty($id)){

            $uid = Uuid::fromString($id);
            $entityManager = $this->registry->getManager();
            $post = $entityManager
                ->getRepository(Post::class)
                ->findOneBy(['id' => $uid]);
            return $this->json($post, 200);
        }
        return $this->json(['Error'=>"Пост отсутствует"], 500);
    }

    #[
        Route(
            '/api/post/remove/{id}',
            name:'post_remove',
            methods:['GET'],
        )
    ]
    public function removePost(string $id): JsonResponse
    {
        if (!empty($id)){
            $uid = Uuid::fromString($id);
            $entityManager = $this->registry->getManager();
            $post = $entityManager
                ->getRepository(Post::class)
                ->findOneBy(['id' => $uid]);
                $entityManager->remove($post);
                $entityManager->flush();
            return $this->json(['Status'=> "Пост успешно удален"], 200);
        }
        return $this->json(['Error'=>"Пост отсутствует"], 500);
    }

    #[
        Route(
            '/api/post/public/',
            name:'post_filter',
            methods:['GET'],
        )
    ]
    public function filterPosts(): JsonResponse
    {
        $entityManager = $this->registry->getManager();
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findBy(['active' => true]);
        return $this->json($posts, 200);
    }

    #[
        Route(
            '/api/post/all',
            name:'post_all',
            methods:['GET'],
        )
    ]
    public function allPosts(): JsonResponse
    {
        $entityManager = $this->registry->getManager();
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findBy([]);
        return $this->json($posts, 200);
    }
}
