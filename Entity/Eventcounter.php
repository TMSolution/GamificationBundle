<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventcounter
 *
 * @ORM\Table(name="eventcounter", indexes={@ORM\Index(name="fk_usereventcounter_user1_idx", columns={"userid"}), @ORM\Index(name="fk_usereventcounter_event1_idx", columns={"eventid"})})
 * @ORM\Entity
 */
class Eventcounter
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
     * @var float
     *
     * @ORM\Column(name="counter", type="float", precision=10, scale=0, nullable=true)
     */
    private $counter;

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
