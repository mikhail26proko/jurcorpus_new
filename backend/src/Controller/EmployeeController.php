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

class EmployeeController extends DefaultController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    #[
        Route(
            '/employee',
            name:'employee_all',
            methods:['GET'],
        )
    ]
    public function all(Request $request)
    {
        if (!empty($id)){
            $employees = $this->em
                ->getRepository(Employee::class)
                ->findAll();
            return $this->json([
                'status'    => 'OK',
                'employees'=> $employees
            ], 200);
        }

        return $this->json([
            'status' => 'Error',
            'message'=> 'Сотрудники отсутствуют'
        ], 404);
    }

    #[
        Route(
            '/employee',
            name:'employee_create',
            methods:['POST'],
        )
    ]
    public function create(Request $request)
    {
        $result = json_decode($request->getContent());

        $uuid = Uuid::v4();
        $employee = new Employee(
            $uuid,
            $result->fio,
            $result->jobTitle,
            $result->description,
            $result->short_description,
            $result->is_active,
            new ArrayCollection(),
        );

        $this->em->persist($employee);
        $this->em->flush();

        return $this->json([
            'status'    => 'OK',
            'employee'  => $employee
        ], 200);
    }

    #[
        Route(
            '/employee/{id}',
            name:'employee_read',
            methods:['GET'],
        )
    ]
    public function read(string $id, Request $request)
    {
        if (!empty($id)){
            $employee = $this->em
                ->getRepository(Employee::class)
                ->findOneBy(['id' => $id]);
            return $this->json([
                'status'    => 'OK',
                'employee'  => $employee
            ], 200);
        }

        return $this->json([
            'status' => 'Error',
            'message'=> 'Сотрудник отсутствует'
        ], 404);
    }

    #[
        Route(
            '/employee/{id}',
            name:'employee_update',
            methods:['PUT'],
        )
    ]
    public function update(string $id, Request $request,): JsonResponse
    {
        $result = json_decode($request->getContent());
        if (!empty($result->id)){

            $employee = $this->em
                ->getRepository(Employee::class)
                    ->findOneBy(['id' => $result->id]);

            $employee->setFIO($result->fio ?? $employee->getFIO());

            $employee->setJobTitle($result->jobTitle ?? $employee->getJobTitle());

            $employee->setDescription($result->description ?? $employee->getDescription());

            $employee->setShortDescription($result->short_description ?? $employee->getShortDescription());

            $employee->setActive($result->is_active ?? $employee->getActive());

            $this->em->persist($employee);
            $this->em->flush();

            return $this->json([
                'status'    => 'OK',
                'employee'  => $employee
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Сотрудник отсутствует'
        ], 404);
    }

    #[
        Route(
            '/employee/{employee_id}/department/{department_id}',
            name:'employee_add_department',
            methods:['PUT'],
        )
    ]
    public function add_department(string $employee_id, string $department_id): JsonResponse
    {
        if (!empty($result->employee_id) && !empty($result->department_id)){

            $department = $this->em
                ->getRepository(Department::class)
                    ->findOneBy(['id' => $department_id]);

            $employee = $this->em
            ->getRepository(Employee::class)
                ->findOneBy(['id' => $employee_id]);
            
            $employee->addDepartments($department);

            $this->em->persist($employee);
            $this->em->flush();

            return $this->json([
                'status'    => 'OK',
                'employee'  => $employee
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Сотрудник отсутствует'
        ], 404);
    }

    #[
        Route(
            '/employee/{id}',
            name:'employee_delete',
            methods:['DELETE'],
        )
    ]
    public function delete(string $id): JsonResponse
    {
        if (!empty($id)){
            $employee = $this->em
                ->getRepository(Employee::class)
                    ->findOneBy(['id' => $id]);

            $this->em->remove($employee);
            $this->em->flush();

            return $this->json([
                'status'  => 'OK',
                'message' => 'Сотрудник успешно удален'
            ], 200);
        }
        return $this->json([
            'status' => 'Error',
            'message'=> 'Сотрудник отсутствует'
        ], 404);
    }

    #[
        Route(
            '/employee/{employee_id}/department/{department_id}',
            name:'employee_remove_department',
            methods:['DELETE'],
        )
    ]
    public function remove_employee(string $employee_id, string $department_id): JsonResponse
    {
        if (!empty($result->department_id) && !empty($result->employee_id)){

            $department = $this->em
                ->getRepository(Department::class)
                    ->findOneBy(['id' => $department_id]);

            $employee = $this->em
            ->getRepository(Employee::class)
                ->findOneBy(['id' => $employee_id]);
            
            $employee->removeDepartments($department);

            $this->em->persist($employee);
            $this->em->flush();

            return $this->json([
                'status'    => 'OK',
                'employee'  => $employee
            ], 200);
        }
        
        return $this->json([
            'status' => 'Error',
            'message'=> 'Сотрудник отсутствует'
        ], 404);
    }

}
