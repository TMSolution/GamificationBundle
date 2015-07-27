<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventlog
 *
 * @ORM\Table(name="eventlog", indexes={@ORM\Index(name="fk_usereventlog_event1_idx", columns={"eventid"}), @ORM\Index(name="fk_eventlog_object1_idx", columns={"objectid"})})
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
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

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
     * Set objectid
     *
     * @param \TMSolution\GamificationBundle\Entity\Object $objectid
     * @return Eventlog
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
