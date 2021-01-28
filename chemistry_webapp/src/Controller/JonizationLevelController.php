<?php

namespace App\Controller;

use App\Entity\Atom;
use App\Entity\JonizationLevel;
use App\Form\JonizationLevelType;
use App\Repository\JonizationLevelRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JonizationLevelController extends AbstractController
{
    /**
     * @Route("/jonization/list/{id}", name="jonization_level_list")
     */
    public function list(Atom $atom, Request $request, JonizationLevelRepository $jonizationLevelRepository): Response
    {
        $jonizationLevels = $jonizationLevelRepository->findBy(["atom"=>$atom]);

        return $this->render('jonization_level/list.html.twig', [
            "jonization_levels" => $jonizationLevels
        ]);
    }

    /**
     * @Route("/jonization/edit/{id}", name="jonization_level_edit")
     */
    public function edit(JonizationLevel $jonizationLevel, Request $request): Response
    {
        $form = $this->createForm(JonizationLevelType::class, $jonizationLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jonizationLevel);
            $entityManager->flush();
            $this->addFlash('show_result', "Edit jonization level");

            return $this->redirectToRoute("jonization_level_list", [
                "id" => $jonizationLevel->getAtom()->getId()
            ]);
        }
        return $this->render('jonization_level/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/jonization/add/{id}", name="jonization_level_add")
     */
    public function add(Atom $atom, Request $request): Response
    {
        $jonizationLevel = new JonizationLevel();
        $form = $this->createForm(JonizationLevelType::class, $jonizationLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jonizationLevel->setAtom($atom);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jonizationLevel);
            $entityManager->flush();
            $this->addFlash('show_result', "Add new jonization level");

            return $this->redirectToRoute("jonization_level_list", [
                "id" => $jonizationLevel->getAtom()->getId()
            ]);
        }
        return $this->render('jonization_level/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/jonization/delete/{id}", name="jonization_level_delete")
     */
    public function delete(JonizationLevel $jonizationLevel): Response
    {
        $atomId = $jonizationLevel->getAtom()->getId();

        if($jonizationLevel)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jonizationLevel);
            $em->flush();
        }
        return $this->redirectToRoute("jonization_level_list", [
            "id" => $atomId
        ]);
    }
}
