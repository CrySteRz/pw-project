<?php

declare(strict_types=1);

namespace App\Dtos;

/**
 * @OA\Schema(
 *     title="UserDTO",
 *     description="User entity",
 *     required={"id", "email", "name", "surname", "birthDate", "country", "state", "city", "address", "sex", "CNP", "roleId", "google_id"}
 * )
 */
final class UserData
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
    public ?int $id = null;

    /**
     * @OA\Property(
     *     description="The email address of the user",
     *     example="john.doe@example.com"
     * )
     *
     * @var string
     */
    public ?string $email = null;

      /**
     * @OA\Property(
     *     description="The first name of the user",
     *     example="John"
     * )
     *
     * @var string
     */
    public ?string $name = null;

     /**
     * @OA\Property(
     *     description="The last name of the user",
     *     example="Doe"
     * )
     *
     * @var string
     */
    public ?string $surname = null;

     /**
     * @OA\Property(
     *     description="The birth date of the user",
     *     example="1990-01-01"
     * )
     *
     * @var string
     */
    public ?string $birthDate = null;

    /**
     * @OA\Property(
     *     description="The country of the user",
     *     example="United States"
     * )
     *
     * @var string
     */
    public ?string $country = null;

    /**
     * @OA\Property(
     *     description="The state of the user",
     *     example="California"
     * )
     *
     * @var string
     */
    public ?string $state = null;

    /**
     * @OA\Property(
     *     description="The city of the user",
     *     example="Los Angeles"
     * )
     *
     * @var string
     */
    public ?string $city = null;

     /**
     * @OA\Property(
     *     description="The address of the user",
     *     example="123 Main Street"
     * )
     *
     * @var string
     */
    public ?string $address = null;

    /**
     * @OA\Property(
     *     description="The sex of the user",
     *     example=true
     * )
     *
     * @var bool
     */
    public ?bool $sex = null;

     /**
     * @OA\Property(
     *     description="The CNP (personal identification number) of the user",
     *     example="1234567890123"
     * )
     *
     * @var string
     */
    public ?string $CNP = null;

     /**
     * @OA\Property(
     *     format="int64",
     *     description="The role ID of the user",
     *     example=1
     * )
     *
     * @var int
     */
    public ?int $roleId = null;

     /**
     * @OA\Property(
     *     description="The google unique id of the user",
     *     example="7182471293561238974102742010457"
     * )
     *
     * @var string
     */
    public ?string $google_id = null;

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function getCNP(): ?string
    {
        return $this->CNP;
    }
    public function getGoogleId(): ?string
    {
        return $this->google_id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function updateEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function updateRoleId(?int $roleId): self
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function updateName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function updateSurname(?string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function updateBirthDate(?string $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function updateCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function updateState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function updateCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function updateAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function updateSex(?bool $sex): self
    {
        $this->sex = $sex;
        return $this;
    }

    public function updateCNP(?string $CNP): self
    {
        $this->CNP = $CNP;
        return $this;
    }

    public function updateGoogleId(?string $google_id): self
    {
        $this->google_id = $google_id;
        return $this;
    }
}