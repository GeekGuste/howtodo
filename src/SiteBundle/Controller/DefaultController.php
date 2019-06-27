<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CategorieProduit;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
        return $this->redirectToRoute('accueil_howtodo');
    }

    
    /**
     * @Route("/c/{slug}", name="display_categorie")
     */
    public function categorieAction(Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $selectedCategorieActualite = $em->getRepository("AppBundle:CategorieActualite")->findOneBy(["slug" => $slug]);
        $actualites = $em->createQuery( "select a " .
                                        " from AppBundle:Actualite a " .
                                        " join a.categorieActualites cat" .
                                        " where cat = :ca"
                                    )
                                    ->setParameter("ca", $selectedCategorieActualite)
                                    ->getResult();
        
       $categorieActualites = $em->createQuery( "select c " .
                                        " from AppBundle:CategorieActualite c " .
                                        " join c.actualites a" .
                                        " where (c.parent is null or c.parent = :parent)" .
                                        " order by c.id desc"
                                    )
                                    ->setParameter("parent", $selectedCategorieActualite->getParent())
                                    ->getResult();
        
        $paginator  = $this->get('knp_paginator');
        $actualites = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
        
        return $this->render('@Site/actualite/actualite_categorie.html.twig', array(
            'selectedCategorieActualite' => $selectedCategorieActualite,
            'categorieActualites' => $categorieActualites,
            'actualites' => $actualites,
            ));
    }
    
    /**
     * @Route("/produits", name="produits_page")
     */
    public function produitAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categorieProduits = $em->getRepository('AppBundle:CategorieProduit')->findAll([]);
        $selectedCategorieProduit = $em->getRepository('AppBundle:CategorieProduit')->findOneBy([]);
        $produits = $em->getRepository('AppBundle:Produit')->findByCategorieProduit($selectedCategorieProduit);
        
        $paginator  = $this->get('knp_paginator');
        $produits = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit par page*/
        );
        
        return $this->render('@Site/Default/produits.html.twig', array(
                'categorieProduits' => $categorieProduits,
                'selectedCategorieProduit' => $selectedCategorieProduit,
                'produits' => $produits,
            ));
    }

    /**
     * @Route("/produits/{selectedCategorieProduit}", name="produits_categorie_page")
     */
    public function produitParCategorieAction(CategorieProduit $selectedCategorieProduit, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categorieProduits = $em->getRepository('AppBundle:CategorieProduit')->findAll([]);
        $produits = $em->getRepository('AppBundle:Produit')->findByCategorieProduit($selectedCategorieProduit);
        
        $paginator  = $this->get('knp_paginator');
        $produits = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );
        
        return $this->render('@Site/Default/produits.html.twig', array(
                'categorieProduits' => $categorieProduits,
                'selectedCategorieProduit' => $selectedCategorieProduit,
                'produits' => $produits,
            ));
    }

    /**
     * @Route("/page/{slug}", name="display_page")
     */
    public function pageAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $page  = $em->getRepository("AppBundle:Page")->findOneBySlug($slug);
        
        return $this->render('@Site/Default/page.html.twig', array('page' => $page));
    }

}
