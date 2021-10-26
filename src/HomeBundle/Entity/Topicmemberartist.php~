<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicmemberartist
 *
 * @ORM\Table(name="topicMemberArtist", indexes={@ORM\Index(name="topic_id", columns={"topicMember_id"}), @ORM\Index(name="artist_id", columns={"artist_id"})})
 * @ORM\Entity
 */
class Topicmemberartist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberArtist_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicmemberartistId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberArtist_sales", type="integer", nullable=false)
     */
    private $topicmemberartistSales;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberArtist_salesDate", type="datetime", nullable=false)
     */
    private $topicmemberartistSalesdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberArtist_products", type="integer", nullable=false)
     */
    private $topicmemberartistProducts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberArtist_productsDate", type="datetime", nullable=false)
     */
    private $topicmemberartistProductsdate;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artist_id", referencedColumnName="user_id")
     * })
     */
    private $artist;

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
     * Get topicmemberartistId
     *
     * @return integer
     */
    public function getTopicmemberartistId()
    {
        return $this->topicmemberartistId;
    }

    /**
     * Set topicmemberartistSales
     *
     * @param integer $topicmemberartistSales
     *
     * @return Topicmemberartist
     */
    public function setTopicmemberartistSales($topicmemberartistSales)
    {
        $this->topicmemberartistSales = $topicmemberartistSales;

        return $this;
    }

    /**
     * Get topicmemberartistSales
     *
     * @return integer
     */
    public function getTopicmemberartistSales()
    {
        return $this->topicmemberartistSales;
    }

    /**
     * Set topicmemberartistSalesdate
     *
     * @param \DateTime $topicmemberartistSalesdate
     *
     * @return Topicmemberartist
     */
    public function setTopicmemberartistSalesdate($topicmemberartistSalesdate)
    {
        $this->topicmemberartistSalesdate = $topicmemberartistSalesdate;

        return $this;
    }

    /**
     * Get topicmemberartistSalesdate
     *
     * @return \DateTime
     */
    public function getTopicmemberartistSalesdate()
    {
        return $this->topicmemberartistSalesdate;
    }

    /**
     * Set topicmemberartistProducts
     *
     * @param integer $topicmemberartistProducts
     *
     * @return Topicmemberartist
     */
    public function setTopicmemberartistProducts($topicmemberartistProducts)
    {
        $this->topicmemberartistProducts = $topicmemberartistProducts;

        return $this;
    }

    /**
     * Get topicmemberartistProducts
     *
     * @return integer
     */
    public function getTopicmemberartistProducts()
    {
        return $this->topicmemberartistProducts;
    }

    /**
     * Set topicmemberartistProductsdate
     *
     * @param \DateTime $topicmemberartistProductsdate
     *
     * @return Topicmemberartist
     */
    public function setTopicmemberartistProductsdate($topicmemberartistProductsdate)
    {
        $this->topicmemberartistProductsdate = $topicmemberartistProductsdate;

        return $this;
    }

    /**
     * Get topicmemberartistProductsdate
     *
     * @return \DateTime
     */
    public function getTopicmemberartistProductsdate()
    {
        return $this->topicmemberartistProductsdate;
    }

    /**
     * Set artist
     *
     * @param \HomeBundle\Entity\User $artist
     *
     * @return Topicmemberartist
     */
    public function setArtist(\HomeBundle\Entity\User $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \HomeBundle\Entity\User
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Topicmemberartist
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
