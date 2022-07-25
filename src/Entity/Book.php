<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $author = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'books')]
    private Collection $genres;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Loan::class)]
    private Collection $loans;

    #[ORM\OneToMany(mappedBy: 'books', targetEntity: Editor::class)]
    private Collection $editor;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->loans = new ArrayCollection();
        $this->editor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
            $genre->addBook($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeBook($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Loan>
     */
    public function getLoans(): Collection
    {
        return $this->loans;
    }

    public function addLoan(Loan $loan): self
    {
        if (!$this->loans->contains($loan)) {
            $this->loans[] = $loan;
            $loan->setBook($this);
        }

        return $this;
    }

    public function removeLoan(Loan $loan): self
    {
        if ($this->loans->removeElement($loan)) {
            // set the owning side to null (unless already changed)
            if ($loan->getBook() === $this) {
                $loan->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Editor>
     */
    public function getEditor(): Collection
    {
        return $this->editor;
    }

    public function addEditor(Editor $editor): self
    {
        if (!$this->editor->contains($editor)) {
            $this->editor[] = $editor;
            $editor->setBooks($this);
        }

        return $this;
    }

    public function removeEditor(Editor $editor): self
    {
        if ($this->editor->removeElement($editor)) {
            // set the owning side to null (unless already changed)
            if ($editor->getBooks() === $this) {
                $editor->setBooks(null);
            }
        }

        return $this;
    }
}
