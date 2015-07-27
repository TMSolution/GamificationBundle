<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="fk_event_eventcategory1_idx", columns={"eventcategoryid"})})
 * @ORM\Entity
 */
class Event
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Eventcategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Eventcategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventcategoryid", referencedColumnName="id")
     * })
     */
    private $eventcategoryid;



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
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set eventcategoryid
     *
     * @param \TMSolution\GamificationBundle\Entity\Eventcategory $eventcategoryid
     * @return Event
     */
    public function setEventcategoryid(\TMSolution\GamificationBundle\Entity\Eventcategory $eventcategoryid = null)
    {
        $this->eventcategoryid = $eventcategoryid;

        return $this;
    }

    /**
     * Get eventcategoryid
     *
     * @return \TMSolution\GamificationBundle\Entity\Eventcategory 
     */
    public function getEventcategoryid()
    {
        return $this->eventcategoryid;
    }
}
