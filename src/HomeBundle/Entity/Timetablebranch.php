<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timetablebranch
 *
 * @ORM\Table(name="timetableBranch", uniqueConstraints={@ORM\UniqueConstraint(name="timetable_id", columns={"timetable_id", "branch_id"})}, indexes={@ORM\Index(name="branch_id", columns={"branch_id"}), @ORM\Index(name="IDX_D13FE358CC306847", columns={"timetable_id"})})
 * @ORM\Entity
 */
class Timetablebranch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="timetableBranch_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $timetablebranchId;

    /**
     * @var \Timetable
     *
     * @ORM\ManyToOne(targetEntity="Timetable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="timetable_id", referencedColumnName="timetable_id")
     * })
     */
    private $timetable;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch_id", referencedColumnName="branch_id")
     * })
     */
    private $branch;



    /**
     * Get timetablebranchId
     *
     * @return integer
     */
    public function getTimetablebranchId()
    {
        return $this->timetablebranchId;
    }

    /**
     * Set timetable
     *
     * @param \HomeBundle\Entity\Timetable $timetable
     *
     * @return Timetablebranch
     */
    public function setTimetable(\HomeBundle\Entity\Timetable $timetable = null)
    {
        $this->timetable = $timetable;

        return $this;
    }

    /**
     * Get timetable
     *
     * @return \HomeBundle\Entity\Timetable
     */
    public function getTimetable()
    {
        return $this->timetable;
    }

    /**
     * Set branch
     *
     * @param \HomeBundle\Entity\Branch $branch
     *
     * @return Timetablebranch
     */
    public function setBranch(\HomeBundle\Entity\Branch $branch = null)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getBranch()
    {
        return $this->branch;
    }
}
