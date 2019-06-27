<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chaine
 *
 * @ORM\Table(name="chaine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChaineRepository")
 */
class Chaine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_eng", type="string", length=255)
     */
    private $nomEng;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="description_eng", type="text", nullable = true)
     */
    private $descriptionEng;
    
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Actualite", mappedBy="chaine")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="CategorieChaine", inversedBy="chaines")
     * @ORM\JoinColumn(name="categorie_chaine_id", referencedColumnName="id")
     */
    private $categorieChaines;

    /**
     * @ORM\ManyToOne(targetEntity="NiveauChaine", inversedBy="chaines")
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id", nullable=true)
     */
    private $niveauChaine;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Chaine
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Chaine
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actualites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nomEng
     *
     * @param string $nomEng
     *
     * @return Chaine
     */
    public function setNomEng($nomEng)
    {
        $this->nomEng = $nomEng;

        return $this;
    }

    /**
     * Get nomEng
     *
     * @return string
     */
    public function getNomEng()
    {
        return $this->nomEng;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Actualite $article
     *
     * @return Chaine
     */
    public function addArticle(\AppBundle\Entity\Actualite $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Actualite $article
     */
    public function removeArticle(\AppBundle\Entity\Actualite $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Chaine
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set descriptionEng
     *
     * @param string $descriptionEng
     *
     * @return Chaine
     */
    public function setDescriptionEng($descriptionEng)
    {
        $this->descriptionEng = $descriptionEng;

        return $this;
    }

    /**
     * Get descriptionEng
     *
     * @return string
     */
    public function getDescriptionEng()
    {
        return $this->descriptionEng;
    }

    /**
     * Add categorieChaine
     *
     * @param \AppBundle\Entity\CategorieChaine $categorieChaine
     *
     * @return Chaine
     */
    public function addCategorieChaine(\AppBundle\Entity\CategorieChaine $categorieChaine)
    {
        $this->categorieChaines[] = $categorieChaine;

        return $this;
    }

    /**
     * Remove categorieChaine
     *
     * @param \AppBundle\Entity\CategorieChaine $categorieChaine
     */
    public function removeCategorieChaine(\AppBundle\Entity\CategorieChaine $categorieChaine)
    {
        $this->categorieChaines->removeElement($categorieChaine);
    }

    /**
     * Get categorieChaines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorieChaines()
    {
        return $this->categorieChaines;
    }

    /**
     * Set niveauChaine
     *
     * @param \AppBundle\Entity\NiveauChaine $niveauChaine
     *
     * @return Chaine
     */
    public function setNiveauChaine(\AppBundle\Entity\NiveauChaine $niveauChaine = null)
    {
        $this->niveauChaine = $niveauChaine;

        return $this;
    }

    /**
     * Get niveauChaine
     *
     * @return \AppBundle\Entity\NiveauChaine
     */
    public function getNiveauChaine()
    {
        return $this->niveauChaine;
    }
}
