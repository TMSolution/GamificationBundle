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
     * @var \TMSolution\GamificationBundle\Entity\Objectinstance
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Objectinstance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objectinstanceid", referencedColumnName="id")
     * })
     */
    protected $objectInstanceId;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Event
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventid", referencedColumnName="id")
     * })
     */
    protected $eventid;



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
     * Set objectinstanceid
     *
     * @param \TMSolution\GamificationBundle\Entity\Objectinstance $objectinstanceid
     * @return Eventcounter
     */
    public function setObjectInstanceId(\TMSolution\GamificationBundle\Entity\Objectinstance $objectinstanceid = null)
    {
        $this->objectInstanceId = $objectinstanceid;

        return $this;
    }

    /**
     * Get objectinstanceid
     *
     * @return \TMSolution\GamificationBundle\Entity\Objectinstance 
     */
    public function getObjectInstanceId()
    {
        return $this->objectInstanceId;
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
