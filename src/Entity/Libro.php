<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
#[ApiResource(    
    attributes: ["pagination_items_per_page" => 20],
    collectionOperations: [
        'get' => [
            'method' => 'get',
            'normalization_context' => ['groups' => ['infoLibros']],
        ],
    ],
    itemOperations: [
        'get' => [
            'method' => 'get',
            'normalization_context' => ['groups' => ['infoLibroIndividual']],
        ],
    ],
)]
class Libro
{
    #[Groups(['infoLibros', 'infoLibroIndividual', 'anadirValoracion'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['infoLibros', 'infoLibroIndividual'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[Groups(['infoLibros', 'infoLibroIndividual'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $autor;

    #[Groups(['infoLibroIndividual'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'librosLeidos')]
    private $leidopor;

    #[ORM\OneToMany(mappedBy: 'libro', targetEntity: Comentario::class)]
    private $comentarios;

    #[Groups(['infoLibros', 'infoLibroIndividual'])]
    #[ORM\OneToMany(mappedBy: 'libro', targetEntity: Valoracion::class)]
    private $valoraciones;

    public function __construct()
    {
        $this->leidopor = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->valoraciones = new ArrayCollection();
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

    /**
     * @return Collection|Comentario[]
     */
    #[Groups(['infoLibroIndividual'])]
    #[SerializedName('comentarios')]
    public function getComentariosAprobados(): Collection
    {        
        return $this->comentarios->filter(
            function (Comentario $comentario)
            {
             return $comentario->getAprobado();   
            }
        );
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

    /**
     * @return Collection|Valoracion[]
     */
    public function getValoraciones(): Collection
    {
        return $this->valoraciones;
    }

    public function addValoracione(Valoracion $valoracione): self
    {
        if (!$this->valoraciones->contains($valoracione)) {
            $this->valoraciones[] = $valoracione;
            $valoracione->setLibro($this);
        }

        return $this;
    }

    public function removeValoracione(Valoracion $valoracione): self
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getLibro() === $this) {
                $valoracione->setLibro(null);
            }
        }

        return $this;
    }
}
