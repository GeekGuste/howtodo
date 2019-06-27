<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategorieChaine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categoriechaine controller.
 *
 * @Route("categoriechaine")
 */
class CategorieChaineController extends Controller
{
    /**
     * Lists all categorieChaine entities.
     *
     * @Route("/", name="categoriechaine_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieChaines = $em->getRepository('AppBundle:CategorieChaine')->findAll();

        return $this->render('AppBundle:categoriechaine:index.html.twig', array(
            'categorieChaines' => $categorieChaines,
        ));
    }

    /**
     * Creates a new categorieChaine entity.
     *
     * @Route("/new", name="categoriechaine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorieChaine = new Categoriechaine();
        $form = $this->createForm('AppBundle\Form\CategorieChaineType', $categorieChaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieChaine);
            $em->flush();

            $this->addFlash("success", "Catégorie de chanes ajoutée avec succès");
            
            return $this->redirectToRoute('categoriechaine_index');
        }

        return $this->render('AppBundle:categoriechaine:new.html.twig', array(
            'categorieChaine' => $categorieChaine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieChaine entity.
     *
     * @Route("/{id}/edit", name="categoriechaine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategorieChaine $categorieChaine)
    {
        $deleteForm = $this->createDeleteForm($categorieChaine);
        $editForm = $this->createForm('AppBundle\Form\CategorieChaineType', $categorieChaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->flush();
            $this->addFlash("success", "Catégorie de chanes modifiée avec succès");
            return $this->redirectToRoute('categoriechaine_index');
        }

        return $this->render('AppBundle:categoriechaine:edit.html.twig', array(
            'categorieChaine' => $categorieChaine,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a categorieChaine entity.
     *
     * @Route("/{id}/delete", name="categoriechaine_delete")
     */
    public function deleteAction(Request $request, CategorieChaine $categorieChaine)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorieChaine);
        $em->flush();
        
        $this->addFlash("success", "Catégorie de chanes supprimée avec succès");
        
        return $this->redirectToRoute('categoriechaine_index');
    }
}
