<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywordlanguage
 *
 * @ORM\Table(name="keywordLanguage", uniqueConstraints={@ORM\UniqueConstraint(name="keyword_id", columns={"keyword_id", "language_id"})}, indexes={@ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="IDX_564434D0115D4552", columns={"keyword_id"})})
 * @ORM\Entity
 */
class Keywordlanguage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keywordLanguage_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordlanguageId;

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
     * @var \Keyword
     *
     * @ORM\ManyToOne(targetEntity="Keyword")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keyword_id", referencedColumnName="keyword_id")
     * })
     */
    private $keyword;



    /**
     * Get keywordlanguageId
     *
     * @return integer
     */
    public function getKeywordlanguageId()
    {
        return $this->keywordlanguageId;
    }

    /**
     * Set language
     *
     * @param \HomeBundle\Entity\Language $language
     *
     * @return Keywordlanguage
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

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Keywordlanguage
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
