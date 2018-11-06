<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkRepository")
 */
class Link
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $hashed_link;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $original_link;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getHashedLink(): ?string
    {
        return $this->hashed_link;
    }

    /**
     * @param string $hashed_link
     * @return Link
     */
    public function setHashedLink(string $hashed_link): self
    {
        $this->hashed_link = $hashed_link;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOriginalLink(): ?string
    {
        return $this->original_link;
    }

    /**
     * @param string $original_link
     * @return Link
     */
    public function setOriginalLink(string $original_link): self
    {
        $this->original_link = $original_link;

        return $this;
    }
}
