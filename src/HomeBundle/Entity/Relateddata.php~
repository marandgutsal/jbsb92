<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relateddata
 *
 * @ORM\Table(name="relatedData", indexes={@ORM\Index(name="keywordSet_id", columns={"keywordSet_id"}), @ORM\Index(name="songSet_id", columns={"songSet_id"}), @ORM\Index(name="productTypeSet_id", columns={"productTypeSet_id"}), @ORM\Index(name="artistSet_id", columns={"artistSet_id"}), @ORM\Index(name="productSet_id", columns={"productSet_id"})})
 * @ORM\Entity
 */
class Relateddata
{
    /**
     * @var integer
     *
     * @ORM\Column(name="relatedData_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $relateddataId;

    /**
     * @var integer
     *
     * @ORM\Column(name="keywordSet_id", type="integer", nullable=false)
     */
    private $keywordsetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="songSet_id", type="integer", nullable=false)
     */
    private $songsetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="productTypeSet_id", type="integer", nullable=false)
     */
    private $producttypesetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="artistSet_id", type="integer", nullable=false)
     */
    private $artistsetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="productSet_id", type="integer", nullable=false)
     */
    private $productsetId;



    /**
     * Get relateddataId
     *
     * @return integer
     */
    public function getRelateddataId()
    {
        return $this->relateddataId;
    }

    /**
     * Set keywordsetId
     *
     * @param integer $keywordsetId
     *
     * @return Relateddata
     */
    public function setKeywordsetId($keywordsetId)
    {
        $this->keywordsetId = $keywordsetId;

        return $this;
    }

    /**
     * Get keywordsetId
     *
     * @return integer
     */
    public function getKeywordsetId()
    {
        return $this->keywordsetId;
    }

    /**
     * Set songsetId
     *
     * @param integer $songsetId
     *
     * @return Relateddata
     */
    public function setSongsetId($songsetId)
    {
        $this->songsetId = $songsetId;

        return $this;
    }

    /**
     * Get songsetId
     *
     * @return integer
     */
    public function getSongsetId()
    {
        return $this->songsetId;
    }

    /**
     * Set producttypesetId
     *
     * @param integer $producttypesetId
     *
     * @return Relateddata
     */
    public function setProducttypesetId($producttypesetId)
    {
        $this->producttypesetId = $producttypesetId;

        return $this;
    }

    /**
     * Get producttypesetId
     *
     * @return integer
     */
    public function getProducttypesetId()
    {
        return $this->producttypesetId;
    }

    /**
     * Set artistsetId
     *
     * @param integer $artistsetId
     *
     * @return Relateddata
     */
    public function setArtistsetId($artistsetId)
    {
        $this->artistsetId = $artistsetId;

        return $this;
    }

    /**
     * Get artistsetId
     *
     * @return integer
     */
    public function getArtistsetId()
    {
        return $this->artistsetId;
    }

    /**
     * Set productsetId
     *
     * @param integer $productsetId
     *
     * @return Relateddata
     */
    public function setProductsetId($productsetId)
    {
        $this->productsetId = $productsetId;

        return $this;
    }

    /**
     * Get productsetId
     *
     * @return integer
     */
    public function getProductsetId()
    {
        return $this->productsetId;
    }
}
