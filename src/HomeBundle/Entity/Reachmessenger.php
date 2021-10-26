<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reachmessenger
 *
 * @ORM\Table(name="reachMessenger", indexes={@ORM\Index(name="location_id", columns={"messenger_id"}), @ORM\Index(name="reach_id", columns={"reach_id"})})
 * @ORM\Entity
 */
class Reachmessenger
{
    /**
     * @var integer
     *
     * @ORM\Column(name="reachMessenger_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reachmessengerId;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="messenger_id", referencedColumnName="branch_id")
     * })
     */
    private $messenger;

    /**
     * @var \Reach
     *
     * @ORM\ManyToOne(targetEntity="Reach")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reach_id", referencedColumnName="reach_id")
     * })
     */
    private $reach;



    /**
     * Get reachmessengerId
     *
     * @return integer
     */
    public function getReachmessengerId()
    {
        return $this->reachmessengerId;
    }

    /**
     * Set messenger
     *
     * @param \HomeBundle\Entity\Branch $messenger
     *
     * @return Reachmessenger
     */
    public function setMessenger(\HomeBundle\Entity\Branch $messenger = null)
    {
        $this->messenger = $messenger;

        return $this;
    }

    /**
     * Get messenger
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getMessenger()
    {
        return $this->messenger;
    }

    /**
     * Set reach
     *
     * @param \HomeBundle\Entity\Reach $reach
     *
     * @return Reachmessenger
     */
    public function setReach(\HomeBundle\Entity\Reach $reach = null)
    {
        $this->reach = $reach;

        return $this;
    }

    /**
     * Get reach
     *
     * @return \HomeBundle\Entity\Reach
     */
    public function getReach()
    {
        return $this->reach;
    }
}
