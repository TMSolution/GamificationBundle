<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventcounter
 *
 * @ORM\Table(name="eventcounter", indexes={@ORM\Index(name="fk_usereventcounter_event1_idx", columns={"eventid"}), @ORM\Index(name="fk_eventcounter_object1_idx", columns={"objectid"})})
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
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="counter", type="float", precision=10, scale=0, nullable=true)
     */
    private $counter;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Object
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Object")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objectid", referencedColumnName="id")
     * })
     */
    private $objectid;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Event
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventid", referencedColumnName="id")
     * })
     */
    private $eventid;



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
     * Set objectid
     *
     * @param \TMSolution\GamificationBundle\Entity\Object $objectid
     * @return Eventcounter
     */
    public function setObjectid(\TMSolution\GamificationBundle\Entity\Object $objectid = null)
    {
        $this->objectid = $objectid;

        return $this;
    }

    /**
     * Get objectid
     *
     * @return \TMSolution\GamificationBundle\Entity\Object 
     */
    public function getObjectid()
    {
        return $this->objectid;
    }

    /**
     * Set eventid
     *
     * @param \TMSolution\GamificationBundle\Entity\Event $eventid
     * @return Eventcounter
     */
    public function setEventid(\TMSolution\GamificationBundle\Entity\Event $eventid = null)
    {
        $this->eventid = $eventid;

        return $this;
    }

    /**
     * Get eventid
     *
     * @return \TMSolution\GamificationBundle\Entity\Event 
     */
    public function getEventid()
    {
        return $this->eventid;
    }
}
