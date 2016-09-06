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

   

}
