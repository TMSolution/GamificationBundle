<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophy
 *
 * @ORM\Table(name="trophy", indexes={@ORM\Index(name="fk_trophy_trophycategory1_idx", columns={"trophycategoryid"})})
 * @ORM\Entity
 */
class Trophy
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Trophycategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophycategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophycategoryid", referencedColumnName="id")
     * })
     */
    private $trophycategoryid;


}
