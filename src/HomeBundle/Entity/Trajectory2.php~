<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trajectory2
 *
 * @ORM\Table(name="trajectory2", indexes={@ORM\Index(name="trajectory2_ibfk_1", columns={"node_initial"}), @ORM\Index(name="trajectory2_ibfk_2", columns={"node_2"}), @ORM\Index(name="node_3", columns={"node_3"}), @ORM\Index(name="node_4", columns={"node_4"}), @ORM\Index(name="node_5", columns={"node_5"}), @ORM\Index(name="node_6", columns={"node_6"}), @ORM\Index(name="node_7", columns={"node_7"}), @ORM\Index(name="node_8", columns={"node_8"}), @ORM\Index(name="node_9", columns={"node_9"}), @ORM\Index(name="node_10", columns={"node_final"}), @ORM\Index(name="node_1", columns={"node_1"}), @ORM\Index(name="node_10_2", columns={"node_10"})})
 * @ORM\Entity
 */
class Trajectory2
{
    /**
     * @var integer
     *
     * @ORM\Column(name="trajectory2_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $trajectory2Id;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_initial", referencedColumnName="shipping_id")
     * })
     */
    private $nodeInitial;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_final", referencedColumnName="shipping_id")
     * })
     */
    private $nodeFinal;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_1", referencedColumnName="shipping_id")
     * })
     */
    private $node1;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_10", referencedColumnName="shipping_id")
     * })
     */
    private $node10;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_2", referencedColumnName="shipping_id")
     * })
     */
    private $node2;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_3", referencedColumnName="shipping_id")
     * })
     */
    private $node3;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_4", referencedColumnName="shipping_id")
     * })
     */
    private $node4;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_5", referencedColumnName="shipping_id")
     * })
     */
    private $node5;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_6", referencedColumnName="shipping_id")
     * })
     */
    private $node6;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_7", referencedColumnName="shipping_id")
     * })
     */
    private $node7;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_8", referencedColumnName="shipping_id")
     * })
     */
    private $node8;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_9", referencedColumnName="shipping_id")
     * })
     */
    private $node9;



    /**
     * Get trajectory2Id
     *
     * @return integer
     */
    public function getTrajectory2Id()
    {
        return $this->trajectory2Id;
    }

    /**
     * Set nodeInitial
     *
     * @param \HomeBundle\Entity\Shipping $nodeInitial
     *
     * @return Trajectory2
     */
    public function setNodeInitial(\HomeBundle\Entity\Shipping $nodeInitial = null)
    {
        $this->nodeInitial = $nodeInitial;

        return $this;
    }

    /**
     * Get nodeInitial
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNodeInitial()
    {
        return $this->nodeInitial;
    }

    /**
     * Set nodeFinal
     *
     * @param \HomeBundle\Entity\Shipping $nodeFinal
     *
     * @return Trajectory2
     */
    public function setNodeFinal(\HomeBundle\Entity\Shipping $nodeFinal = null)
    {
        $this->nodeFinal = $nodeFinal;

        return $this;
    }

    /**
     * Get nodeFinal
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNodeFinal()
    {
        return $this->nodeFinal;
    }

    /**
     * Set node1
     *
     * @param \HomeBundle\Entity\Shipping $node1
     *
     * @return Trajectory2
     */
    public function setNode1(\HomeBundle\Entity\Shipping $node1 = null)
    {
        $this->node1 = $node1;

        return $this;
    }

    /**
     * Get node1
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode1()
    {
        return $this->node1;
    }

    /**
     * Set node10
     *
     * @param \HomeBundle\Entity\Shipping $node10
     *
     * @return Trajectory2
     */
    public function setNode10(\HomeBundle\Entity\Shipping $node10 = null)
    {
        $this->node10 = $node10;

        return $this;
    }

    /**
     * Get node10
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode10()
    {
        return $this->node10;
    }

    /**
     * Set node2
     *
     * @param \HomeBundle\Entity\Shipping $node2
     *
     * @return Trajectory2
     */
    public function setNode2(\HomeBundle\Entity\Shipping $node2 = null)
    {
        $this->node2 = $node2;

        return $this;
    }

    /**
     * Get node2
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode2()
    {
        return $this->node2;
    }

    /**
     * Set node3
     *
     * @param \HomeBundle\Entity\Shipping $node3
     *
     * @return Trajectory2
     */
    public function setNode3(\HomeBundle\Entity\Shipping $node3 = null)
    {
        $this->node3 = $node3;

        return $this;
    }

    /**
     * Get node3
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode3()
    {
        return $this->node3;
    }

    /**
     * Set node4
     *
     * @param \HomeBundle\Entity\Shipping $node4
     *
     * @return Trajectory2
     */
    public function setNode4(\HomeBundle\Entity\Shipping $node4 = null)
    {
        $this->node4 = $node4;

        return $this;
    }

    /**
     * Get node4
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode4()
    {
        return $this->node4;
    }

    /**
     * Set node5
     *
     * @param \HomeBundle\Entity\Shipping $node5
     *
     * @return Trajectory2
     */
    public function setNode5(\HomeBundle\Entity\Shipping $node5 = null)
    {
        $this->node5 = $node5;

        return $this;
    }

    /**
     * Get node5
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode5()
    {
        return $this->node5;
    }

    /**
     * Set node6
     *
     * @param \HomeBundle\Entity\Shipping $node6
     *
     * @return Trajectory2
     */
    public function setNode6(\HomeBundle\Entity\Shipping $node6 = null)
    {
        $this->node6 = $node6;

        return $this;
    }

    /**
     * Get node6
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode6()
    {
        return $this->node6;
    }

    /**
     * Set node7
     *
     * @param \HomeBundle\Entity\Shipping $node7
     *
     * @return Trajectory2
     */
    public function setNode7(\HomeBundle\Entity\Shipping $node7 = null)
    {
        $this->node7 = $node7;

        return $this;
    }

    /**
     * Get node7
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode7()
    {
        return $this->node7;
    }

    /**
     * Set node8
     *
     * @param \HomeBundle\Entity\Shipping $node8
     *
     * @return Trajectory2
     */
    public function setNode8(\HomeBundle\Entity\Shipping $node8 = null)
    {
        $this->node8 = $node8;

        return $this;
    }

    /**
     * Get node8
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode8()
    {
        return $this->node8;
    }

    /**
     * Set node9
     *
     * @param \HomeBundle\Entity\Shipping $node9
     *
     * @return Trajectory2
     */
    public function setNode9(\HomeBundle\Entity\Shipping $node9 = null)
    {
        $this->node9 = $node9;

        return $this;
    }

    /**
     * Get node9
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNode9()
    {
        return $this->node9;
    }
}
