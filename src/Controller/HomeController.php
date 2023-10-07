<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EstimationFormType;
use App\Entity\Consumption;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        // booléen indiquant si le formulaire a été envoyé
        $submittedData = false;
        // données envoyées dans le formulaire
        $data = null;
        // autres données sur la page
        $header = [
            'h1' => "Faites une estimation en ligne",
        ];
        $section = [
            'h2' => "Mes avantages",
        ];
        
        // le formulaire
        $form = $this->createForm(EstimationFormType::class);
        // gestion du formulaire (envoi etc)
        $form->handleRequest($request);
        
        // si le formulaire est validé
        if ($form->isSubmitted() && $form->isValid()) {
            // récupération des données du formulaire
            $data = $this->manageSubmittedData($form->getData());
            // màj du booléen correspondant
            dump(get_class_methods($form));
            $submittedData = true;
            $form = $this->createForm(EstimationFormType::class);
        }

        // rendering de la homepage
        return $this->render('home/index.html.twig', [
            'submittedData' => $submittedData,
            'form' => $form,
            'data' => $data,
            'header' => $header,
            'section' => $section
        ]);
    }

    /**
     * méthode traitant les données du formulaire
     */
    public function manageSubmittedData(array $data): array
    {
        return $calculi = [
            'recommendedPower' => null,
            'estimatedSavedEnergy' => null,
            'nbPannels' => null,
        ];
    }
}
