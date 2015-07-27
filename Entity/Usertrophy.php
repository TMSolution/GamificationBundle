<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usertrophy
 *
 * @ORM\Table(name="usertrophy", indexes={@ORM\Index(name="fk_usertrophy_trophy1_idx", columns={"trophyid"}), @ORM\Index(name="fk_usertrophy_object1_idx", columns={"objectid"})})
 * @ORM\Entity
 */
class Usertrophy
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
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophyid", referencedColumnName="id")
     * })
     */
    private $trophyid;



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
     * @return Usertrophy
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
     * @return Usertrophy
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
     * Set trophyid
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophyid
     * @return Usertrophy
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
}
