<?php

namespace App\Controller;

use App\Entity\JonizationLevel;
use App\Entity\OscillatorStrength;
use App\Form\OscillatorStrengthType;
use App\Repository\OscillatorStrengthRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OscillatorStrengthController extends AbstractController
{
    /**
     * @Route("/oscillator/strength/list/{id}", name="oscillator_strength_list")
     */
    public function index(JonizationLevel $jonizationLevel, OscillatorStrengthRepository $oscillatorStrengthRepository): Response
    {
        $oscillator_strengths = $oscillatorStrengthRepository->findBy(["jonizationLevel" => $jonizationLevel]);

        return $this->render('oscillator_strength/list.html.twig', [
            "oscillator_strengths" => $oscillator_strengths
        ]);
    }

    /**
     * @Route("/oscillator/strength/view/{id}", name="oscillator_strength_view")
     */
    public function view(JonizationLevel $jonizationLevel, OscillatorStrengthRepository $oscillatorStrengthRepository): Response
    {
        $oscillator_strengths = $oscillatorStrengthRepository->findBy(["jonizationLevel" => $jonizationLevel]);

        return $this->render('oscillator_strength/view.html.twig', [
            "oscillator_strengths" => $oscillator_strengths
        ]);
    }

    /**
     * @Route("/oscillator/strength/edit/{id}", name="oscillator_strength_edit")
     */
    public function edit(OscillatorStrength $oscillatorStrength, Request $request): Response
    {
        $form = $this->createForm(OscillatorStrengthType::class, $oscillatorStrength);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oscillatorStrength);
            $entityManager->flush();
            $this->addFlash('show_result', "Add new oscillator level");

            return $this->redirectToRoute("jonization_level_list",[
 		"id" => $oscillatorStrength->getJonizationLevel()->getAtom()->getId()
 	    ]);
        }

        return $this->render('oscillator_strength/edit.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/oscillator/strength/add/{id}", name="oscillator_strength_add")
     */
    public function add(JonizationLevel $jonizationLevel, Request $request): Response
    {
        $oscillatorStrength = new OscillatorStrength();
        $form = $this->createForm(OscillatorStrengthType::class, $oscillatorStrength);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oscillatorStrength->setJonizationLevel($jonizationLevel);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oscillatorStrength);
            $entityManager->flush();
            $this->addFlash('show_result', "Add new oscillator level");

            return $this->redirectToRoute("jonization_level_list", [
                "id" => $oscillatorStrength->getJonizationLevel()->getId()
            ]);
        }

        return $this->render('oscillator_strength/add.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/oscillator/strength/delete/{id}", name="oscillator_strength_delete")
     */
    public function delete(OscillatorStrength $oscillatorStrength): Response
    {
        $jonizationLevelId = $oscillatorStrength->getJonizationLevel()->getId();

        if($oscillatorStrength)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oscillatorStrength);
            $em->flush();
            $this->addFlash('show_result', "Deleted oscillator level from database");
        }
        return $this->redirectToRoute("jonization_level_list", [
            "id" => $jonizationLevelId
        ]);
    }
}
