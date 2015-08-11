<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophy
 *
 * @ORM\Table(name="trophy")
 * @ORM\Entity
 */
class Trophy /*implements \JsonSerializable*/ {

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
     * @var \TMSolution\GamificationBundle\Entity\Trophycategory
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophycategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophycategory", referencedColumnName="id")
     * })
     */
    protected $trophycategory;

    /**
     * @var \TMSolution\GamificationBundle\Entity\Trophytype
     *
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophytype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophytype", referencedColumnName="id")
     * })
     */
    protected $trophytype;

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
     * @return Trophy
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
     * Set image
     *
     * @param string $image
     * @return Trophy
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set trophycategory
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophycategory $trophycategory
     * @return Trophy
     */
    public function setTrophycategory(\TMSolution\GamificationBundle\Entity\Trophycategory $trophycategory = null) {
        $this->trophycategory = $trophycategory;

        return $this;
    }

    /**
     * Get trophycategory
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophycategory 
     */
    public function getTrophycategory() {
        return $this->trophycategory;
    }

    /**
     * Set trophytype
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophytype $trophytype
     * @return Trophy
     */
    public function setTrophytype(\TMSolution\GamificationBundle\Entity\Trophycategory $trophytype = null) {
        $this->trophytype = $trophytype;

        return $this;
    }

    /**
     * Get trophytype
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophytype
     */
    public function getTrophytype() {
        return $this->trophytype;
    }

   /* public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'trophycategory' => $this->getTrophycategory()
        ];
    }*/

}
