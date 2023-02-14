<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM ;
use PhpParser\Node\Scalar\String_;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?int $phone = null;
    #[ORM\Column(length: 255)]
    private ?string $password = null;
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return int|null
     */
    public function getPhone(): ?int
    {
        return $this->phone;
    }
    public function getPassword() : ?string {
        return $this->password ;
    }

    public function setEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function setFirstName(): ?string
    {
        return $this->firstName;
    }
    public function setLastName(?string $lastname): ?string
    {
        return $this->lastName;
    }
  public function setPhone(?int $phone): ?int {
        return $this ->phone ;
  }
  public function setPassword(?string $password ): ?string{
        return $this ->password ;
  }

}