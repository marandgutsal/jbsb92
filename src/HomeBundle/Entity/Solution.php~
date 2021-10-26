<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solution
 *
 * @ORM\Table(name="solution")
 * @ORM\Entity
 */
class Solution
{
    /**
     * @var integer
     *
     * @ORM\Column(name="solution_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $solutionId;

    /**
     * @var string
     *
     * @ORM\Column(name="solution_description", type="string", length=255, nullable=false)
     */
    private $solutionDescription;



    /**
     * Get solutionId
     *
     * @return integer
     */
    public function getSolutionId()
    {
        return $this->solutionId;
    }

    /**
     * Set solutionDescription
     *
     * @param string $solutionDescription
     *
     * @return Solution
     */
    public function setSolutionDescription($solutionDescription)
    {
        $this->solutionDescription = $solutionDescription;

        return $this;
    }

    /**
     * Get solutionDescription
     *
     * @return string
     */
    public function getSolutionDescription()
    {
        return $this->solutionDescription;
    }
}
