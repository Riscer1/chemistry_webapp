<?php

namespace App\Controller;

use App\Entity\FikRef;
use App\Entity\OscillatorStrength;
use App\Form\FikRefType;
use App\Repository\FikRefRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FikRefController extends AbstractController
{

    /**
     * @Route("/fik/ref/lsit/{id}", name="fik_ref_list")
     */
    public function list(OscillatorStrength $oscillatorStrength, Request $request, FikRefRepository $fikRefRepository): Response
    {
        $fikRef= $fikRefRepository->findBy(["oscillatorStrength" => $oscillatorStrength]);

        return $this->render('fik_ref/list.html.twig', [
            "fik_ref" => $fikRef
        ]);
    }

    /**
     * @Route("/fik/ref/view/{id}", name="fik_ref_view")
     */
    public function view(OscillatorStrength $oscillatorStrength, Request $request, FikRefRepository $fikRefRepository): Response
    {
        $fikRef= $fikRefRepository->findBy(["oscillatorStrength" => $oscillatorStrength]);

        return $this->render('fik_ref/view.html.twig', [
            "fik_ref" => $fikRef
        ]);
    }

    /**
     * @Route("/fik/ref/edit/{id}", name="fik_ref_edit")
     */
    public function edit(FikRef $fikRef, Request $request): Response
    {
        $form = $this->createForm(FikRefType::class, $fikRef);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fikRef);
            $entityManager->flush();
            $this->addFlash('show_result', "Edit new fik ref");

            return $this->redirectToRoute("oscillator_strength_list", [
                "id" => $fikRef->getOscillatorStrength()->getJonizationLevel()->getId(),
            ]);
        }

        return $this->render('fik_ref/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/fik/ref/add/{id}", name="fik_ref_add")
     */
    public function add(OscillatorStrength $oscillatorStrength, Request $request): Response
    {
        $fikRef = new FikRef();
        $form = $this->createForm(FikRefType::class, $fikRef);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fikRef->setOscillatorStrength($oscillatorStrength);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fikRef);
            $entityManager->flush();
            $this->addFlash('show_result', "Add new fik ref");

            return $this->redirectToRoute("oscillator_strength_list", [
                "id" => $oscillatorStrength->getJonizationLevel()->getId(),
            ]);
        }
        return $this->render('fik_ref/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/fik/ref/add/delete/{id}", name="fik_ref_delete")
     */
    public function delete(FikRef $fikRef): Response
    {
        $firkRefId = $fikRef->getOscillatorStrength()->getId();

        if($fikRef)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fikRef);
            $em->flush();
            $this->addFlash('show_result', "Deleted oscillator level from database");
        }
        return $this->redirectToRoute("fik_ref_list", [
            "id" => $firkRefId
        ]);
    }
}
