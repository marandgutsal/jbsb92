<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cfvg2
 *
 * @ORM\Table(name="cfvg_2")
 * @ORM\Entity
 */
class Cfvg2
{
    /**
     * @var integer
     *
     * @ORM\Column(name="azxc_2", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $azxc2;

    /**
     * @var integer
     *
     * @ORM\Column(name="cdcds_2", type="integer", nullable=false)
     */
    private $cdcds2;



    /**
     * Get azxc2
     *
     * @return integer
     */
    public function getAzxc2()
    {
        return $this->azxc2;
    }

    /**
     * Set cdcds2
     *
     * @param integer $cdcds2
     *
     * @return Cfvg2
     */
    public function setCdcds2($cdcds2)
    {
        $this->cdcds2 = $cdcds2;

        return $this;
    }

    /**
     * Get cdcds2
     *
     * @return integer
     */
    public function getCdcds2()
    {
        return $this->cdcds2;
    }
}
