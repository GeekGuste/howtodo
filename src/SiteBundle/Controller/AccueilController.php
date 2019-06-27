<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccueilController extends Controller {

    /**
     * @Route("/", name="accueil_howtodo")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        /*$slides = $em->getRepository('AppBundle:Slides')->findby([], ["libelle" => "desc"]);

        $partenaires = $em->getRepository('AppBundle:Partenaire')->findOneby([]);
        
        $img = $em->getRepository('AppBundle:Image')->find(1);
        
        $images = $em->getRepository('AppBundle:Image')->findby([], ["titre" => "desc"]);

        $imager = $em->getRepository('AppBundle:Image')->findby(["id" => 1], ["titre" => "desc"]);
*/
        $articles = $em->getRepository("AppBundle:Actualite")->findBy([], ["date" => "desc"]);
        $categorieArticles = $em->createQuery( "select c " .
                                                " from AppBundle:CategorieActualite c " .
                                                " join c.actualites a" .
                                                " order by c.id desc"
                                            )
                                            ->getResult();

        $paginator = $this->get('knp_paginator');
        $articles = $paginator->paginate(
                $articles, /* query NOT result */ 1/* page number */, 8/* limit per page */
        );

        return $this->render('@Site/accueil/index.html.twig', array(
                    /*"img" => $img,
                    'slides' => $slides,
                    'partenaires' => $partenaires,
                    'imager' => $imager,*/
                    'articles' => $articles,
                    'categorieArticles' => $categorieArticles,
        ));
    }

}
