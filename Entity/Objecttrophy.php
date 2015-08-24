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
     *   @ORM\JoinColumn(name="objectinstance", referencedColumnName="id")
     * })
     */
    protected $objectinstance;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophy", referencedColumnName="id")
     * })
     */
    protected $trophy;



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
     * Set object
     *
     * @param \TMSolution\GamificationBundle\Entity\Objectinstance $object
     * @return Objecttrophy
     */
    public function setObjectinstance(\TMSolution\GamificationBundle\Entity\Objectinstance $object = null)
    {
        $this->objectinstance = $objectinstance;

        return $this;
    }

    /**
     * Get object
     *
     * @return \TMSolution\GamificationBundle\Entity\Objectinstance 
     */
    public function getObjectinstance()
    {
        return $this->objectinstance;
    }

    /**
     * Set trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     * @return Objecttrophy
     */
    public function setTrophy(\TMSolution\GamificationBundle\Entity\Trophy $trophy = null)
    {
        $this->trophy = $trophy;

        return $this;
    }

    /**
     * Get trophy
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophy 
     */
    public function getTrophy()
    {
        return $this->trophy;
    }
    
    public function jsonSerialize() {
        return [
            'id' =>$this->getId(),
            'date' => $this->getDate(),
            'object' => $this->getObject(),
            'trophy' => $this->getTrophy()
        ];
    }
}
