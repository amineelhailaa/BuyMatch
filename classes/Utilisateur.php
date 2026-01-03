<?php

namespace classes;

abstract class Utilisateur
{
private ?int $id;
private string $name;
private string $email;
private  string $password_hash;
private string $phone;
private string $status;
private string $pic;

public function __construct($name, $email, $password_hash, $phone, $status, $pic,?int $id = null)
{
    $this->name = $name;
    $this->email = $email;
    $this->password_hash = $password_hash;
    $this->phone = $phone;
    $this->status = $status;
    $this->pic = $pic;
    $this->id = $id;
}

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): void
    {
        $this->password_hash = $password_hash;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }




    public function setPic(string $pic): void
    {
        $this->pic = $pic;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    abstract public function getRole();
abstract public function dashboardPath();

    public function getPic(): string
    {
        return $this->pic;
    }

}