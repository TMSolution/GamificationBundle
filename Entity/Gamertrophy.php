<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gamertrophy
 *
 * @ORM\Table(name="gamertrophy")
 * @ORM\Entity
 */
class Gamertrophy implements \JsonSerializable {

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
     * @var \TMSolution\GamificationBundle\Entity\Gamerinstance
     * 
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Gamerinstance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gamerinstance", referencedColumnName="id")
     * })
     */
    protected $gamerinstance;

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
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Gamertrophy
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set gamer
     *
     * @param \TMSolution\GamificationBundle\Entity\Gamerinstance $gamer
     * @return Gamertrophy
     */
    public function setGamerinstance(\TMSolution\GamificationBundle\Entity\Gamerinstance $gamer)
    {
        $this->gamerinstance = $gamer;
        return $this;
    }

    /**
     * Get gamer
     *
     * @return \TMSolution\GamificationBundle\Entity\Gamerinstance 
     */
    public function getGamerinstance() {
        return $this->gamerinstance;
    }

    /**
     * Set trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     * @return Gamertrophy
     */
    public function setTrophy(\TMSolution\GamificationBundle\Entity\Trophy $trophy = null) {
        $this->trophy = $trophy;

        return $this;
    }

    /**
     * Get trophy
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophy 
     */
    public function getTrophy() {
        return $this->trophy;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'date' => $this->getDate(),
            'gamer' => $this->getGamer(),
            'trophy' => $this->getTrophy()
        ];
    }

}
