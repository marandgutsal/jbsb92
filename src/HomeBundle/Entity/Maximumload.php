<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maximumload
 *
 * @ORM\Table(name="maximumLoad", indexes={@ORM\Index(name="maximumLoad_price", columns={"maximumLoad_rate"})})
 * @ORM\Entity
 */
class Maximumload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="maximumLoad_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $maximumloadId;

    /**
     * @var \Price
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="maximumLoad_rate", referencedColumnName="price_id")
     * })
     */
    private $maximumloadRate;



    /**
     * Get maximumloadId
     *
     * @return integer
     */
    public function getMaximumloadId()
    {
        return $this->maximumloadId;
    }

    /**
     * Set maximumloadRate
     *
     * @param \HomeBundle\Entity\Price $maximumloadRate
     *
     * @return Maximumload
     */
    public function setMaximumloadRate(\HomeBundle\Entity\Price $maximumloadRate = null)
    {
        $this->maximumloadRate = $maximumloadRate;

        return $this;
    }

    /**
     * Get maximumloadRate
     *
     * @return \HomeBundle\Entity\Price
     */
    public function getMaximumloadRate()
    {
        return $this->maximumloadRate;
    }
}
