<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Associationtopicmember
 *
 * @ORM\Table(name="associationTopicMember", indexes={@ORM\Index(name="association_id", columns={"association_id"}), @ORM\Index(name="topicMember_id", columns={"topicMember_id"})})
 * @ORM\Entity
 */
class Associationtopicmember
{
    /**
     * @var integer
     *
     * @ORM\Column(name="associationTopicMember_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $associationtopicmemberId;

    /**
     * @var \Association
     *
     * @ORM\ManyToOne(targetEntity="Association")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="association_id", referencedColumnName="association_id")
     * })
     */
    private $association;

    /**
     * @var \Topicmember
     *
     * @ORM\ManyToOne(targetEntity="Topicmember")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topicMember_id", referencedColumnName="topicMember_id")
     * })
     */
    private $topicmember;



    /**
     * Get associationtopicmemberId
     *
     * @return integer
     */
    public function getAssociationtopicmemberId()
    {
        return $this->associationtopicmemberId;
    }

    /**
     * Set association
     *
     * @param \HomeBundle\Entity\Association $association
     *
     * @return Associationtopicmember
     */
    public function setAssociation(\HomeBundle\Entity\Association $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \HomeBundle\Entity\Association
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Associationtopicmember
     */
    public function setTopicmember(\HomeBundle\Entity\Topicmember $topicmember = null)
    {
        $this->topicmember = $topicmember;

        return $this;
    }

    /**
     * Get topicmember
     *
     * @return \HomeBundle\Entity\Topicmember
     */
    public function getTopicmember()
    {
        return $this->topicmember;
    }
}
