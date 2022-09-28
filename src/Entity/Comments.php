<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text_Comments = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_Comments = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Comments_User = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $Comments_Article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextComments(): ?string
    {
        return $this->text_Comments;
    }

    public function setTextComments(string $text_Comments): self
    {
        $this->text_Comments = $text_Comments;

        return $this;
    }

    public function getDateComments(): ?\DateTimeInterface
    {
        return $this->date_Comments;
    }

    public function setDateComments(\DateTimeInterface $date_Comments): self
    {
      
        // dd($date_Comments);
        $this->date_Comments = $date_Comments;

        return $this;
    }

    public function getCommentsUser(): ?User
    {
        return $this->Comments_User;
    }

    public function setCommentsUser(?User $Comments_User): self
    {
        $this->Comments_User = $Comments_User;

        return $this;
    }

    public function getCommentsArticle(): ?Articles
    {
        return $this->Comments_Article;
    }

    public function setCommentsArticle(?Articles $Comments_Article): self
    {
        $this->Comments_Article = $Comments_Article;

        return $this;
    }
}
