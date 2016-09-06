<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophy
 *
 * @ORM\Table(name="gamification_trophy_configuration")
 * @ORM\Entity
 */
class TrophyConfiguration 
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
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophy_id", referencedColumnName="id")
     * })
     */
    protected $trophy;
  
    /**
     * @var integer
     * 
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    protected $level;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="multiplicity", type="integer", nullable=false)
     */
    protected $multiplicity;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    protected $points;

   


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
     * Set level
     *
     * @param integer $level
     *
     * @return TrophyConfiguration
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set multiplicity
     *
     * @param integer $multiplicity
     *
     * @return TrophyConfiguration
     */
    public function setMultiplicity($multiplicity)
    {
        $this->multiplicity = $multiplicity;
    
        return $this;
    }

    /**
     * Get multiplicity
     *
     * @return integer
     */
    public function getMultiplicity()
    {
        return $this->multiplicity;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return TrophyConfiguration
     */
    public function setPoints($points)
    {
        $this->points = $points;
    
        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     *
     * @return TrophyConfiguration
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
    /**
     * __toString method
     *
     * return string
     */
    public function __toString()
    {
        return (string)$this->getId();
    }

}
