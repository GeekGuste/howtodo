<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CategorieActualite;

/**
 * CategorieActualite controller.
 *
 * @Route("categorieActualite")
 */
class CategorieActualiteController extends Controller {

    /**
     * @Route("/", name="categorieActualite_index")
     * @Method("GET")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $categorieActualites = $em->getRepository('AppBundle:CategorieActualite')->findby([], ["libelle" => "desc"]);

        return $this->render('@App/CategorieActualite/index.html.twig', array(
                    'categorieActualites' => $categorieActualites,
        ));
    }

    /**
     * @Route("/new", name="categorieActualite_new")
     */
    public function newAction(Request $request) {
        $categorieActualite = new CategorieActualite();
        $form = $this->createForm('AppBundle\Form\CategorieActualiteType', $categorieActualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $image = $form["imageFile"]->getData();
            
            $nomImage = uniqid() . "." . $image->guessExtension();
            $dossier = $this->getParameter("categorie_article_images_dir");
            $image->move($dossier, $nomImage);
            $categorieActualite->setImage($nomImage);
            
            $em->persist($categorieActualite);
            $em->flush();

            $this->addFlash("success", "La categorie d'article a été ajoutée avec succès");

            return $this->redirectToRoute('categorieActualite_index');
        }

        return $this->render('@App/CategorieActualite/new.html.twig', array(
                    'categorieActualite' => $categorieActualite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="categorieActualite_edit")
     */
    public function editAction(Request $request, CategorieActualite $categorieActualite) {
        $editForm = $this->createForm('AppBundle\Form\CategorieActualiteType', $categorieActualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $image = $editForm["imageFile"]->getData();
            if($image != NULL){
                $nomImage = uniqid() . "." . $image->guessExtension();
                $dossier = $this->getParameter("categorie_article_images_dir");
                $image->move($dossier, $nomImage);
                $categorieActualite->setImage($nomImage);
            }   
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "La categorie d'articles a été modifiée avec succès");

            return $this->redirectToRoute('categorieActualite_index');
        }

        return $this->render('@App/CategorieActualite/edit.html.twig', array(
                    'categorieActualite' => $categorieActualite,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name = "categorieActualite_delete")
     */
    public function deleteAction(Request $request, CategorieActualite $categorieActualite) {
        $em = $this->getDoctrine()->getManager();
        $this->addFlash('success', "Le categorieActualite a été supprimé avec succès");
        $em->remove($categorieActualite);
        $em->flush();

        return $this->redirectToRoute('categorieActualite_index');
    }

}
