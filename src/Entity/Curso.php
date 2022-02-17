<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $abreviatura;

    #[ORM\Column(type: 'string', length: 255)]
    private $edicion;

    #[ORM\OneToMany(mappedBy: 'curso', targetEntity: User::class)]
    private $alumnos;

    public function __construct()
    {
        $this->alumnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAbreviatura(): ?string
    {
        return $this->abreviatura;
    }

    public function setAbreviatura(string $abreviatura): self
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    public function getEdicion(): ?string
    {
        return $this->edicion;
    }

    public function setEdicion(string $edicion): self
    {
        $this->edicion = $edicion;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(User $alumno): self
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos[] = $alumno;
            $alumno->setCurso($this);
        }

        return $this;
    }

    public function removeAlumno(User $alumno): self
    {
        if ($this->alumnos->removeElement($alumno)) {
            // set the owning side to null (unless already changed)
            if ($alumno->getCurso() === $this) {
                $alumno->setCurso(null);
            }
        }

        return $this;
    }
}
