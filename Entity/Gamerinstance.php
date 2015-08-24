<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gamerinstance
 *
 * @ORM\Table(name="gamerinstance")
 * @ORM\Entity
 */
class Gamerinstance implements \JsonSerializable {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="gameridentity", type="bigint", nullable=true)
     */
    protected $gameridentity;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Gamertype
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Gamertype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gamertype", referencedColumnName="id")
     * })
     */
    protected $gamertype;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set gameridentity
     *
     * @param integer $gameridentity
     * @return Gamerinstance
     */
    public function setGameridentity($gameridentity) {
        $this->gameridentity = $gameridentity;

        return $this;
    }

    /**
     * Get gameridentity
     *
     * @return integer 
     */
    public function getGameridentity() {
        return $this->gameridentity;
    }

    /**
     * Set gamertype
     *
     * @param \TMSolution\GamificationBundle\Entity\Gamertype $gamerype
     * @return Gamerinstance
     */
    public function setGamertype(\TMSolution\GamificationBundle\Entity\Gamertype $gamertype = null) {
        $this->gamertype = $gamertype;

        return $this;
    }

    /**
     * Get gamertype
     *
     * @return \TMSolution\GamificationBundle\Entity\Gamertype 
     */
    public function getGamertype() {
        return $this->gamertype;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'gameridentity' => $this->getGameridentity(),
            'gamertype' => $this->getGamertype()
        ];
    }

}
