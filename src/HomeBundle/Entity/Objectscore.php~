<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectscore
 *
 * @ORM\Table(name="objectScore", indexes={@ORM\Index(name="object_id", columns={"object_id"})})
 * @ORM\Entity
 */
class Objectscore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="objectScore_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectscoreId;

    /**
     * @var \Object
     *
     * @ORM\ManyToOne(targetEntity="Object")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_id", referencedColumnName="object_id")
     * })
     */
    private $object;



    /**
     * Get objectscoreId
     *
     * @return integer
     */
    public function getObjectscoreId()
    {
        return $this->objectscoreId;
    }

    /**
     * Set object
     *
     * @param \HomeBundle\Entity\Object $object
     *
     * @return Objectscore
     */
    public function setObject(\HomeBundle\Entity\Object $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \HomeBundle\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }
}
