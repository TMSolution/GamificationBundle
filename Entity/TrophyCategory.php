<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrophyCategory
 *
 * @ORM\Table(name="gamification_trophyCategory")
 * @ORM\Entity
 */
class TrophyCategory
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="background_color", type="string", length=255, nullable=true)
     */
    protected $backgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="background_icon_color", type="string", length=255, nullable=true)
     */
    protected $backgroundIconColor;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_color", type="string", length=255, nullable=true)
     */
    protected $iconColor;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return TrophyCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * __toString method
     *
     * return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }

    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    public function setBackgroundIconColor($backgroundIconColor)
    {
        $this->backgroundIconColor = $backgroundIconColor;

        return $this;
    }

    public function getBackgroundIconColor()
    {
        return $this->backgroundIconColor;
    }

    public function setIconColor($iconColor)
    {
        $this->iIconColor = $iconColor;

        return $this;
    }

    public function getIconColor()
    {
        return $this->iconColor;
    }

}
