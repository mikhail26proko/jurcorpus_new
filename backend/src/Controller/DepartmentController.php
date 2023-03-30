<?php

/**
  * Created by Mikhail Prokofiev
  * Date: 30/03/2023
*/

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Department;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;

class DepartmentController extends DefaultController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[
        Route(
            '/department',
            name:'department_all',
            methods:['GET'],
        )
    ]
    public function all(Request $request)
    {
        if (!empty($id)){
            $departments = $this->em
                ->getRepository(Department::class)
                ->findAll();
            return $this->json([
                'status'    => 'OK',
                'departments'=> $departments
            ], 200);
        }

        return $this->json([
            'status' => 'Error',
            'message'=> 'Филиалы отсутствуют'
        ], 404);
    }

    #[
        Route(
            '/department',
            name:'department_create',
            methods:['POST'],
        )
    ]
    public function create(Request $request)
    {
        $result = json_decode($request->getContent());

        $uuid = Uuid::v4();
        $department = new Department(
            $uuid,
            $result->name,
            $result->adress,
            $result->description,
            $result->coordinates,
            new ArrayCollection(),
        );

        $this->em->persist($department);
        $this->em->flush();

        return $this->json([
            'status'    => 'OK',
            'department'=> $department
        ], 200);
    }

    #[
        Route(
            '/department/{id}',
            name:'department_read',
            methods:['GET'],
        )
    ]
    public function read(string $id, Request $request)
    {
        if (!empty($id)){
            $department = $this->em
                ->getRepository(Department::class)
                ->findOneBy(['id' => $id]);
            return $this->json([
                'status'    => 'OK',
                'department'=> $department
            ], 200);
        }

        return $this->json([
            'status' => 'Error',
            'message'=> 'Филиал отсутствует'
        ], 404);
    }

    #[
        Route(
            '/department/{id}',
            name:'department_update',
            methods:['PUT'],
        )
    ]
    public function update(string $id, Request $request,): JsonResponse
    {
        $result = json_decode($request->getContent());
        if (!empty($result->id)){

            $department = $this->em
                ->getRepository(Department::class)
                    ->findOneBy(['id' => $result->id]);

            $department->setName($result->name ?? $department->getName());

            $department->setAdress($result->adress ?? $department->getAdress());

            $department->setDescription($result->description ?? $department->getDescription());

            $department->setCoordinates($result->coordinates ?? $department->getCoordinates());

            $this->em->persist($department);
            $this->em->flush();

            return $this->json([
                'status'    => 'OK',
                'department'=> $department
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Филиал отсутствует'
        ], 404);
    }

    #[
        Route(
            '/department/{department_id}/employee/{employee_id}',
            name:'department_add_employee',
            methods:['PUT'],
        )
    ]
    public function add_employee(string $department_id, string $employee_id): JsonResponse
    {
        if (!empty($result->department_id) && !empty($result->employee_id)){

            $department = $this->em
                ->getRepository(Department::class)
                    ->findOneBy(['id' => $department_id]);

            $employee = $this->em
            ->getRepository(Employee::class)
                ->findOneBy(['id' => $employee_id]);
            
            $department->addEmployees($employee);

            $this->em->persist($department);
            $this->em->flush();

            return $this->json([
                'status'    => 'OK',
                'department'=> $department
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Филиал отсутствует'
        ], 404);
    }

    #[
        Route(
            '/department/{id}',
            name:'department_delete',
            methods:['DELETE'],
        )
    ]
    public function delete(string $id): JsonResponse
    {
        if (!empty($id)){
            $department = $this->em
                ->getRepository(Department::class)
                    ->findOneBy(['id' => $id]);

            $this->em->remove($department);
            $this->em->flush();

            return $this->json([
                'status'  => 'OK',
                'message' => 'Филиал успешно удален'
            ], 200);
        }
        return $this->json([
            'status' => 'Error',
            'message'=> 'Филиал отсутствует'
        ], 404);
    }

    #[
        Route(
            '/department/{department_id}/employee/{employee_id}',
            name:'department_remove_employee',
            methods:['DELETE'],
        )
    ]
    public function remove_employee(string $department_id, string $employee_id): JsonResponse
    {
        if (!empty($result->department_id) && !empty($result->employee_id)){

            $department = $this->em
                ->getRepository(Department::class)
                    ->findOneBy(['id' => $department_id]);

            $employee = $this->em
            ->getRepository(Employee::class)
                ->findOneBy(['id' => $employee_id]);
            
            $department->removeEmployees($employee);

            $this->em->persist($department);
            $this->em->flush();

            return $this->json([
                'status'    => 'OK',
                'department'=> $department
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Филиал отсутствует'
        ], 404);
    }
}
