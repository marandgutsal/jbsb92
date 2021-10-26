<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aaaa
 *
 * @ORM\Table(name="aaaa")
 * @ORM\Entity
 */
class Aaaa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aaaaa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aaaaa;

    /**
     * @var string
     *
     * @ORM\Column(name="aaaa_name", type="string", length=255, nullable=false)
     */
    private $aaaaName;



    /**
     * Get aaaaa
     *
     * @return integer
     */
    public function getAaaaa()
    {
        return $this->aaaaa;
    }

    /**
     * Set aaaaName
     *
     * @param string $aaaaName
     *
     * @return Aaaa
     */
    public function setAaaaName($aaaaName)
    {
        $this->aaaaName = $aaaaName;

        return $this;
    }

    /**
     * Get aaaaName
     *
     * @return string
     */
    public function getAaaaName()
    {
        return $this->aaaaName;
    }
}
