<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modestore
 *
 * @ORM\Table(name="modeStore")
 * @ORM\Entity
 */
class Modestore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="modeStore_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $modestoreId;

    /**
     * @var string
     *
     * @ORM\Column(name="modeStore_description", type="string", length=255, nullable=false)
     */
    private $modestoreDescription;



    /**
     * Get modestoreId
     *
     * @return integer
     */
    public function getModestoreId()
    {
        return $this->modestoreId;
    }

    /**
     * Set modestoreDescription
     *
     * @param string $modestoreDescription
     *
     * @return Modestore
     */
    public function setModestoreDescription($modestoreDescription)
    {
        $this->modestoreDescription = $modestoreDescription;

        return $this;
    }

    /**
     * Get modestoreDescription
     *
     * @return string
     */
    public function getModestoreDescription()
    {
        return $this->modestoreDescription;
    }
}
