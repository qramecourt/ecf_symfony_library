<?php

namespace App\Entity;

use App\Repository\BorrowerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowerRepository::class)]
class Borrower
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'borrowers')]
    private ?Loan $loan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLoan(): ?Loan
    {
        return $this->loan;
    }

    public function setLoan(?Loan $loan): self
    {
        $this->loan = $loan;

        return $this;
    }
}
