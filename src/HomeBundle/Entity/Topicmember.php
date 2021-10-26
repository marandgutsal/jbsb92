<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicmember
 *
 * @ORM\Table(name="topicMember", indexes={@ORM\Index(name="object_id", columns={"object_id"}), @ORM\Index(name="topicMember_position", columns={"topicMember_next"})})
 * @ORM\Entity
 */
class Topicmember
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicMember_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicmemberId;

    /**
     * @var \Object
     *
     * @ORM\ManyToOne(targetEntity="Object")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_id", referencedColumnName="object_id")
     * })
     */
    private $object;

    /**
     * @var \Topicmember
     *
     * @ORM\ManyToOne(targetEntity="Topicmember")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topicMember_next", referencedColumnName="topicMember_id")
     * })
     */
    private $topicmemberNext;



    /**
     * Get topicmemberId
     *
     * @return integer
     */
    public function getTopicmemberId()
    {
        return $this->topicmemberId;
    }

    /**
     * Set object
     *
     * @param \HomeBundle\Entity\Object $object
     *
     * @return Topicmember
     */
    public function setObject(\HomeBundle\Entity\Object $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \HomeBundle\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set topicmemberNext
     *
     * @param \HomeBundle\Entity\Topicmember $topicmemberNext
     *
     * @return Topicmember
     */
    public function setTopicmemberNext(\HomeBundle\Entity\Topicmember $topicmemberNext = null)
    {
        $this->topicmemberNext = $topicmemberNext;

        return $this;
    }

    /**
     * Get topicmemberNext
     *
     * @return \HomeBundle\Entity\Topicmember
     */
    public function getTopicmemberNext()
    {
        return $this->topicmemberNext;
    }
}
