<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophy
 *
 * @ORM\Table(name="gamification_trophy")
 * @ORM\Entity
 */
class Trophy /* implements \JsonSerializable */ {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;
    
    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255, nullable=true)
     */
    protected $icon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    protected $date;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    protected $description;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var \TMSolution\GamificationBundle\Entity\TrophyCategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\TrophyCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophy_category_id", referencedColumnName="id")
     * })
     */
    protected $trophyCategory;

    /**
     * @var \TMSolution\GamificationBundle\Entity\TrophyType
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\TrophyType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophyType", referencedColumnName="id")
     * })
     */
    protected $trophyType;

    

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
     * @return Trophy
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
     * Set image
     *
     * @param string $image
     * @return Trophy
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Trophy
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Trophy
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set trophyCategory
     *
     * @param \TMSolution\GamificationBundle\Entity\TrophyCategory $trophyCategory
     * @return Trophy
     */
    public function setTrophyCategory(\TMSolution\GamificationBundle\Entity\TrophyCategory $trophyCategory = null)
    {
        $this->trophyCategory = $trophyCategory;

        return $this;
    }

    /**
     * Get trophyCategory
     *
     * @return \TMSolution\GamificationBundle\Entity\TrophyCategory 
     */
    public function getTrophyCategory()
    {
        return $this->trophyCategory;
    }

    /**
     * Set trophyType
     *
     * @param \TMSolution\GamificationBundle\Entity\TrophyType $trophyType
     * @return Trophy
     */
    public function setTrophyType(\TMSolution\GamificationBundle\Entity\TrophyType $trophyType = null)
    {
        $this->trophyType = $trophyType;

        return $this;
    }

    /**
     * Get trophyType
     *
     * @return \TMSolution\GamificationBundle\Entity\TrophyType 
     */
    public function getTrophyType()
    {
        return $this->trophyType;
    }
    
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }
    
    
    
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
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
