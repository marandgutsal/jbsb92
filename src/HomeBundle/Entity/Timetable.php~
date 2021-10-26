<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timetable
 *
 * @ORM\Table(name="timetable", indexes={@ORM\Index(name="weekDay_id", columns={"weekDay_id"}), @ORM\Index(name="availableTime_id", columns={"availableTime_id"})})
 * @ORM\Entity
 */
class Timetable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="timetable_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $timetableId;

    /**
     * @var \Weekday
     *
     * @ORM\ManyToOne(targetEntity="Weekday")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="weekDay_id", referencedColumnName="weekDay_id")
     * })
     */
    private $weekday;

    /**
     * @var \Availabletime
     *
     * @ORM\ManyToOne(targetEntity="Availabletime")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="availableTime_id", referencedColumnName="availableTime_id")
     * })
     */
    private $availabletime;



    /**
     * Get timetableId
     *
     * @return integer
     */
    public function getTimetableId()
    {
        return $this->timetableId;
    }

    /**
     * Set weekday
     *
     * @param \HomeBundle\Entity\Weekday $weekday
     *
     * @return Timetable
     */
    public function setWeekday(\HomeBundle\Entity\Weekday $weekday = null)
    {
        $this->weekday = $weekday;

        return $this;
    }

    /**
     * Get weekday
     *
     * @return \HomeBundle\Entity\Weekday
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Set availabletime
     *
     * @param \HomeBundle\Entity\Availabletime $availabletime
     *
     * @return Timetable
     */
    public function setAvailabletime(\HomeBundle\Entity\Availabletime $availabletime = null)
    {
        $this->availabletime = $availabletime;

        return $this;
    }

    /**
     * Get availabletime
     *
     * @return \HomeBundle\Entity\Availabletime
     */
    public function getAvailabletime()
    {
        return $this->availabletime;
    }
}
