<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User entity",
 *     required={"id", "email", "name", "surname", "birthDate", "country", "state", "city", "address", "sex", "CNP", "roleId"}
 * )
 */
final class User
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="The unique identifier for the user",
     *     example=1
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     description="The email address of the user",
     *     example="john.doe@example.com"
     * )
     *
     * @var string
     */
    private string $email;

      /**
     * @OA\Property(
     *     description="The first name of the user",
     *     example="John"
     * )
     *
     * @var string
     */
    private string $name;

     /**
     * @OA\Property(
     *     description="The last name of the user",
     *     example="Doe"
     * )
     *
     * @var string
     */
    private string $surname;

     /**
     * @OA\Property(
     *     description="The birth date of the user",
     *     example="1990-01-01"
     * )
     *
     * @var string
     */
    private \DateTime $birthDate;

    /**
     * @OA\Property(
     *     description="The country of the user",
     *     example="United States"
     * )
     *
     * @var string
     */
    private string $country;

    /**
     * @OA\Property(
     *     description="The state of the user",
     *     example="California"
     * )
     *
     * @var string
     */
    private string $state;

    /**
     * @OA\Property(
     *     description="The city of the user",
     *     example="Los Angeles"
     * )
     *
     * @var string
     */
    private string $city;

     /**
     * @OA\Property(
     *     description="The address of the user",
     *     example="123 Main Street"
     * )
     *
     * @var string
     */
    private string $address;

    /**
     * @OA\Property(
     *     description="The sex of the user",
     *     example=true
     * )
     *
     * @var bool
     */
    private bool $sex;

     /**
     * @OA\Property(
     *     description="The CNP (personal identification number) of the user",
     *     example="1234567890123"
     * )
     *
     * @var string
     */
    private string $CNP;

     /**
     * @OA\Property(
     *     format="int64",
     *     description="The role ID of the user",
     *     example=1
     * )
     *
     * @var int
     */
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

    public function getBirthDate(): \DateTime
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

    public function updateBirthDate(\DateTime $birthDate): self
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