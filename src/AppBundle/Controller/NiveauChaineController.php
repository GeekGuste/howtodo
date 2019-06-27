<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NiveauChaine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Niveauchaine controller.
 *
 * @Route("niveauchaine")
 */
class NiveauChaineController extends Controller
{
    /**
     * Lists all niveauChaine entities.
     *
     * @Route("/", name="niveauchaine_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $niveauChaines = $em->getRepository('AppBundle:NiveauChaine')->findAll();

        return $this->render('AppBundle:niveauchaine:index.html.twig', array(
            'niveauChaines' => $niveauChaines,
        ));
    }

    /**
     * Creates a new niveauChaine entity.
     *
     * @Route("/new", name="niveauchaine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $niveauChaine = new Niveauchaine();
        $form = $this->createForm('AppBundle\Form\NiveauChaineType', $niveauChaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($niveauChaine);
            $em->flush();

            $this->addFlash('success', 'Niveau de chaine ajouté avec succès');
            
            return $this->redirectToRoute('niveauchaine_index');
        }

        return $this->render('AppBundle:niveauchaine:new.html.twig', array(
            'niveauChaine' => $niveauChaine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing niveauChaine entity.
     *
     * @Route("/{id}/edit", name="niveauchaine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NiveauChaine $niveauChaine)
    {
        $deleteForm = $this->createDeleteForm($niveauChaine);
        $editForm = $this->createForm('AppBundle\Form\NiveauChaineType', $niveauChaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Niveau de chaine modifié avec succès');
            return $this->redirectToRoute('niveauchaine_index');
        }

        return $this->render('AppBundle:niveauchaine:edit.html.twig', array(
            'niveauChaine' => $niveauChaine,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a niveauChaine entity.
     *
     * @Route("/{id}/delete", name="niveauchaine_delete")
     */
    public function deleteAction(Request $request, NiveauChaine $niveauChaine)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($niveauChaine);
        $em->flush();
        $this->addFlash('success', 'Niveau de chaine supprimé avec succès');
        return $this->redirectToRoute('niveauchaine_index');
    }
}
