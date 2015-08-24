<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventlog
 *
 * @ORM\Table(name="eventlog")
 * @ORM\Entity
 */
class Eventlog
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
     * @var \TMSolution\GamificationBundle\Entity\Gamerinstance
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Gamerinstance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gamerinstance", referencedColumnName="id")
     * })
     */
    protected $gamerInstance;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Event
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Event")
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
     * @return Eventlog
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
     * Set gamerinstance
     *
     * @param \TMSolution\GamificationBundle\Entity\Gamerinstance $gamerinstance
     * @return Eventlog
     */
    public function setGamerInstance(\TMSolution\GamificationBundle\Entity\Gamerinstance $gamerinstance)
    {
        $this->gamerInstance = $gamerinstance;

        return $this;
    }

    /**
     * Get gamerinstance
     *
     * @return \TMSolution\GamificationBundle\Entity\Gamerinstance 
     */
    public function getGamerInstance()
    {
        return $this->gamerInstance;
    }

    /**
     * Set event
     *
     * @param \TMSolution\GamificationBundle\Entity\Event $event
     * @return Eventlog
     */
    public function setEvent(\TMSolution\GamificationBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \TMSolution\GamificationBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
