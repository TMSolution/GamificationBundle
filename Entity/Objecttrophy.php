<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objecttrophy
 *
 * @ORM\Table(name="objecttrophy")
 * @ORM\Entity
 */
class Objecttrophy implements \JsonSerializable
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
     *   @ORM\JoinColumn(name="objectid", referencedColumnName="id")
     * })
     */
    protected $objectid;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophyid", referencedColumnName="id")
     * })
     */
    protected $trophyid;



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
     * @return Objecttrophy
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
     * @param \TMSolution\GamificationBundle\Entity\Objectinstance $objectid
     * @return Objecttrophy
     */
    public function setObjectid(\TMSolution\GamificationBundle\Entity\Objectinstance $objectid = null)
    {
        $this->objectid = $objectid;

        return $this;
    }

    /**
     * Get objectid
     *
     * @return \TMSolution\GamificationBundle\Entity\Objectinstance 
     */
    public function getObjectid()
    {
        return $this->objectid;
    }

    /**
     * Set trophyid
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophyid
     * @return Objecttrophy
     */
    public function setTrophyid(\TMSolution\GamificationBundle\Entity\Trophy $trophyid = null)
    {
        $this->trophyid = $trophyid;

        return $this;
    }

    /**
     * Get trophyid
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophy 
     */
    public function getTrophyid()
    {
        return $this->trophyid;
    }
    
    public function jsonSerialize() {
        return [
            'id' =>$this->getId(),
            'date' => $this->getDate(),
            'objectid' => $this->getObjectid(),
            'trophyid' => $this->getTrophyid()
        ];
    }
}
