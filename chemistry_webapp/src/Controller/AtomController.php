<?php

namespace App\Controller;

use App\Entity\Atom;
use App\Entity\Image;
use App\Entity\JonizationLevel;
use App\Form\AtomType;
use App\Repository\AtomRepository;
use App\Repository\ImageRepository;
use App\Repository\JonizationLevelRepository;
use App\Service\FileUploader;
use Doctrine\DBAL\Exception;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class AtomController extends AbstractController
{

    /**
     * @Route("/search", name="search_atom_by_id")
     */
    public function searchAtomById(Request $request, AtomRepository $atomRepository, JonizationLevelRepository $jonizationLevelRepository): Response
    {
        $idAtom = $request->query->get('id_atom');

        $atom = $atomRepository->findOneBy(["id"=>$idAtom]);
        if($atom != null) {
            $urlImages = [];
            $images = $atom->getImages();
            $destination = 'uploads/images/';

            foreach ($images as $image) {
                array_push($urlImages, $destination . $image->getImg());
            }
            $jonizationLevels = $jonizationLevelRepository->findBy(["atom"=>$atom]);

            return $this->render('atom/view.html.twig', [
                "atom" => $atom,
                "url_images" => $urlImages,
                "jonization_levels" => $jonizationLevels
            ]);
        }
        else {
            $this->addFlash('show_result', "Can't find  *$idAtom* in databases");
            return $this->redirectToRoute("home");
        }
    }

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, AtomRepository $atomRepository, JonizationLevelRepository $jonizationLevelRepository): Response
    {
        $options = ['csrf_protection' => false];

        $form = $this->createFormBuilder(null, $options)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Symbol' => true,
                    'Name' => false
                ],
            ])
            ->add('value', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Search'])
            ->getForm();

        $atoms = $atomRepository->findAll();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $type = $request->request->get("form")["type"];
            $value = $request->request->get("form")["value"];
            $atom = null;
            if($type == 1)
                $atom = $atomRepository->findOneByAtomSymbol($value);
            if($type == 0)
                $atom = $atomRepository->findOneByName($value);

            if($atom == null)
            {
                $this->addFlash('show_result', "Can't find  *$value* in databases");
                return $this->redirectToRoute("home");
            }
            else
            {
                $urlImages = [];
                $images = $atom->getImages();
                $destination = 'uploads/images/';

                foreach ($images as $image)
                {
                    array_push($urlImages,$destination.$image->getImg());
                }

                $jonizationLevels = $jonizationLevelRepository->findBy(["atom"=>$atom]);

                return $this->render('atom/view.html.twig', [
                    "atom" => $atom,
                    "url_images" => $urlImages,
                    "jonization_levels" => $jonizationLevels
                ]);
            }
        }
        return $this->render('atom/index.html.twig', [
            'form' => $form->createView(),
            'atoms' => $atoms
        ]);
    }

    /**
     * @Route("/atom/edit/{id}", name="atom_edit")
     */
    public function edit(Atom $atom, Request $request, AtomRepository $atomRepository, FileUploader  $fileUploader): Response
    {
        $form = $this->createForm(AtomType::class, $atom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atom);
            $em->flush();

            $imageFile = $form->get("image")->getData();

            if($atom && $imageFile)
            {
                $imageFileName = $fileUploader->upload($imageFile);

                $em = $this->getDoctrine()->getManager();
                $image = new Image();
                $image->setAtom($atom);
                $image->setImg($imageFileName);

                $em->persist($image);
                $em->flush();
            }
            return $this->redirectToRoute('atom_list');
        }

        $urlImages = [];
        $images = $atom->getImages();
        $destination = 'uploads/images/';

        foreach ($images as $image)
        {
            array_push($urlImages, ["id_image" => $image->getId(), "url_image" => $destination.$image->getImg()]);
        }

        return $this->render('atom/edit.html.twig', [
            "form" => $form->createView(),
            "url_images" => $urlImages
        ]);
    }

    /**
     * @Route("/atom/delete/image/{id}", name="image_delete")
     */
    public function deleteImageFromDatabase(Image $image): Response
    {
        if($image != null)
        {
            $idAtom = $image->getAtom()->getId();
            $this->addFlash('show_result', "You deleted image from database symbol: ");
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            return $this->redirectToRoute("atom_edit", ["id" => $idAtom]);
        }
        return $this->redirectToRoute("atom_list");
    }

    /**
     * @Route("/atom/atom/delete/{id}", name="atom_delete")
     */
    public function delete(Atom $atom, AtomRepository $atomRepository,ImageRepository $imageRepository): Response
    {
        $imageRepository->deleteAllImageByAtomId($atom->getId());
        if($atom != null)
        {
            $this->addFlash('show_result', "You deleted from database symbol: ".$atom->getSymbol());
            $em = $this->getDoctrine()->getManager();
            $em->remove($atom);
            $em->flush();
        }
        return $this->redirectToRoute("atom_list");
    }

    /**
     * @Route("/atom/list", name="atom_list")
     */
    public function atomList(AtomRepository $atomRepository): Response
    {
        return $this->render('atom/list.html.twig', [
            "atoms" => $atomRepository->findAll()
        ]);
    }

    /**
     * @Route("/atom/new", name="atom_new")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $atom = new Atom();
        $form = $this->createForm(AtomType::class, $atom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get("image")->getData();
            try
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($atom);
                $em->flush();
            }catch (Exception $e)
            {
                $this->addFlash('show_result', "Can't add atom");
                return $this->redirectToRoute('atom_list');
            }
            if($imageFile)
            {
                try {
                    $imageFileName = $fileUploader->upload($imageFile);
                    $image = new Image();
                    $image->setAtom($atom);
                    $image->setImg($imageFileName);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($image);
                    $em->flush();
                }catch (Exception $e)
                {
                    $this->addFlash('show_result', "Can't add image");
                    return $this->redirectToRoute('atom_list');
                }
            }

            return $this->redirectToRoute('atom_list');
        }

        return $this->render('atom/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
