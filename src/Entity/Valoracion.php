<?php

namespace App\Entity;

use App\Repository\ValoracionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ValoracionRepository::class)]
class Valoracion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $puntuacion;

    #[ORM\Column(type: 'datetime')]
    private $fechaPublicacion;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'valoraciones')]
    private $autor;

    #[ORM\ManyToOne(targetEntity: Libro::class, inversedBy: 'valoraciones')]
    private $libro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuntuacion(): ?float
    {
        return $this->puntuacion;
    }

    public function setPuntuacion(float $puntuacion): self
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fechaPublicacion): self
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getLibro(): ?Libro
    {
        return $this->libro;
    }

    public function setLibro(?Libro $libro): self
    {
        $this->libro = $libro;

        return $this;
    }
}
