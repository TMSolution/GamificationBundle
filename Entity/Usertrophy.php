<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usertrophy
 *
 * @ORM\Table(name="usertrophy", indexes={@ORM\Index(name="fk_usertrophy_user1_idx", columns={"userid"}), @ORM\Index(name="fk_usertrophy_trophy1_idx", columns={"trophyid"})})
 * @ORM\Entity
 */
class Usertrophy
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
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophyid", referencedColumnName="id")
     * })
     */
    private $trophyid;

    /**
     * @var \TMSolution\GamificationBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * })
     */
    private $userid;


}
