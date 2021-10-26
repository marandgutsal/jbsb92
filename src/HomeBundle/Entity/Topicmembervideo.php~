<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicmembervideo
 *
 * @ORM\Table(name="topicMemberVideo", indexes={@ORM\Index(name="topic_id", columns={"topicMember_id"}), @ORM\Index(name="video_id", columns={"video_id"})})
 * @ORM\Entity
 */
class Topicmembervideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberVideo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicmembervideoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberVideo_sales", type="integer", nullable=false)
     */
    private $topicmembervideoSales;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberVideo_salesDate", type="datetime", nullable=false)
     */
    private $topicmembervideoSalesdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberVideo_products", type="integer", nullable=false)
     */
    private $topicmembervideoProducts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberVideo_productsDate", type="datetime", nullable=false)
     */
    private $topicmembervideoProductsdate;

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
     * @var \Video
     *
     * @ORM\ManyToOne(targetEntity="Video")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="video_id", referencedColumnName="video_id")
     * })
     */
    private $video;



    /**
     * Get topicmembervideoId
     *
     * @return integer
     */
    public function getTopicmembervideoId()
    {
        return $this->topicmembervideoId;
    }

    /**
     * Set topicmembervideoSales
     *
     * @param integer $topicmembervideoSales
     *
     * @return Topicmembervideo
     */
    public function setTopicmembervideoSales($topicmembervideoSales)
    {
        $this->topicmembervideoSales = $topicmembervideoSales;

        return $this;
    }

    /**
     * Get topicmembervideoSales
     *
     * @return integer
     */
    public function getTopicmembervideoSales()
    {
        return $this->topicmembervideoSales;
    }

    /**
     * Set topicmembervideoSalesdate
     *
     * @param \DateTime $topicmembervideoSalesdate
     *
     * @return Topicmembervideo
     */
    public function setTopicmembervideoSalesdate($topicmembervideoSalesdate)
    {
        $this->topicmembervideoSalesdate = $topicmembervideoSalesdate;

        return $this;
    }

    /**
     * Get topicmembervideoSalesdate
     *
     * @return \DateTime
     */
    public function getTopicmembervideoSalesdate()
    {
        return $this->topicmembervideoSalesdate;
    }

    /**
     * Set topicmembervideoProducts
     *
     * @param integer $topicmembervideoProducts
     *
     * @return Topicmembervideo
     */
    public function setTopicmembervideoProducts($topicmembervideoProducts)
    {
        $this->topicmembervideoProducts = $topicmembervideoProducts;

        return $this;
    }

    /**
     * Get topicmembervideoProducts
     *
     * @return integer
     */
    public function getTopicmembervideoProducts()
    {
        return $this->topicmembervideoProducts;
    }

    /**
     * Set topicmembervideoProductsdate
     *
     * @param \DateTime $topicmembervideoProductsdate
     *
     * @return Topicmembervideo
     */
    public function setTopicmembervideoProductsdate($topicmembervideoProductsdate)
    {
        $this->topicmembervideoProductsdate = $topicmembervideoProductsdate;

        return $this;
    }

    /**
     * Get topicmembervideoProductsdate
     *
     * @return \DateTime
     */
    public function getTopicmembervideoProductsdate()
    {
        return $this->topicmembervideoProductsdate;
    }

    /**
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Topicmembervideo
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

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Topicmembervideo
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
}
