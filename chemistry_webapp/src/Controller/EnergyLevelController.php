<?php

namespace App\Controller;

use App\Entity\EnergyLevel;
use App\Entity\JonizationLevel;
use App\Form\EnergyLevelFormType;
use App\Repository\EnergyLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnergyLevelController extends AbstractController
{
    /**
     * @Route("/energy/level", name="energy_level")
     */
    public function index(): Response
    {
        return $this->render('energy_level/list.html.twig', [
            'energy_levels' => null,
        ]);
    }

    /**
     * @Route("/energy/level/add/{id}", name="energy_level_add")
     */
    public function add(JonizationLevel $jonizationLevel, Request $request): Response
    {
        $energyLevel = new EnergyLevel();
        $form = $this->createForm(EnergyLevelFormType::class, $energyLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $energyLevel->setJonizationLevel($jonizationLevel);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($energyLevel);
            $entityManager->flush();
            $this->addFlash('show_result', "Add new energy level");

            return $this->redirectToRoute("jonization_level_list", [
                "id" => $jonizationLevel->getAtom()->getId(),
            ]);
        }
        return $this->render('energy_level/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/energy/level/list/{id}", name="energy_level_list")
     */
    public function atomList(JonizationLevel $jonizationLevel, EnergyLevelRepository $energyLevelRepository): Response
    {
        $energyLevels = $energyLevelRepository->findBy(["jonizationLevel" => $jonizationLevel]);

        return $this->render('energy_level/list.html.twig', [
            "energy_levels" => $energyLevels
        ]);
    }

    /**
     * @Route("/energy/level/view/{id}", name="energy_level_view")
     */
    public function view(JonizationLevel $jonizationLevel, EnergyLevelRepository $energyLevelRepository): Response
    {
        $energyLevels = $energyLevelRepository->findBy(["jonizationLevel" => $jonizationLevel]);

        return $this->render('energy_level/view.html.twig', [
            "energy_levels" => $energyLevels
        ]);
    }

    /**
     * @Route("/energy/level/delete/{id}", name="energy_level_delete")
     */
    public function delete(EnergyLevel $energyLevel): Response
    {
        $jonizationLevelId = $energyLevel->getJonizationLevel()->getId();

        if($energyLevel)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($energyLevel);
            $em->flush();
        }
        return $this->redirectToRoute("energy_level_list", [
            "id" => $jonizationLevelId
        ]);
    }

    /**
     * @Route("/energy/level/edit/{id}", name="energy_level_edit")
     */
    public function edit(EnergyLevel $energyLevel, Request $request): Response
    {
        $form = $this->createForm(EnergyLevelFormType::class, $energyLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($energyLevel);
            $entityManager->flush();
            $this->addFlash('show_result', "Edit energy level");

            return $this->redirectToRoute("energy_level_list", [
                "id" => $energyLevel->getJonizationLevel()->getId(),
            ]);
        }

        return $this->render('energy_level/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
