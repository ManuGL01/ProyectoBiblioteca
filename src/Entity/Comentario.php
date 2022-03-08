<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\ComentarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
#[ApiResource(
    collectionOperations: [        
        'post' => [
            'path' => 'comentarios',
            'denormalization_context' => ['groups' => ['anadirComentario']],
            'security' => 'is_granted("ROLE_USER")'
        ],
    ],
    itemOperations: [
        'get' => [
            'method' => 'get',
            'path' => 'comentarios/{id}',
        ],
    ],
)]
class Comentario
{
    #[Groups(['infoLibroIndividual'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['infoLibroIndividual', 'anadirComentario'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $comentario;

    #[Groups(['infoLibroIndividual', 'anadirComentario'])]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(nullable: false)]
    private $autor;

    #[Groups(['anadirComentario'])]
    #[ORM\ManyToOne(targetEntity: Libro::class, inversedBy: 'comentarios')]
    #[ORM\JoinColumn(nullable: false)]
    private $libro;

    #[ORM\Column(type: 'datetime')]
    private $fechaPublicacion;

    #[ORM\Column(type: 'boolean')]
    private $aprobado;

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

    public function getAprobado(): ?bool
    {
        return $this->aprobado;
    }
    
    public function setAprobado(bool $aprobado): self
    {
        $this->aprobado = $aprobado;
        
        return $this;
    }
    
    public function __construct()
    {
        $this->fechaPublicacion = new \DateTime();
        $this->aprobado = false;
    }
}
