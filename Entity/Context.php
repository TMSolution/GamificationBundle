<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Context
 *
 * @ORM\Table(name="gamification_context")
 * @ORM\Entity
 */
class Context
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string 
     * 
     * @ORM\COlumn(name="name", type="string", nullable = false, length = 50)
     */
    protected $name;
    
//    /**
//     * @ORM\ManyToOne(targetEntity="Rule", inversedBy="context")
//     *
//     * 
//     */
//     
//    protected $rule;

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
     * Set name
     *
     * @param string $name
     * @return Context
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * __toString method
     *
     * return string
     */
    public function __toString()
    {
        return (string)$this->getName();
    }





}
