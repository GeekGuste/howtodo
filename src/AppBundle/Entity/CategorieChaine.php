<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieChaine
 *
 * @ORM\Table(name="categorie_chaine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieChaineRepository")
 */
class CategorieChaine
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
     * @ORM\Column(name="nomEng", type="string", length=255)
     */
    private $nomEng;

    /**
     * @ORM\OneToMany(targetEntity="Chaine", mappedBy="categorieChaines")
     */
    private $chaines;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chaines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return CategorieChaine
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
     * Set nomEng
     *
     * @param string $nomEng
     *
     * @return CategorieChaine
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
     * Add chaine
     *
     * @param \AppBundle\Entity\Chaine $chaine
     *
     * @return CategorieChaine
     */
    public function addChaine(\AppBundle\Entity\Chaine $chaine)
    {
        $this->chaines[] = $chaine;

        return $this;
    }

    /**
     * Remove chaine
     *
     * @param \AppBundle\Entity\Chaine $chaine
     */
    public function removeChaine(\AppBundle\Entity\Chaine $chaine)
    {
        $this->chaines->removeElement($chaine);
    }

    /**
     * Get chaines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChaines()
    {
        return $this->chaines;
    }
}
