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


}
