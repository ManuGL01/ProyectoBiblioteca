<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

use App\Repository\ComentarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentario
{
    #[Groups(['infoLibros'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['infoLibros'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $comentario;

    #[Groups(['infoLibros'])]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(nullable: false)]
    private $autor;

    #[ORM\ManyToOne(targetEntity: Libro::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(nullable: false)]
    private $libro;

    #[Groups(['infoLibros'])]
    #[ORM\Column(type: 'datetime')]
    private $fechaPublicacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

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

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fechaPublicacion): self
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }
}
