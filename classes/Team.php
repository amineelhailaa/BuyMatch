<?php

class Team
{
        private ?int $id;
        private string $name;
        private string $logo;

        public function __construct( string $name, string $logo, ?int $id = null){
            $this->id = $id;
            $this->name = $name;
            $this->logo = $logo;
        }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}