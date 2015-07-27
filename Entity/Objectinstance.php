<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectinstance
 *
 * @ORM\Table(name="objectinstance", indexes={@ORM\Index(name="fk_object_class1_idx", columns={"classid"})})
 * @ORM\Entity
 */
class Objectinstance
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
     * @var integer
     *
     * @ORM\Column(name="objectidentity", type="bigint", nullable=true)
     */
    private $objectidentity;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Classname
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Classname")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="classid", referencedColumnName="id")
     * })
     */
    private $classid;



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
     * Set objectidentity
     *
     * @param integer $objectidentity
     * @return Objectinstance
     */
    public function setObjectidentity($objectidentity)
    {
        $this->objectidentity = $objectidentity;

        return $this;
    }

    /**
     * Get objectidentity
     *
     * @return integer 
     */
    public function getObjectidentity()
    {
        return $this->objectidentity;
    }

    /**
     * Set classid
     *
     * @param \TMSolution\GamificationBundle\Entity\Classname $classid
     * @return Objectinstance
     */
    public function setClassid(\TMSolution\GamificationBundle\Entity\Classname $classid = null)
    {
        $this->classid = $classid;

        return $this;
    }

    /**
     * Get classid
     *
     * @return \TMSolution\GamificationBundle\Entity\Classname 
     */
    public function getClassid()
    {
        return $this->classid;
    }
}
