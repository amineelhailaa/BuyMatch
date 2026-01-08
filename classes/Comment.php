<?php

class Comment
{
    private ?int $id;
    private int $user_id;
    private int $id_match;
    private string $comment;
    private ?DateTime $date;
    public function __construct($user_id, $id_match, $comment, $date=null,?int $id = null){
        $this->user_id = $user_id;
        $this->id_match = $id_match;
        $this->comment = $comment;
        $this->date = $date;
        $this->id = $id;
    }
    public function getId(): ?int { return $this->id; }
    public function getUserId(): ?int { return $this->user_id; }
    public function getIdMatch(): ?int { return $this->id_match; }
    public function getComment(): ?string { return $this->comment; }
    public function getDate(): ?DateTime { return $this->date; }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

}