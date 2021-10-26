<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sendingstatus
 *
 * @ORM\Table(name="sendingStatus", indexes={@ORM\Index(name="user_id", columns={"sendingStatus_user_id"})})
 * @ORM\Entity
 */
class Sendingstatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sendingStatus_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sendingstatusId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sendingStatus_available", type="datetime", nullable=false)
     */
    private $sendingstatusAvailable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sendingStatus_unavailable", type="datetime", nullable=true)
     */
    private $sendingstatusUnavailable;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sendingStatus_user_id", referencedColumnName="user_id")
     * })
     */
    private $sendingstatusUser;



    /**
     * Get sendingstatusId
     *
     * @return integer
     */
    public function getSendingstatusId()
    {
        return $this->sendingstatusId;
    }

    /**
     * Set sendingstatusAvailable
     *
     * @param \DateTime $sendingstatusAvailable
     *
     * @return Sendingstatus
     */
    public function setSendingstatusAvailable($sendingstatusAvailable)
    {
        $this->sendingstatusAvailable = $sendingstatusAvailable;

        return $this;
    }

    /**
     * Get sendingstatusAvailable
     *
     * @return \DateTime
     */
    public function getSendingstatusAvailable()
    {
        return $this->sendingstatusAvailable;
    }

    /**
     * Set sendingstatusUnavailable
     *
     * @param \DateTime $sendingstatusUnavailable
     *
     * @return Sendingstatus
     */
    public function setSendingstatusUnavailable($sendingstatusUnavailable)
    {
        $this->sendingstatusUnavailable = $sendingstatusUnavailable;

        return $this;
    }

    /**
     * Get sendingstatusUnavailable
     *
     * @return \DateTime
     */
    public function getSendingstatusUnavailable()
    {
        return $this->sendingstatusUnavailable;
    }

    /**
     * Set sendingstatusUser
     *
     * @param \HomeBundle\Entity\User $sendingstatusUser
     *
     * @return Sendingstatus
     */
    public function setSendingstatusUser(\HomeBundle\Entity\User $sendingstatusUser = null)
    {
        $this->sendingstatusUser = $sendingstatusUser;

        return $this;
    }

    /**
     * Get sendingstatusUser
     *
     * @return \HomeBundle\Entity\User
     */
    public function getSendingstatusUser()
    {
        return $this->sendingstatusUser;
    }
}
