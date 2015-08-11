<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Context
 *
 * @ORM\Table()
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
     * Set rule
     *
     * @param \TMSolution\GamificationBundle\Entity\Rule $rule
     * @return Context
     */
    public function setRule(\TMSolution\GamificationBundle\Entity\Rule $rule = null)
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Get rule
     *
     * @return \TMSolution\GamificationBundle\Entity\Rule 
     */
    public function getRule()
    {
        return $this->rule;
    }
}
