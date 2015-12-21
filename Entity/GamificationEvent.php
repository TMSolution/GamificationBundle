<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GamificationEvent
 *
 * @ORM\Table(name="gamification_event")
 * @ORM\Entity
 */
class GamificationEvent {

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
     * @ORM\ManyToOne(targetEntity="CCO\UserBundle\Entity\User",inversedBy="gamificationEvents")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
     * @ORM\ManyToMany(targetEntity="Rule", inversedBy="gamificationEvents")
     * @ORM\JoinTable(name="rule_has_gamifiaction_event")
     */
    protected $rules;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \CCO\UserBundle\Entity\User $user
     *
     * @return GamificationEvent
     */
    public function setUser(\CCO\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CCO\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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
     * Add rule
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $rule
     *
     * @return GamificationEvent
     */
    public function addRule(\TMSolution\GamificationBundle\Entity\Rule $rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * Remove rule
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $rule
     */
    public function removeRule(\TMSolution\GamificationBundle\Entity\Rule $rule)
    {
        $this->rules->removeElement($rule);
    }

    /**
     * Get rules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRules()
    {
        return $this->rules;
    }
    /**
     * __toString method
     *
     * return string
     */
    public function __toString()
    {
        return (string)$this->getName();
    }

}
