<?php


namespace Myna65\ProsumerCalculator\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * DNO
 *
 * @Table(name="prosumer_dno")
 * @Entity()
 */
class DNO {

    /**
     * @var int
     * @Id()
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     * @Column(name="price", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="City", mappedBy="dno")
     */
    private $cities;

    public function __construct() {
        $this->cities = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DNO
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return DNO
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param ArrayCollection $cities
     * @return DNO
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
        return $this;
    }

    /**
     * @param City $city
     * @return DNO
     */
    public function addCity($city)
    {
        $this->cities->add($city);
        return $this;
    }




}