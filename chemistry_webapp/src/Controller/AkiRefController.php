<?php

namespace App\Controller;

use App\Entity\AkiRef;
use App\Entity\OscillatorStrength;
use App\Form\AkiRefType;
use App\Repository\AkiRefRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AkiRefController extends AbstractController
{
    /**
     * @Route("/aki/ref/list/{id}", name="aki_ref_list")
     */
    public function list(OscillatorStrength $oscillatorStrength, Request $request, AkiRefRepository $fikRefRepository): Response
    {
        $akiRef = $fikRefRepository->findBy(["oscillatorStrength" => $oscillatorStrength]);

        return $this->render('aki_ref/list.html.twig', [
            "aki_ref" => $akiRef
        ]);
    }

    /**
     * @Route("/aki/ref/view/{id}", name="aki_ref_view")
     */
    public function view(OscillatorStrength $oscillatorStrength, Request $request, AkiRefRepository $fikRefRepository): Response
    {
        $akiRef = $fikRefRepository->findBy(["oscillatorStrength" => $oscillatorStrength]);

        return $this->render('aki_ref/view.html.twig', [
            "aki_ref" => $akiRef
        ]);
    }

    /**
     * @Route("/aki/ref/", name="aki_ref")
     */
    public function index(): Response
    {
        return $this->render('aki_ref/index.html.twig', [
            'controller_name' => 'AkiRefController',
        ]);
    }

    /**
     * @Route("/aki/ref/add/{id}", name="aki_ref_add")
     */
    public function add(OscillatorStrength $oscillatorStrength, Request $request): Response
    {
        $akiRef = new AkiRef();
        $form = $this->createForm(AkiRefType::class, $akiRef);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $akiRef->setOscillatorStrength($oscillatorStrength);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($akiRef);
            $entityManager->flush();
            $this->addFlash('show_result', "Add new aki ref");

            return $this->redirectToRoute("oscillator_strength_list", [
                "id" => $oscillatorStrength->getJonizationLevel()->getId(),
            ]);
        }

        return $this->render('aki_ref/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/aki/ref/edit/{id}", name="aki_ref_edit")
     */
    public function edit(AkiRef $akiRef, Request $request): Response
    {
        $form = $this->createForm(AkiRefType::class, $akiRef);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($akiRef);
            $entityManager->flush();
            $this->addFlash('show_result', "Edit new aki ref");

            return $this->redirectToRoute("oscillator_strength_list", [
                "id" => $akiRef->getOscillatorStrength()->getJonizationLevel()->getId(),
            ]);
        }

        return $this->render('aki_ref/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/aki/ref/delete/{id}", name="aki_ref_delete")
     */
    public function delete(AkiRef $akiRef): Response
    {
        $atomId = $akiRef->getOscillatorStrength()->getId();

        if($akiRef)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($akiRef);
            $em->flush();
        }
        return $this->redirectToRoute("aki_ref_list", [
            "id" => $atomId
        ]);
    }
}
