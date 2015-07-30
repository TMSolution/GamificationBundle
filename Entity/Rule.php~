<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rule
 *
 * @ORM\Table(name="rule", indexes={@ORM\Index(name="fk_rule_trophy1_idx", columns={"trophyid"})})
 * @ORM\Entity
 */
class Rule
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophyid", referencedColumnName="id")
     * })
     */
    private $trophyid;


}
