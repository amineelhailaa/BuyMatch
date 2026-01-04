<?php

class MatchEvent
{
    private $id;
    private $team1_id;
    private $team2_id;
    private $banner;
    private $date;
    private $time;
    private $location;
    private $placesmax;
    private $organizer_id;

    public function __construct(
        $team1_id,
        $team2_id,
        $banner,
        $date,
        $time,
        $location,
        $placesmax,
        $organizer_id,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->team1_id = $team1_id;
        $this->team2_id = $team2_id;
        $this->banner = $banner;
        $this->date = $date;
        $this->time = $time;
        $this->location = $location;
        $this->placesmax = $placesmax;
        $this->organizer_id = $organizer_id;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getTeam1Id()
    {
        return $this->team1_id;
    }

    public function getTeam2Id()
    {
        return $this->team2_id;
    }

    public function getBanner()
    {
        return $this->banner;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getPlacesmax()
    {
        return $this->placesmax;
    }

    public function getOrganizerId()
    {
        return $this->organizer_id;
    }

    // Setter (only for id)
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
