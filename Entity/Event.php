<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
class Event {

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
     * @ORM\ManyToOne(targetEntity="Gamerinstance")
     * @ORM\JoinColumn(name="gamerinstanceid", referencedColumnName="id")
     */
    protected $gamerinstance;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Eventcategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Eventcategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventcategoryid", referencedColumnName="id")
     * })
     */
    protected $eventcategoryid;

    /**
     * 
     * @ORM\OneToMany(targetEntity="Rule", mappedBy="event")
     * 
     */
    protected $event;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set eventcategory
     *
     * @param \TMSolution\GamificationBundle\Entity\Eventcategory $eventcategory
     * @return Event
     */
    public function setEventcategory(\TMSolution\GamificationBundle\Entity\Eventcategory $eventcategory = null) {
        $this->eventcategory = $eventcategory;

        return $this;
    }

    /**
     * Get eventcategory
     *
     * @return \TMSolution\GamificationBundle\Entity\Eventcategory 
     */
    public function getEventcategory() {
        return $this->eventcategory;
    }

    /**
     * Set eventcategoryid
     *
     * @param \TMSolution\GamificationBundle\Entity\Eventcategory $eventcategoryid
     * @return Event
     */
    public function setEventcategoryid(\TMSolution\GamificationBundle\Entity\Eventcategory $eventcategoryid = null) {
        $this->eventcategoryid = $eventcategoryid;

        return $this;
    }

    /**
     * Get eventcategoryid
     *
     * @return \TMSolution\GamificationBundle\Entity\Eventcategory 
     */
    public function getEventcategoryid() {
        return $this->eventcategoryid;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $event
     * @return Event
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

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
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
     * Set gamerinstanceid
     *
     * @param integer $gamerinstanceid
     * @return Event
     */
    public function setGamerinstanceid($gamerinstanceid)
    {
        $this->gamerinstanceid = $gamerinstanceid;

        return $this;
    }

    /**
     * Get gamerinstanceid
     *
     * @return integer 
     */
    public function getGamerinstanceid()
    {
        return $this->gamerinstanceid;
    }

    /**
     * Set gamerinstance
     *
     * @param \TMSolution\GamificationBundle\Entity\Gamerinstance $gamerinstance
     * @return Event
     */
    public function setGamerinstance(\TMSolution\GamificationBundle\Entity\Gamerinstance $gamerinstance = null)
    {
        $this->gamerinstance = $gamerinstance;

        return $this;
    }

    /**
     * Get gamerinstance
     *
     * @return \TMSolution\GamificationBundle\Entity\Gamerinstance 
     */
    public function getGamerinstance()
    {
        return $this->gamerinstance;
    }
}
