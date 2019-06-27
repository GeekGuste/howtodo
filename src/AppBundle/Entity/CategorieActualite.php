<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CategorieActualite
 *
 * @ORM\Table(name="categorie_actualite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieActualiteRepository")
 */
class CategorieActualite {

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
     * @ORM\Column(name="libelle", type="string", length=255,unique=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_eng", type="string", length=255,unique=true)
     */
    private $libelleEng;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Actualite", mappedBy="categorieActualites")
     */
    private $actualites;
    
    /**
     * @ORM\ManyToOne(targetEntity="CategorieActualite", inversedBy="enfants")
     * @ORM\JoinColumn(name="categorieActualite_id", referencedColumnName="id", nullable = true)
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="CategorieActualite", mappedBy="parent")
     * @ORM\JoinColumn(name="categorieActualite_id", referencedColumnName="id")
     */
    private $enfants;
    
    /**
     * @Gedmo\Slug(fields={"libelle"}, updatable=true)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return CategorieActualite
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CategorieActualite
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actualite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actualite
     *
     * @param \AppBundle\Entity\Actualite $actualite
     *
     * @return CategorieActualite
     */
    public function addActualite(\AppBundle\Entity\Actualite $actualite)
    {
        $this->actualite[] = $actualite;

        return $this;
    }

    /**
     * Remove actualite
     *
     * @param \AppBundle\Entity\Actualite $actualite
     */
    public function removeActualite(\AppBundle\Entity\Actualite $actualite)
    {
        $this->actualite->removeElement($actualite);
    }

    /**
     * Get actualite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualite()
    {
        return $this->actualite;
    }

    /**
     * Set libelleEng
     *
     * @param string $libelleEng
     *
     * @return CategorieActualite
     */
    public function setLibelleEng($libelleEng)
    {
        $this->libelleEng = $libelleEng;

        return $this;
    }

    /**
     * Get libelleEng
     *
     * @return string
     */
    public function getLibelleEng()
    {
        return $this->libelleEng;
    }

    /**
     * Add parent
     *
     * @param \AppBundle\Entity\CategorieActualite $parent
     *
     * @return CategorieActualite
     */
    public function addParent(\AppBundle\Entity\CategorieActualite $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent
     *
     * @param \AppBundle\Entity\CategorieActualite $parent
     */
    public function removeParent(\AppBundle\Entity\CategorieActualite $parent)
    {
        $this->parent->removeElement($parent);
    }

    /**
     * Get parent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get actualites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualites()
    {
        return $this->actualites;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\CategorieActualite $parent
     *
     * @return CategorieActualite
     */
    public function setParent(\AppBundle\Entity\CategorieActualite $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Add enfant
     *
     * @param \AppBundle\Entity\CategorieActualite $enfant
     *
     * @return CategorieActualite
     */
    public function addEnfant(\AppBundle\Entity\CategorieActualite $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \AppBundle\Entity\CategorieActualite $enfant
     */
    public function removeEnfant(\AppBundle\Entity\CategorieActualite $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return CategorieActualite
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return CategorieActualite
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
}
