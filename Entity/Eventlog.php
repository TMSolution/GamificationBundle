<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventlog
 *
 * @ORM\Table(name="eventlog", indexes={@ORM\Index(name="fk_usereventlog_event1_idx", columns={"eventid"}), @ORM\Index(name="fk_eventlog_object1_idx", columns={"objectinstanceid"})})
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
     * Set objectinstanceid
     *
     * @param \TMSolution\GamificationBundle\Entity\Objectinstance $objectinstanceid
     * @return Eventlog
     */
    public function setObjectInstanceId(\TMSolution\GamificationBundle\Entity\Objectinstance $objectinstanceid)
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
     * @return Eventlog
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
