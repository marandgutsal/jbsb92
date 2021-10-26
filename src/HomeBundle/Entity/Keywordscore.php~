<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywordscore
 *
 * @ORM\Table(name="keywordScore", indexes={@ORM\Index(name="keyword_id", columns={"keyword_id"})})
 * @ORM\Entity
 */
class Keywordscore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keywordScore_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordscoreId;

    /**
     * @var \Keyword
     *
     * @ORM\ManyToOne(targetEntity="Keyword")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keyword_id", referencedColumnName="keyword_id")
     * })
     */
    private $keyword;



    /**
     * Get keywordscoreId
     *
     * @return integer
     */
    public function getKeywordscoreId()
    {
        return $this->keywordscoreId;
    }

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Keywordscore
     */
    public function setKeyword(\HomeBundle\Entity\Keyword $keyword = null)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return \HomeBundle\Entity\Keyword
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}
