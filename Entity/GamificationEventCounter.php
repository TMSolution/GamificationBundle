<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GamificationEventcounter
 *
 * @ORM\Table(name="gamification_eventcounter")
 * @ORM\Entity
 */
class GamificationEventCounter
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
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Model\GamerInstanceInterface")
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
     * Set counter
     *
     * @param float $counter
     * @return GamificationEventcounter
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
     * @return GamificationEventCounter
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
