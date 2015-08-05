<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectinstance
 *
 * @ORM\Table(name="objectinstance")
 * @ORM\Entity
 */
class Objectinstance implements \JsonSerializable {

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
     * @ORM\Column(name="objectidentity", type="bigint", nullable=true)
     */
    protected $objectidentity;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Objecttype
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Objecttype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objecttypeid", referencedColumnName="id")
     * })
     */
    protected $objecttypeid;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set objectidentity
     *
     * @param integer $objectidentity
     * @return Objectinstance
     */
    public function setObjectidentity($objectidentity) {
        $this->objectidentity = $objectidentity;

        return $this;
    }

    /**
     * Get objectidentity
     *
     * @return integer 
     */
    public function getObjectidentity() {
        return $this->objectidentity;
    }

    /**
     * Set objectypeid
     *
     * @param \TMSolution\GamificationBundle\Entity\Objecttype $objectypeid
     * @return Objectinstance
     */
    public function setObjecttypeid(\TMSolution\GamificationBundle\Entity\Objecttype $objecttypeid = null) {
        $this->objecttypeid = $objecttypeid;

        return $this;
    }

    /**
     * Get objecttypeid
     *
     * @return \TMSolution\GamificationBundle\Entity\Objecttype 
     */
    public function getObjecttypeid() {
        return $this->objecttypeid;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'objectidentity' => $this->getObjectidentity(),
            'objecttypeid' => $this->getObjecttypeid()
        ];
    }

}
