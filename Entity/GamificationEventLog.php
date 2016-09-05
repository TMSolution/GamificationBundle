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
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Model\GamerInstanceInterface",inversedBy="gamificationEventLogs")
     * @ORM\JoinColumn(name="gamer_instance_id", referencedColumnName="id")
     */
    protected $gamerInstance;

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

    public function setGamerInstance($gamerInstance = null)
    {
        $this->gamerInstance = $gamerInstance;

        return $this;
    }

    public function getGamerInstance()
    {
        return $this->gamerInstance;
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
        return (string) $this->getId();
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
