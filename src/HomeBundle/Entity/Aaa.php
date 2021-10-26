<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aaa
 *
 * @ORM\Table(name="aaa", indexes={@ORM\Index(name="object_score_id", columns={"object_score_id"})})
 * @ORM\Entity
 */
class Aaa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aaa_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aaaId;

    /**
     * @var \Objectscore
     *
     * @ORM\ManyToOne(targetEntity="Objectscore")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_score_id", referencedColumnName="objectScore_id")
     * })
     */
    private $objectScore;



    /**
     * Get aaaId
     *
     * @return integer
     */
    public function getAaaId()
    {
        return $this->aaaId;
    }

    /**
     * Set objectScore
     *
     * @param \HomeBundle\Entity\Objectscore $objectScore
     *
     * @return Aaa
     */
    public function setObjectScore(\HomeBundle\Entity\Objectscore $objectScore = null)
    {
        $this->objectScore = $objectScore;

        return $this;
    }

    /**
     * Get objectScore
     *
     * @return \HomeBundle\Entity\Objectscore
     */
    public function getObjectScore()
    {
        return $this->objectScore;
    }
}
