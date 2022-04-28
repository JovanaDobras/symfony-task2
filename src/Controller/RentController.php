<?php

namespace App\Controller;

use App\Repository\RentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    #[Route('/rent', name: 'app_rent')]
    public function index(RentRepository $rr): Response
    {
        $rentAll = $rr->findAll();

        return $this->render('rent/index.html.twig', [ 'rentsAll' => $rentAll]);
    }
}
