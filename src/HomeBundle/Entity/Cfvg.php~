<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cfvg
 *
 * @ORM\Table(name="cfvg", indexes={@ORM\Index(name="cdcds", columns={"cdcds"})})
 * @ORM\Entity
 */
class Cfvg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="azxc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $azxc;

    /**
     * @var integer
     *
     * @ORM\Column(name="cdcds", type="integer", nullable=false)
     */
    private $cdcds;



    /**
     * Get azxc
     *
     * @return integer
     */
    public function getAzxc()
    {
        return $this->azxc;
    }

    /**
     * Set cdcds
     *
     * @param integer $cdcds
     *
     * @return Cfvg
     */
    public function setCdcds($cdcds)
    {
        $this->cdcds = $cdcds;

        return $this;
    }

    /**
     * Get cdcds
     *
     * @return integer
     */
    public function getCdcds()
    {
        return $this->cdcds;
    }
}
