<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NiveauChaine
 *
 * @ORM\Table(name="niveau_chaine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NiveauChaineRepository")
 */
class NiveauChaine
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleEng", type="string", length=255)
     */
    private $libelleEng;

    /**
     * @ORM\OneToMany(targetEntity="Chaine", mappedBy="niveauChaine")
     * @ORM\JoinColumn(name="chaine_id", referencedColumnName="id")
     */
    private $chaines;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return NiveauChaine
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set libelleEng
     *
     * @param string $libelleEng
     *
     * @return NiveauChaine
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
     * Constructor
     */
    public function __construct()
    {
        $this->chaines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chaine
     *
     * @param \AppBundle\Entity\Chaine $chaine
     *
     * @return NiveauChaine
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
