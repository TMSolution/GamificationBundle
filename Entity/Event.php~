<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Eventcategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Eventcategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventcategoryid", referencedColumnName="id")
     * })
     */
    protected $eventcategoryid;



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
     * Set eventcategory
     *
     * @param \TMSolution\GamificationBundle\Entity\Eventcategory $eventcategory
     * @return Event
     */
    public function setEventcategory(\TMSolution\GamificationBundle\Entity\Eventcategory $eventcategory = null)
    {
        $this->eventcategory = $eventcategory;

        return $this;
    }

    /**
     * Get eventcategory
     *
     * @return \TMSolution\GamificationBundle\Entity\Eventcategory 
     */
    public function getEventcategory()
    {
        return $this->eventcategory;
    }
}
