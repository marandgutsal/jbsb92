<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shippingcategory
 *
 * @ORM\Table(name="shippingCategory")
 * @ORM\Entity
 */
class Shippingcategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="shippingCategory_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shippingcategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="shippingCategory_name", type="string", length=255, nullable=false)
     */
    private $shippingcategoryName;

    /**
     * @var string
     *
     * @ORM\Column(name="shippingCategory_description", type="string", length=255, nullable=false)
     */
    private $shippingcategoryDescription;



    /**
     * Get shippingcategoryId
     *
     * @return integer
     */
    public function getShippingcategoryId()
    {
        return $this->shippingcategoryId;
    }

    /**
     * Set shippingcategoryName
     *
     * @param string $shippingcategoryName
     *
     * @return Shippingcategory
     */
    public function setShippingcategoryName($shippingcategoryName)
    {
        $this->shippingcategoryName = $shippingcategoryName;

        return $this;
    }

    /**
     * Get shippingcategoryName
     *
     * @return string
     */
    public function getShippingcategoryName()
    {
        return $this->shippingcategoryName;
    }

    /**
     * Set shippingcategoryDescription
     *
     * @param string $shippingcategoryDescription
     *
     * @return Shippingcategory
     */
    public function setShippingcategoryDescription($shippingcategoryDescription)
    {
        $this->shippingcategoryDescription = $shippingcategoryDescription;

        return $this;
    }

    /**
     * Get shippingcategoryDescription
     *
     * @return string
     */
    public function getShippingcategoryDescription()
    {
        return $this->shippingcategoryDescription;
    }
}
