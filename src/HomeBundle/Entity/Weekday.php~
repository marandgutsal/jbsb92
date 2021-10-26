<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weekday
 *
 * @ORM\Table(name="weekDay")
 * @ORM\Entity
 */
class Weekday
{
    /**
     * @var integer
     *
     * @ORM\Column(name="weekDay_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $weekdayId;

    /**
     * @var string
     *
     * @ORM\Column(name="weekDay_description", type="string", length=50, nullable=false)
     */
    private $weekdayDescription;



    /**
     * Get weekdayId
     *
     * @return integer
     */
    public function getWeekdayId()
    {
        return $this->weekdayId;
    }

    /**
     * Set weekdayDescription
     *
     * @param string $weekdayDescription
     *
     * @return Weekday
     */
    public function setWeekdayDescription($weekdayDescription)
    {
        $this->weekdayDescription = $weekdayDescription;

        return $this;
    }

    /**
     * Get weekdayDescription
     *
     * @return string
     */
    public function getWeekdayDescription()
    {
        return $this->weekdayDescription;
    }
}
