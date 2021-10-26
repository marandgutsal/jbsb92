<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicproduct
 *
 * @ORM\Table(name="topicProduct", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class Topicproduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicProduct_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicproductId;

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
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topic_id", referencedColumnName="topic_id")
     * })
     */
    private $topic;



    /**
     * Get topicproductId
     *
     * @return integer
     */
    public function getTopicproductId()
    {
        return $this->topicproductId;
    }

    /**
     * Set product
     *
     * @param \HomeBundle\Entity\Product $product
     *
     * @return Topicproduct
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
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topicproduct
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
}
