<?php

namespace App\Entity;

use App\Repository\EditorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditorRepository::class)]
class Editor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\OneToMany(inversedBy: 'editor')]
    #[ORM\JoinColumn(nullable: false)]
    private ?book $books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooks(): ?book
    {
        return $this->books;
    }

    public function setBooks(?book $books): self
    {
        $this->books = $books;

        return $this;
    }
}
