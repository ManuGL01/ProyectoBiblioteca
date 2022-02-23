<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[Groups(['infoLibros'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['infoLibros'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[Groups(['infoLibros'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $autor;

    #[Groups(['infoLibros'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'librosLeidos')]
    private $leidopor;

    #[Groups(['infoLibros'])]
    #[ORM\OneToMany(mappedBy: 'libro', targetEntity: Comentario::class)]
    private $comentarios;

    public function __construct()
    {
        $this->leidopor = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getLeidopor(): Collection
    {
        return $this->leidopor;
    }

    public function addLeidopor(User $leidopor): self
    {
        if (!$this->leidopor->contains($leidopor)) {
            $this->leidopor[] = $leidopor;
            $leidopor->addLibrosLeido($this);
        }

        return $this;
    }

    public function removeLeidopor(User $leidopor): self
    {
        if ($this->leidopor->removeElement($leidopor)) {
            $leidopor->removeLibrosLeido($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setLibro($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getLibro() === $this) {
                $comentario->setLibro(null);
            }
        }

        return $this;
    }
}
