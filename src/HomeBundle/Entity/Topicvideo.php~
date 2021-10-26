<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicvideo
 *
 * @ORM\Table(name="topicVideo", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="video_id", columns={"video_id"})})
 * @ORM\Entity
 */
class Topicvideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicVideo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicvideoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicVideo_sales", type="integer", nullable=false)
     */
    private $topicvideoSales;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicVideo_salesDate", type="datetime", nullable=false)
     */
    private $topicvideoSalesdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicVideo_products", type="integer", nullable=false)
     */
    private $topicvideoProducts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicVideo_productsDate", type="datetime", nullable=false)
     */
    private $topicvideoProductsdate;

    /**
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topic_id", referencedColumnName="topic_id")
     * })
     */
    private $topic;

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
     * Get topicvideoId
     *
     * @return integer
     */
    public function getTopicvideoId()
    {
        return $this->topicvideoId;
    }

    /**
     * Set topicvideoSales
     *
     * @param integer $topicvideoSales
     *
     * @return Topicvideo
     */
    public function setTopicvideoSales($topicvideoSales)
    {
        $this->topicvideoSales = $topicvideoSales;

        return $this;
    }

    /**
     * Get topicvideoSales
     *
     * @return integer
     */
    public function getTopicvideoSales()
    {
        return $this->topicvideoSales;
    }

    /**
     * Set topicvideoSalesdate
     *
     * @param \DateTime $topicvideoSalesdate
     *
     * @return Topicvideo
     */
    public function setTopicvideoSalesdate($topicvideoSalesdate)
    {
        $this->topicvideoSalesdate = $topicvideoSalesdate;

        return $this;
    }

    /**
     * Get topicvideoSalesdate
     *
     * @return \DateTime
     */
    public function getTopicvideoSalesdate()
    {
        return $this->topicvideoSalesdate;
    }

    /**
     * Set topicvideoProducts
     *
     * @param integer $topicvideoProducts
     *
     * @return Topicvideo
     */
    public function setTopicvideoProducts($topicvideoProducts)
    {
        $this->topicvideoProducts = $topicvideoProducts;

        return $this;
    }

    /**
     * Get topicvideoProducts
     *
     * @return integer
     */
    public function getTopicvideoProducts()
    {
        return $this->topicvideoProducts;
    }

    /**
     * Set topicvideoProductsdate
     *
     * @param \DateTime $topicvideoProductsdate
     *
     * @return Topicvideo
     */
    public function setTopicvideoProductsdate($topicvideoProductsdate)
    {
        $this->topicvideoProductsdate = $topicvideoProductsdate;

        return $this;
    }

    /**
     * Get topicvideoProductsdate
     *
     * @return \DateTime
     */
    public function getTopicvideoProductsdate()
    {
        return $this->topicvideoProductsdate;
    }

    /**
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topicvideo
     */
    public function setTopic(\HomeBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \HomeBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Topicvideo
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
