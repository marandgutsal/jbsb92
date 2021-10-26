<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packagemessenger
 *
 * @ORM\Table(name="packageMessenger", indexes={@ORM\Index(name="messenger_id", columns={"messenger_id"}), @ORM\Index(name="package_id", columns={"package_id"})})
 * @ORM\Entity
 */
class Packagemessenger
{
    /**
     * @var integer
     *
     * @ORM\Column(name="packageMessenger_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $packagemessengerId;

    /**
     * @var \Package
     *
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_id", referencedColumnName="package_id")
     * })
     */
    private $package;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="messenger_id", referencedColumnName="branch_id")
     * })
     */
    private $messenger;



    /**
     * Get packagemessengerId
     *
     * @return integer
     */
    public function getPackagemessengerId()
    {
        return $this->packagemessengerId;
    }

    /**
     * Set package
     *
     * @param \HomeBundle\Entity\Package $package
     *
     * @return Packagemessenger
     */
    public function setPackage(\HomeBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \HomeBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set messenger
     *
     * @param \HomeBundle\Entity\Branch $messenger
     *
     * @return Packagemessenger
     */
    public function setMessenger(\HomeBundle\Entity\Branch $messenger = null)
    {
        $this->messenger = $messenger;

        return $this;
    }

    /**
     * Get messenger
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getMessenger()
    {
        return $this->messenger;
    }
}
