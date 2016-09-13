<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GamificationEvent
 *
 * @ORM\Table(name="gamification_event")
 * @ORM\Entity
 */
class GamificationEvent
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     * 
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    protected $date;



    /**
     * @var \TMSolution\GamificationBundle\Entity\GamificationEventCategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\GamificationEventCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gamification_eventcategory_id", referencedColumnName="id")
     * })
     */
    protected $gamificationEventCategory;

    /**
     * @ORM\ManyToMany(targetEntity="Trophy")
     * @ORM\JoinTable(name="trophy_has_gamifiaction_event")
     */
    protected $trophies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trophies = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     *
     * @return GamificationEvent
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return GamificationEvent
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    

    /**
     * Set gamificationEventCategory
     *
     * @param \TMSolution\GamificationBundle\Entity\GamificationEventCategory $gamificationEventCategory
     *
     * @return GamificationEvent
     */
    public function setGamificationEventCategory(\TMSolution\GamificationBundle\Entity\GamificationEventCategory $gamificationEventCategory = null)
    {
        $this->gamificationEventCategory = $gamificationEventCategory;

        return $this;
    }

    /**
     * Get gamificationEventCategory
     *
     * @return \TMSolution\GamificationBundle\Entity\GamificationEventCategory
     */
    public function getGamificationEventCategory()
    {
        return $this->gamificationEventCategory;
    }

    /**
     * Add trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     *
     * @return GamificationEvent
     */
    public function addTrophy(\TMSolution\GamificationBundle\Entity\Trophy $trophy)
    {
        $this->trophies[] = $trophy;

        return $this;
    }

    /**
     * Remove trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     */
    public function removeTrophy(\TMSolution\GamificationBundle\Entity\Trophy $trophy)
    {
        $this->trophies->removeElement($trophy);
    }

    /**
     * Get trophies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrophies()
    {
        return $this->trophies;
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

}
