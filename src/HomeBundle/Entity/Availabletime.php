<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Availabletime
 *
 * @ORM\Table(name="availableTime")
 * @ORM\Entity
 */
class Availabletime
{
    /**
     * @var integer
     *
     * @ORM\Column(name="availableTime_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $availabletimeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availableTime_opening", type="time", nullable=false)
     */
    private $availabletimeOpening;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availableTime_duration", type="time", nullable=false)
     */
    private $availabletimeDuration;



    /**
     * Get availabletimeId
     *
     * @return integer
     */
    public function getAvailabletimeId()
    {
        return $this->availabletimeId;
    }

    /**
     * Set availabletimeOpening
     *
     * @param \DateTime $availabletimeOpening
     *
     * @return Availabletime
     */
    public function setAvailabletimeOpening($availabletimeOpening)
    {
        $this->availabletimeOpening = $availabletimeOpening;

        return $this;
    }

    /**
     * Get availabletimeOpening
     *
     * @return \DateTime
     */
    public function getAvailabletimeOpening()
    {
        return $this->availabletimeOpening;
    }

    /**
     * Set availabletimeDuration
     *
     * @param \DateTime $availabletimeDuration
     *
     * @return Availabletime
     */
    public function setAvailabletimeDuration($availabletimeDuration)
    {
        $this->availabletimeDuration = $availabletimeDuration;

        return $this;
    }

    /**
     * Get availabletimeDuration
     *
     * @return \DateTime
     */
    public function getAvailabletimeDuration()
    {
        return $this->availabletimeDuration;
    }
}
