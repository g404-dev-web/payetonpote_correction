<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participant
 *
 * @ORM\Table(name="participant", indexes={@ORM\Index(name="fk_participant_campaign1_idx", columns={"campaign_id"})})
 * @ORM\Entity
 */
class Participant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=true, options={"default"="NULL"})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=true, options={"default"="NULL"})
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="isHidden", type="boolean", nullable=false)
     */
    private $ishidden = '0';

    /**
     * @var \Campaign
     *
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     * })
     */
    private $campaign;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIshidden(): ?bool
    {
        return $this->ishidden;
    }

    public function setIshidden(bool $ishidden): self
    {
        $this->ishidden = $ishidden;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }


}
