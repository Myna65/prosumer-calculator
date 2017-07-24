<?php

namespace Myna65\ProsumerCalculator\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * City
 *
 * @Table(name="prosumer_city")
 * @Entity()
 */
class City {

    /**
     * @var int
     * @Id()
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Column(name="zip_code", type="string", length=8)
     */
    private $zipCode;

    /**
     * @var string
     * @Column(name="name", type="string")
     */
    private $name;

    /**
     * @var DNO
     * @ManyToOne(targetEntity="DNO", inversedBy="cities")
     * @JoinColumn(nullable=false)
     */
    private $dno;

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
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return City
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
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
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DNO
     */
    public function getDno()
    {
        return $this->dno;
    }

    /**
     * @param DNO $dno
     * @return City
     */
    public function setDno($dno)
    {
        $this->dno = $dno;
        return $this;
    }



}