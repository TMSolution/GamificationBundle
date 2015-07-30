<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objecttrophy
 *
 * @ORM\Table(name="objecttrophy", indexes={@ORM\Index(name="fk_usertrophy_trophy1_idx", columns={"trophyid"}), @ORM\Index(name="fk_usertrophy_object1_idx", columns={"objectid"})})
 * @ORM\Entity
 */
class Objecttrophy
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Objectinstance
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Objectinstance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objectid", referencedColumnName="id")
     * })
     */
    private $objectid;

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
