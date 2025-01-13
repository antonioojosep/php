<?php
class Company {
    private string $nif;
    private string $name;
    private string $address;
    private string $tutor;
    private string $telepone;
    private string $email;

    public function __construct(string $nif, string $name, string $address, string $tutor, string $telepone, string $email) {
        $this->nif = $nif;
        $this->name = $name;
        $this->address = $address;
        $this->tutor = $tutor;
        $this->telepone = $telepone;
        $this->email = $email;
    }

    public function getNif(): string {
        return $this->nif;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getTutor(): string {
        return $this->tutor;
    }

    public function getTelephone(): int {
        return $this->telepone;
    }

    public function getEmail(): string {
        return $this->email;
    }
}