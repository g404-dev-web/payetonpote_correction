<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity
 */
class Campaign
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=true, options={"default"="NULL"})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $content;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $updatedAt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="goal", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $goal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true, options={"default"="NULL"})
     */
    private $name;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(?int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }


}
