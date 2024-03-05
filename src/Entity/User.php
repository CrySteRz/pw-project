<?php

declare(strict_types=1);

namespace App\Entity;

final class User
{
    private int $id;
    private string $email;
    private string $name;
    private string $surname;
    private date $birthDate;
    private string $country;
    private string $state;
    private string $city;
    private string $address;
    private boolval $sex;
    private string $CNP;
    private int $roleId;

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getSex(): bool
    {
        return $this->sex;
    }

    public function getCNP(): string
    {
        return $this->CNP;
    }

    public function updateEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function updateRoleId(int $roleId): self
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function updateName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function updateSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function updateBirthDate(DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function updateCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function updateState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function updateCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function updateAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function updateSex(bool $sex): self
    {
        $this->sex = $sex;
        return $this;
    }

    public function updateCNP(string $CNP): self
    {
        $this->CNP = $CNP;
        return $this;
    }

  
}