<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rule
 *
 * @ORM\Table(name="rule")
 * @ORM\Entity
 */
class Rule {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

     /*
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * 
     */
    protected $name;
    
   
    
    /**
     * 
     * 
     * @ORM\ManyToOne(targetEntity="Context")
     * @ORM\JoinColumn(name="context", referencedColumnName="id")
     */
    protected $context;
    
    



    /**
     * @var \TMSolution\GamificationBundle\Entity\Trophy
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophy", referencedColumnName="id")
     * })
     */
    protected $trophy;


    /**
     * @var string
     *
     * @ORM\Column(name="operator", type="string", length=255, nullable=false)
     */
    protected $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    protected $value;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="id")
     * @ORM\JoinColumn(name="event", referencedColumnName="id")
     */
    protected $event;
    
    
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Rule
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set trophy
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophy $trophy
     * @return Rule
     */
    public function setTrophy(\TMSolution\GamificationBundle\Entity\Trophy $trophy = null) {
        $this->trophy = $trophy;

        return $this;
    }

    /**
     * Get trophy
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophy 
     */
    public function getTrophy() {
        return $this->trophy;
    }

    /**
     * Set operator
     *
     * @param string $operator
     * @return Rule
     */
    public function setOperator($operator) {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string 
     */
    public function getOperator() {
        return $this->operator;
    }

    /**
     * Set context
     *
     * @param string $context
     * @return Rule
     */
    public function setContext($context) {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string 
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Rule
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->contexts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contexts
     *
     * @param \TMSolution\GamificationBundle\Entity\Context $contexts
     * @return Rule
     */
    public function addContext(\TMSolution\GamificationBundle\Entity\Context $contexts) {
        $this->contexts[] = $contexts;

        return $this;
    }

    /**
     * Remove contexts
     *
     * @param \TMSolution\GamificationBundle\Entity\Context $contexts
     */
    public function removeContext(\TMSolution\GamificationBundle\Entity\Context $contexts) {
        $this->contexts->removeElement($contexts);
    }

    /**
     * Get contexts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContexts() {
        return $this->contexts;
    }


    /**
     * Set event
     *
     * @param \TMSolution\GamificationBundle\Entity\Event $event
     * @return Rule
     */
    public function setEvent(\TMSolution\GamificationBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \TMSolution\GamificationBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
