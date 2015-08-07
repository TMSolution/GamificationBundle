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
     *   @ORM\JoinColumn(name="objecttype", referencedColumnName="id")
     * })
     */
    protected $objecttype;

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
     * Set objectype
     *
     * @param \TMSolution\GamificationBundle\Entity\Objecttype $objectype
     * @return Objectinstance
     */
    public function setObjecttype(\TMSolution\GamificationBundle\Entity\Objecttype $objecttype = null) {
        $this->objecttype = $objecttype;

        return $this;
    }

    /**
     * Get objecttype
     *
     * @return \TMSolution\GamificationBundle\Entity\Objecttype 
     */
    public function getObjecttype() {
        return $this->objecttype;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'objectidentity' => $this->getObjectidentity(),
            'objecttype' => $this->getObjecttype()
        ];
    }

}
