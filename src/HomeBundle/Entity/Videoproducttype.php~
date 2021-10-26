<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videoproducttype
 *
 * @ORM\Table(name="videoProductType", indexes={@ORM\Index(name="video_id", columns={"video_id"}), @ORM\Index(name="productType_id", columns={"productType_id"})})
 * @ORM\Entity
 */
class Videoproducttype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="videoProductType_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $videoproducttypeId;

    /**
     * @var \Producttype
     *
     * @ORM\ManyToOne(targetEntity="Producttype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productType_id", referencedColumnName="productType_id")
     * })
     */
    private $producttype;

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
     * Get videoproducttypeId
     *
     * @return integer
     */
    public function getVideoproducttypeId()
    {
        return $this->videoproducttypeId;
    }

    /**
     * Set producttype
     *
     * @param \HomeBundle\Entity\Producttype $producttype
     *
     * @return Videoproducttype
     */
    public function setProducttype(\HomeBundle\Entity\Producttype $producttype = null)
    {
        $this->producttype = $producttype;

        return $this;
    }

    /**
     * Get producttype
     *
     * @return \HomeBundle\Entity\Producttype
     */
    public function getProducttype()
    {
        return $this->producttype;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Videoproducttype
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
