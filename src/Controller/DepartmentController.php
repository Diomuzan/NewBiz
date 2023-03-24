<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    #[Route('/{slug}', name: 'Department')]
    public function department(Request $request): Response {
    $department = new Department();
    $form = $this->createForm(DepartmentFormType::Class, $department);
    $form->handleRequest($request);

    if ($form->isSubmitted() &&  $form->isValid()) {
     dd($form->getData());
    }

    return $this->render('department/index.html.twig', ['DepartmentForm' => $form]);
    }
}

