<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chaine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Chaine controller.
 *
 * @Route("chaine")
 */
class ChaineController extends Controller
{
    /**
     * Lists all chaine entities.
     *
     * @Route("/", name="chaine_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $chaines = $em->getRepository('AppBundle:Chaine')->findAll();
        $paginator  = $this->get('knp_paginator');
        $chaines = $paginator->paginate(
            $chaines, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return $this->render('AppBundle:chaine:index.html.twig', array(
            'chaines' => $chaines,
        ));
    }

    /**
     * Creates a new chaine entity.
     *
     * @Route("/new", name="chaine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $chaine = new Chaine();
        $form = $this->createForm('AppBundle\Form\ChaineType', $chaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $image = $form["imageFile"]->getData();
            
            $nomImage = uniqid() . "." . $image->guessExtension();
            $dossier = $this->getParameter("chaine_images_dir");
            $image->move($dossier, $nomImage);
            
            $chaine->setImage($nomImage);
            
            $em->persist($chaine);
            $em->flush();

            $this->addFlash("success", "Chaine ajutée avec succès");
            
            return $this->redirectToRoute('chaine_index');
        }

        return $this->render('AppBundle:chaine:new.html.twig', array(
            'chaine' => $chaine,
            'form' => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing chaine entity.
     *
     * @Route("/{id}/edit", name="chaine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Chaine $chaine)
    {
        $editForm = $this->createForm('AppBundle\Form\ChaineType', $chaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $image = $editForm["imageFile"]->getData();
            if($image != NULL){
                $nomImage = uniqid() . "." . $image->guessExtension();
                $dossier = $this->getParameter("chaine_images_dir");
                $image->move($dossier, $nomImage);
                $chaine->setImage($nomImage);
            }
            
            $em->persist($chaine);
            $em->flush();
            
            $this->addFlash("success", "L'actualite a été modifiée avec succès");
            return $this->redirectToRoute('chaine_index');
        }

        return $this->render('AppBundle:chaine:edit.html.twig', array(
            'chaine' => $chaine,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Shows a chaine articles.
     *
     * @Route("/{id}/articles", name="chaine_articles_list")
     */
    public function articlesAction(Request $request, Chaine $chaine)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("AppBundle:Actualite")->findBy(["chaine" => $chaine], ["position" => "asc"]);
        
        return $this->render('AppBundle:chaine:articles.html.twig', array(
            'chaine' => $chaine,
            'articles' => $articles,
        ));
    }

    /**
     * Shows a chaine articles.
     *
     * @Route("/{id}/permuter/articles", name="chaine_articles_permute", options = { "expose" = true })
     * @Method("POST")
     */
    public function permuteArticlesAction(Request $request, Chaine $chaine)
    {
        //Si c'est par ajax
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $position1 = $request->request->get("position1");
            $position2 = $request->request->get("position2");
            
            $article1 = $em->getRepository("AppBundle:Actualite")->findOneBy(["chaine" => $chaine, "position" => $position1]);
            $article2 = $em->getRepository("AppBundle:Actualite")->findOneBy(["chaine" => $chaine, "position" => $position2]);
            
            $article1->setPosition($position2);
            $article2->setPosition($position1);
            
            $em->persist($article1);            
            $em->persist($article2);
            $em->flush();
            
            return new Response("ok");
        }
        
        throw new AccessDeniedHttpException("Accès interdit");
    }

    /**
     * Create a chaine article.
     *
     * @Route("/{id}/add/article", name="chaine_add_article_index")
     */
    public function addArticleAction(Request $request, Chaine $chaine)
    {
        return $this->redirectToRoute('actualite_new', array('chaine_id'=> $chaine->getId()));
    }

    /**
     * Deletes a chaine entity.
     *
     * @Route("/{id}", name="chaine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Chaine $chaine)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($chaine);
        $em->flush();
        $this->addFlash('success', "Chaine supprimée avec succès");
        return $this->redirectToRoute('chaine_index');
    }
}
