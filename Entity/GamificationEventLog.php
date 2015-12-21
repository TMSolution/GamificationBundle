<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GamificationEventlog
 *
 * @ORM\Table(name="gamification_eventlog")
 * @ORM\Entity
 */
class GamificationEventLog
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    protected $date;

   /**
     * @ORM\ManyToOne(targetEntity="CCO\UserBundle\Entity\User",inversedBy="gamificationEventLogs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
     protected $user;
    /**
     * @var \TMSolution\GamificationBundle\Entity\GamificationEvent
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\GamificationEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event", referencedColumnName="id")
     * })
     */
    protected $event;




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
     * Set date
     *
     * @param \DateTime $date
     * @return GamificationEventlog
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
     * @return GamificationEventlog
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
     * Set event
     *
     * @param \TMSolution\GamificationBundle\Entity\GamificationEvent $event
     * @return GamificationEventlog
     */
    public function setGamificationEvent(\TMSolution\GamificationBundle\Entity\GamificationEvent $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \TMSolution\GamificationBundle\Entity\GamificationEvent 
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
        return (string)$this->getId();
    }




    /**
     * Set event
     *
     * @param \TMSolution\GamificationBundle\Entity\GamificationEvent $event
     * @return GamificationEventLog
     */
    public function setEvent(\TMSolution\GamificationBundle\Entity\GamificationEvent $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \TMSolution\GamificationBundle\Entity\GamificationEvent 
     */
    public function getEvent()
    {
        return $this->event;
    }

}
