<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Entity\Deliverers;
use App\Repository\RentRepository;
use App\Repository\VehiclesRepository;
use App\Repository\DeliverersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelivererController extends AbstractController
{
    #[Route('/deliverer', name: 'app_deliverer')]
    
    public function all_deliverer(DeliverersRepository $dr, VehiclesRepository $vr): Response
    {
        $rentacar = $dr->findAll();
        $vehicle = $vr->findAll();

        return $this->render('deliverer/index.html.twig', ['rentacar' => $rentacar, 'vehicles' => $vehicle]);
    }


    #[Route('/deliverer-history/{id}', name: 'deliverer-history')]

    public function deliverer_history($id, DeliverersRepository $dr, RentController $rc){

        $deliverer = $dr->find($id);
        $rent_history = $deliverer->getRents();


        return $this->render('deliverer/history.html.twig',[
            'rent_historys'=>$rent_history,
        ]);
    }

    #[Route('/rent-car', name:'rent-car', methods:['GET', 'POST'])]

    public function rentCar(Request $request, RentRepository $rr, DeliverersRepository $dr, VehiclesRepository $vr): Response
    {

        $select_option = $request->request->get('select-option');
        $delivererId = $request->request->get('getId');
        $submitselect = $request->request->get('submit-select');

        if(isset($submitselect)){

            $deliverer = $dr->find($delivererId);
            $vehicle = $vr->find($select_option);

            $rentACar = new Rent();
            $rentACar->setDeliverer($deliverer);
            $rentACar->setVehicle($vehicle);

            $rr->add($rentACar);           
        }

        return $this->redirectToRoute('app_deliverer', [], Response::HTTP_SEE_OTHER);

    }


    #[Route('/add-deliverer', name: 'add-deliverer',  methods:['GET', 'POST'])]

    public function addDeliverer(Request $request, DeliverersRepository $dr){

        $submitAdd = $request->request->get('submitAdd');
        $name = $request->request->get('name');


        if(isset($submitAdd)){

            $delivererNew = new Deliverers();
            $delivererNew->setName($name);

            $dr->add($delivererNew);

            // return $this->redirectToRoute('app_deliverer', [], Response::HTTP_SEE_OTHER);

        }

        return $this->redirectToRoute('app_deliverer', [], Response::HTTP_SEE_OTHER);



    }




}
