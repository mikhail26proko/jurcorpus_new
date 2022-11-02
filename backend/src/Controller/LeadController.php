<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Lead;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class LeadController extends DefaultController
{
    public function __construct(
        private readonly \Doctrine\Persistence\ManagerRegistry $registry,
        private readonly TokenStorageInterface $tokenStorage,
    ) {}

    #[
        Route(
            '/api/lead/add',
            name:'lead_add',
            methods:['POST'],
        )
    ]
    public function addLead(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());
        $entityManager = $this->registry->getManager();
        $uuid = Uuid::v4();
        $lead = new Lead(
            $uuid,
            $result->name,
            $result->text,
            $result->contact,
            "Новый",
            ["Создан"],
            null,
            new \DateTimeImmutable('now'),
            new \DateTimeImmutable('now'),
        );

        $entityManager->persist($lead);
        $entityManager->flush();
        return $this->json($lead, 200);
    }

    #[
        Route(
            '/api/lead/edit',
            name:'lead_edit',
            methods:['POST'],
        )
    ]
    public function editLead(Request $request): JsonResponse
    {
        $result = json_decode($request->getContent());
        if (!empty($result->id)){
            $entityManager = $this->registry->getManager();
            $lead = $entityManager
                ->getRepository(Lead::class)
                ->findOneBy(['id' => $result->id]);

            if (!empty($result->status))
                $lead->setStatus($result->status);

            if (!empty($result->newHistory))
                $lead->addHistory($result->newHistory);

            if(!empty($result->setMe) && $result->setMe)
                $lead->setUser($this->tokenStorage->getToken()->getUser());

            $entityManager->persist($lead);
            $entityManager->flush();

            return $this->json($lead, 200);
        }
        
        return $this->json(['Error'=>"Лид отсутствует"], 500);
    }

    #[
        Route(
            '/api/lead/view/{id}',
            name:'lead_view',
            methods:['GET'],
        )
    ]
    public function viewLead(string $id): JsonResponse
    {
        if (!empty($id)){

            $uid = Uuid::fromString($id);
            $entityManager = $this->registry->getManager();
            $lead = $entityManager
                ->getRepository(Lead::class)
                ->findOneBy(['id' => $uid]);
            return $this->json($lead, 200);
        }
        return $this->json(['Error'=>"Лид отсутствует"], 500);
    }

    #[
        Route(
            '/api/lead/remove/{id}',
            name:'lead_remove',
            methods:['GET'],
        )
    ]
    public function removeLead(string $id): JsonResponse
    {
        if (!empty($id)){
            $uid = Uuid::fromString($id);
            $entityManager = $this->registry->getManager();
            $lead = $entityManager
                ->getRepository(Lead::class)
                ->findOneBy(['id' => $uid]);
                $entityManager->remove($lead);
                $entityManager->flush();
            return $this->json(['Status'=> "Лид успешно удален"], 200);
        }
        return $this->json(['Error'=>"Лид отсутствует"], 500);
    }

    #[
        Route(
            '/api/lead/filter/{status}',
            name:'lead_filter',
            methods:['GET'],
        )
    ]
    public function filterLeads($status): JsonResponse
    {
        $entityManager = $this->registry->getManager();
        $leads = $entityManager
            ->getRepository(Lead::class)
            ->findBy(['status' => $status]);
        return $this->json($leads, 200);
    }

    #[
        Route(
            '/api/lead/all',
            name:'lead_all',
            methods:['GET'],
        )
    ]
    public function allLeads(): JsonResponse
    {
        $entityManager = $this->registry->getManager();
        $leads = $entityManager
            ->getRepository(Lead::class)
            ->findBy([]);
        return $this->json($leads, 200);
    }
}
