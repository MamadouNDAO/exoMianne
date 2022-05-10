<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/users')]
    public function listUsers(Request $request, EntityManagerInterface $em):Response
    {
        $dbusers = $em->getRepository(User::class)->findAll();
        
        //dd($dbusers);

        return $this->render('main/index.html.twig', [
            'users' => $dbusers,
        ]);
    }

    #[Route('/users/name')]
    public function listUsersName(Request $request, EntityManagerInterface $em):Response
    {
        $dbusers = $em->getRepository(User::class)->findAll();

        return $this->render('main/user_nom.html.twig', [
            'users' => $dbusers,
        ]);
    }

    #[Route('/users/{id}')]
    public function userInfo(Request $request, EntityManagerInterface $em, $id):Response
    {
        $dbuser = $em->getRepository(User::class)->findOneBy(['id' => $id]);

        return $this->render($dbuser ? 'main/info_user.html.twig' : 'main/error.html.twig', [
            'user' => $dbuser,
        ]);
    }
} 