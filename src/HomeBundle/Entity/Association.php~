<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Association
 *
 * @ORM\Table(name="association", indexes={@ORM\Index(name="user_id", columns={"topicMember_id"}), @ORM\Index(name="video_id", columns={"video_id"}), @ORM\Index(name="location_id", columns={"location_id"}), @ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class Association
{
    /**
     * @var integer
     *
     * @ORM\Column(name="association_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $associationId;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;

    /**
     * @var \Video
     *
     * @ORM\ManyToOne(targetEntity="Video")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="video_id", referencedColumnName="video_id")
     * })
     */
    private $video;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $product;

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
     * Get associationId
     *
     * @return integer
     */
    public function getAssociationId()
    {
        return $this->associationId;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Association
     */
    public function setLocation(\HomeBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \HomeBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Association
     */
    public function setVideo(\HomeBundle\Entity\Video $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \HomeBundle\Entity\Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set product
     *
     * @param \HomeBundle\Entity\Product $product
     *
     * @return Association
     */
    public function setProduct(\HomeBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \HomeBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Association
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
