<?php

namespace App\Controller;

use App\Entity\Vehicles;
use App\Repository\VehiclesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehicleController extends AbstractController
{
    #[Route('vehiclesAll', name: 'vehiclesAll')]

    public function delivererAll(VehiclesRepository $vr){

        $vehicleAll = $vr->findAll();

        return $this->render('vehicle/index.html.twig', ['vehiclesAll' => $vehicleAll]);
    }


    #[Route('/add-vehicle', name: 'add-vehicle')]

    public function addDeliverer(Request $request, VehiclesRepository $vr){

        $brand = $request->request->get('brand');
        $model = $request->request->get('model');
        $submitVehicle = $request->request->get('submitAddVehicle');

        if(isset($submitVehicle)){

            $vehicle = new Vehicles();
            $vehicle->setBrand($brand);
            $vehicle->setModel($model);

            $vr->add($vehicle);

            return $this->redirectToRoute('vehiclesAll', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vehicle/addVehicle.html.twig');
    }
}
