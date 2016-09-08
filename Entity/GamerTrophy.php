<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gamertrophy
 *
 * @ORM\Table(name="gamification_gamertrophy")
 * @ORM\Entity
 */
class GamerTrophy
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
     * @var integer
     * 
     * @ORM\Column(name="position", type="integer", nullable=true)
     * 
     */
    protected $position;

    /**
     * @var \TMSolution\GamificationBundle\Entity\TrophyCategory
     * 
     * @ORM\ManyToOne(targetEntity="TrophyCategory")
     * @ORM\JoinColumn(name="trophy_category_id", referencedColumnName="id")
     */
    protected $trophyCategory;

    /**
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Model\GamerInstanceInterface",inversedBy="gamerTrophies")
     * @ORM\JoinColumn(name="gamer_instance_id", referencedColumnName="id")
     */
    protected $gamerInstance;

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
     * @var \TMSolution\GamificationBundle\Entity\TrophyConfiguration
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\TrophyConfiguration")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophy_configuration", referencedColumnName="id")
     * })
     */
    protected $trophyConfiguration;

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
     * @return GamerTrophy
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
     * Set position
     *
     * @param integer $position
     * @return GamerTrophy
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set trophyCategory
     *
     * @param \TMSolution\GamificationBundle\Entity\TrophyCategory $trophyCategory
     * @return GamerTrophy
     */
    public function setTrophyCategory(\TMSolution\GamificationBundle\Entity\TrophyCategory $trophyCategory = null)
    {
        $this->trophyCategory = $trophyCategory;

        return $this;
    }

    /**
     * Get trophyCategory
     *
     * @return \TMSolution\GamificationBundle\Entity\TrophyCategory 
     */
    public function getTrophyCategory()
    {
        return $this->trophyCategory;
    }

    public function setGamerInstance($gamerInstance = null)
    {
        $this->gamerInstance = $gamerInstance;

        return $this;
    }

    public function getGamerInstance()
    {
        return $this->gamerInstance;
    }

    /**
     * Set trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     * @return GamerTrophy
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
     * Set trophyConfiguration
     *
     * @param integer $trophyConfiguration
     * @return GamerTrophy
     */
    public function setTrophyConfiguration($trophyConfiguration)
    {
        $this->trophyConfiguration = $trophyConfiguration;

        return $this;
    }

    /**
     * Get trophyConfiguration
     *
     * @return integer 
     */
    public function getTrophyConfiguration()
    {
        return $this->trophyConfiguration;
    }

    /**
     * __toString method
     *
     * return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }

}
