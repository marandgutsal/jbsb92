<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywordterritoriality
 *
 * @ORM\Table(name="keywordTerritoriality", indexes={@ORM\Index(name="locationLevel_id", columns={"territoriality_id"}), @ORM\Index(name="keyword_id", columns={"keyword_id"}), @ORM\Index(name="language_id", columns={"language_id"})})
 * @ORM\Entity
 */
class Keywordterritoriality
{
    /**
     * @var integer
     *
     * @ORM\Column(name="territorialityKeyword", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $territorialitykeyword;

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
     * @var \Territoriality
     *
     * @ORM\ManyToOne(targetEntity="Territoriality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="territoriality_id", referencedColumnName="territoriality_id")
     * })
     */
    private $territoriality;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;



    /**
     * Get territorialitykeyword
     *
     * @return integer
     */
    public function getTerritorialitykeyword()
    {
        return $this->territorialitykeyword;
    }

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Keywordterritoriality
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

    /**
     * Set territoriality
     *
     * @param \HomeBundle\Entity\Territoriality $territoriality
     *
     * @return Keywordterritoriality
     */
    public function setTerritoriality(\HomeBundle\Entity\Territoriality $territoriality = null)
    {
        $this->territoriality = $territoriality;

        return $this;
    }

    /**
     * Get territoriality
     *
     * @return \HomeBundle\Entity\Territoriality
     */
    public function getTerritoriality()
    {
        return $this->territoriality;
    }

    /**
     * Set language
     *
     * @param \HomeBundle\Entity\Language $language
     *
     * @return Keywordterritoriality
     */
    public function setLanguage(\HomeBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \HomeBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
