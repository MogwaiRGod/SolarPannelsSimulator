<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EstimationFormType;
use App\Entity\Consumption;
use App\Entity\User;
use App\Entity\Roof;
use App\Entity\Installation;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        // booléen indiquant si le formulaire a été envoyé
        $submittedData = false;
        // données envoyées dans le formulaire
        $results = null;
        // autres données sur la page
        $header = [
            'h1' => "Faites une estimation en ligne",
        ];
        $section = [
            'h2' => "Mes avantages",
        ];
        $formTemplate = [
            'h3' => "Je calcule mes avantages",
            'cover' => [
                'path' => 'images/man_pannel.jpg',
                'alt' => 'Homme posant un panneau photovoltaïque',
            ],
        ];
        
        // le formulaire
        $form = $this->createForm(EstimationFormType::class);
        // gestion du formulaire (envoi etc)
        $form->handleRequest($request);
        
        // si le formulaire est validé
        if ($form->isSubmitted() && $form->isValid()) {
            // récupération et traitement des données du formulaire
            $results = $this->manageSubmittedData($form->getData());
            // màj du booléen correspondant
            $submittedData = true;
        }

        // rendering de la homepage
        return $this->render('home/index.html.twig', [
            'submittedData' => $submittedData,
            'form' => $form,
            'results' => $results,
            'header' => $header,
            'section' => $section,
            'formTemplate' => $formTemplate,
        ]);
    }

    /**
     * @param array $data : données du formulaire 
     * @return array : données à afficher sur la page
     * 
     * méthode traitant les données du formulaire
     */
    public function manageSubmittedData(array $data): array
    {
        // création des objets à partir des données utilisateur
        $roofUser = new Roof($data["length"], $data["width"]);
        $consumptionUser = new Consumption($data["bill"]);
        $user = new User($data["firstName"], $data["lastName"], $roofUser, $consumptionUser);
        $roofUser = $roofUser->setUser($user);
        $installationUser = new Installation($roofUser);

        // tableau avec les données calculées à afficher sur la page
        return $calculi = [
            'recommendedPower' => $installationUser->getReqPow(),
            'estimatedSavedEnergy' => $installationUser->getIdealProduction(),
            'nbPannels' => $installationUser->getNbPannMax(),
        ];
    }
}
