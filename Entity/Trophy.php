<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophy
 *
 * @ORM\Table(name="gamification_trophy")
 * @ORM\Entity
 */
class Trophy /* implements \JsonSerializable */
{

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
     * @var integer
     *
     * @ORM\Column(name="level1", type="integer", nullable=false)
     */
    protected $level1;

    /**
     * @var integer
     *
     * @ORM\Column(name="level2", type="integer", nullable=false)
     */
    protected $level2;

    /**
     * @var integer
     *
     * @ORM\Column(name="level3", type="integer", nullable=false)
     */
    protected $level3;

    /**
     * @var integer
     *
     * @ORM\Column(name="level4", type="integer", nullable=false)
     */
    protected $level4;

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

    public function setLevel1($level1)
    {
        $this->level1 = $level1;

        return $this;
    }

    public function getLevel1()
    {
        return $this->level1;
    }

    public function setLevel2($level2)
    {
        $this->level2 = $level2;

        return $this;
    }

    public function getLevel2()
    {
        return $this->level2;
    }

    public function setLevel3($level3)
    {
        $this->level3 = $level3;

        return $this;
    }

    public function getLevel3()
    {
        return $this->level3;
    }

    public function setLevel4($level4)
    {
        $this->level4 = $level4;

        return $this;
    }

    public function getLevel4()
    {
        return $this->level4;
    }

    /**
     * __toString method
     *
     * return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }

}
