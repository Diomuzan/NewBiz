<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\OneToMany(mappedBy: 'osalary', targetEntity: Employee::class)]
    private Collection $obudget;

    public function __construct()
    {
        $this->obudget = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getObudget(): Collection
    {
        return $this->obudget;
    }

    public function addObudget(Employee $obudget): self
    {
        if (!$this->obudget->contains($obudget)) {
            $this->obudget->add($obudget);
            $obudget->setOsalary($this);
        }

        return $this;
    }

    public function removeObudget(Employee $obudget): self
    {
        if ($this->obudget->removeElement($obudget)) {
            // set the owning side to null (unless already changed)
            if ($obudget->getOsalary() === $this) {
                $obudget->setOsalary(null);
            }
        }

        return $this;
    }
}
