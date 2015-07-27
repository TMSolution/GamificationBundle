<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventlog
 *
 * @ORM\Table(name="eventlog", indexes={@ORM\Index(name="fk_usereventlog_user_idx", columns={"userid"}), @ORM\Index(name="fk_usereventlog_event1_idx", columns={"eventid"})})
 * @ORM\Entity
 */
class Eventlog
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
     * @var \TMSolution\GamificationBundle\Entity\Event
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eventid", referencedColumnName="id")
     * })
     */
    private $eventid;

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
