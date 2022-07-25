<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'loan', targetEntity: borrower::class)]
    private Collection $borrowers;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?book $book = null;

    public function __construct()
    {
        $this->borrowers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, borrower>
     */
    public function getBorrowers(): Collection
    {
        return $this->borrowers;
    }

    public function addBorrower(borrower $borrower): self
    {
        if (!$this->borrowers->contains($borrower)) {
            $this->borrowers[] = $borrower;
            $borrower->setLoan($this);
        }

        return $this;
    }

    public function removeBorrower(borrower $borrower): self
    {
        if ($this->borrowers->removeElement($borrower)) {
            // set the owning side to null (unless already changed)
            if ($borrower->getLoan() === $this) {
                $borrower->setLoan(null);
            }
        }

        return $this;
    }

    public function getBook(): ?book
    {
        return $this->book;
    }

    public function setBook(?book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
