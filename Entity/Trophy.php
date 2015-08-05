<?php

namespace TMSolution\GamificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophy
 *
 * @ORM\Table(name="trophy")
 * @ORM\Entity
 */
class Trophy implements \JsonSerializable {

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
     * @ORM\ManyToOne(targetEntity="TMSolution\GamificationBundle\Entity\Trophycategory", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trophycategoryid", referencedColumnName="id")
     * })
     */
    protected $trophycategoryid;

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
     * Set trophycategoryid
     *
     * @param \TMSolution\GamificationBundle\Entity\Trophycategory $trophycategoryid
     * @return Trophy
     */
    public function setTrophycategoryid(\TMSolution\GamificationBundle\Entity\Trophycategory $trophycategoryid = null) {
        $this->trophycategoryid = $trophycategoryid;

        return $this;
    }

    /**
     * Get trophycategoryid
     *
     * @return \TMSolution\GamificationBundle\Entity\Trophycategory 
     */
    public function getTrophycategoryid() {
        return $this->trophycategoryid;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'trophycategoryid' => $this->getTrophycategoryid()
        ];
    }

}
