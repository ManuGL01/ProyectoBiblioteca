<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['infoLibros'])]
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 9)]
    private $DNI;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\ManyToOne(targetEntity: Curso::class, inversedBy: 'alumnos', )]
    #[ORM\JoinColumn(nullable: false)]
    private $curso;

    #[ORM\ManyToMany(targetEntity: Libro::class, inversedBy: 'leidopor')]
    private $librosLeidos;

    #[ORM\OneToMany(mappedBy: 'autor', targetEntity: Comentario::class)]
    private $comentarios;

    #[ORM\OneToMany(mappedBy: 'autor', targetEntity: Valoracion::class)]
    private $valoraciones;

    public function __construct()
    {
        $this->librosLeidos = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->valoraciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): self
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    public function setCurso(?Curso $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * @return Collection|Libro[]
     */
    public function getLibrosLeidos(): Collection
    {
        return $this->librosLeidos;
    }

    public function addLibrosLeido(Libro $librosLeido): self
    {
        if (!$this->librosLeidos->contains($librosLeido)) {
            $this->librosLeidos[] = $librosLeido;
        }

        return $this;
    }

    public function removeLibrosLeido(Libro $librosLeido): self
    {
        $this->librosLeidos->removeElement($librosLeido);

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
            $comentario->setAutor($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getAutor() === $this) {
                $comentario->setAutor(null);
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
            $valoracione->setAutor($this);
        }

        return $this;
    }

    public function removeValoracione(Valoracion $valoracione): self
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getAutor() === $this) {
                $valoracione->setAutor(null);
            }
        }

        return $this;
    }
}
