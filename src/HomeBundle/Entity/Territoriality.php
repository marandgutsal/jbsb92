<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Territoriality
 *
 * @ORM\Table(name="territoriality", indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class Territoriality
{
    /**
     * @var integer
     *
     * @ORM\Column(name="territoriality_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $territorialityId;

    /**
     * @var \Territoriality
     *
     * @ORM\ManyToOne(targetEntity="Territoriality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="territoriality_id")
     * })
     */
    private $parent;



    /**
     * Get territorialityId
     *
     * @return integer
     */
    public function getTerritorialityId()
    {
        return $this->territorialityId;
    }

    /**
     * Set parent
     *
     * @param \HomeBundle\Entity\Territoriality $parent
     *
     * @return Territoriality
     */
    public function setParent(\HomeBundle\Entity\Territoriality $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \HomeBundle\Entity\Territoriality
     */
    public function getParent()
    {
        return $this->parent;
    }
}
