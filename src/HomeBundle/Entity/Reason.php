<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reason
 *
 * @ORM\Table(name="reason")
 * @ORM\Entity
 */
class Reason
{
    /**
     * @var integer
     *
     * @ORM\Column(name="reason_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reasonId;

    /**
     * @var string
     *
     * @ORM\Column(name="reason_description", type="string", length=255, nullable=false)
     */
    private $reasonDescription;



    /**
     * Get reasonId
     *
     * @return integer
     */
    public function getReasonId()
    {
        return $this->reasonId;
    }

    /**
     * Set reasonDescription
     *
     * @param string $reasonDescription
     *
     * @return Reason
     */
    public function setReasonDescription($reasonDescription)
    {
        $this->reasonDescription = $reasonDescription;

        return $this;
    }

    /**
     * Get reasonDescription
     *
     * @return string
     */
    public function getReasonDescription()
    {
        return $this->reasonDescription;
    }
}
