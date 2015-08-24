<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventcounter
 *
 * @ORM\Table(name="eventcounter")
 * @ORM\Entity
 */
class Eventcounter
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
     * @var float
     *
     * @ORM\Column(name="counter", type="float", precision=10, scale=0, nullable=true)
     */
    protected $counter;

   /**
     * @var \TMSolution\GamificationBundle\Entity\Gamerinstance
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Gamerinstance")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="gamerinstance", referencedColumnName="id")
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
     * Set counter
     *
     * @param float $counter
     * @return Eventcounter
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get counter
     *
     * @return float 
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * Set gamerinstance
     *
     * @param \TMSolution\GamificationBundle\Entity\Gamerinstance $gamerinstance
     * @return Eventcounter
     */
    public function setGamerInstance(\TMSolution\GamificationBundle\Entity\Gamerinstance $gamerinstance = null)
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
     * @return Eventcounter
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
