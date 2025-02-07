<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "season", indexes: [
    new ORM\Index(name: "IDX_F0E45BA95278319C", columns: ["series_id"])
])]
#[ORM\Entity]
class Season
{
    #[ORM\Column(name: "id", type: "integer", nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private $id;

    #[ORM\Column(name: "number", type: "integer", nullable: false)]
    private $number;

    #[ORM\ManyToOne(targetEntity: "Series", inversedBy: "season")]
    #[ORM\JoinColumn(name: "series_id", referencedColumnName: "id", nullable: false)]
    
    private $series;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getSeries(): ?Series
    {
        return $this->series;
    }

    public function setSeries(?Series $series): self
    {
        $this->series = $series;

        return $this;
    }
}
