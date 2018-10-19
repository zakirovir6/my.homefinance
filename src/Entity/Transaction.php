<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="smallint")
     */
    private $direction;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\TransactionFile",
     *      mappedBy="transaction",
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     */
    private $transactionFiles;

    public function __construct()
    {
        $this->transactionFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getDirection(): int
    {
        return $this->direction;
    }

    public function setDirection(int $direction): void 
    {
        $this->direction = $direction;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return Collection|TransactionFile[]
     */
    public function getTransactionFiles(): Collection
    {
        return $this->transactionFiles;
    }

    public function addTransactionFile(TransactionFile $transactionFile): self
    {
        if (!$this->transactionFiles->contains($transactionFile)) {
            $this->transactionFiles[] = $transactionFile;
            $transactionFile->setTransaction($this);
        }

        return $this;
    }

    public function removeTransactionFile(TransactionFile $transactionFile): self
    {
        if ($this->transactionFiles->contains($transactionFile)) {
            $this->transactionFiles->removeElement($transactionFile);
            // set the owning side to null (unless already changed)
            if ($transactionFile->getTransaction() === $this) {
                $transactionFile->setTransaction(null);
            }
        }

        return $this;
    }
}
