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
     * @ORM\ManyToOne(targetEntity="CCO\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var \TMSolution\GamificationBundle\Entity\GamificationEventCategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\GamificationEventCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventcategory_id", referencedColumnName="id")
     * })
     */
    protected $eventCategoryId;

    /**
     * 
     * @ORM\OneToMany(targetEntity="Rule", mappedBy="event")
     * 
     */
    protected $event;

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set eventCategoryId
     *
     * @param \TMSolution\GamificationBundle\Entity\GamificationEventCategory $eventCategoryId
     * @return GamificationEvent
     */
    public function setGamificationEventCategoryId(\TMSolution\GamificationBundle\Entity\GamificationEventCategory $eventCategoryId = null)
    {
        $this->eventCategoryId = $eventCategoryId;

        return $this;
    }

    /**
     * Get eventCategoryId
     *
     * @return \TMSolution\GamificationBundle\Entity\GamificationEventCategory 
     */
    public function getGamificationEventCategoryId()
    {
        return $this->eventCategoryId;
    }

    /**
     * Add event
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $event
     * @return GamificationEvent
     */
    public function addGamificationEvent(\TMSolution\GamificationBundle\Entity\Rule $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $event
     */
    public function removeGamificationEvent(\TMSolution\GamificationBundle\Entity\Rule $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGamificationEvent()
    {
        return $this->event;
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


    /**
     * Set eventCategoryId
     *
     * @param \TMSolution\GamificationBundle\Entity\GamificationEventCategory $eventCategoryId
     * @return GamificationEvent
     */
    public function setEventCategoryId(\TMSolution\GamificationBundle\Entity\GamificationEventCategory $eventCategoryId = null)
    {
        $this->eventCategoryId = $eventCategoryId;

        return $this;
    }

    /**
     * Get eventCategoryId
     *
     * @return \TMSolution\GamificationBundle\Entity\GamificationEventCategory 
     */
    public function getEventCategoryId()
    {
        return $this->eventCategoryId;
    }

    /**
     * Add event
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $event
     * @return GamificationEvent
     */
    public function addEvent(\TMSolution\GamificationBundle\Entity\Rule $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $event
     */
    public function removeEvent(\TMSolution\GamificationBundle\Entity\Rule $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvent()
    {
        return $this->event;
    }

}
