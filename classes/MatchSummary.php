<?php

class MatchSummary
{
    public function __construct(
        private int $matchId,
        private string $date,      // e.g. 2026-01-04
        private string $time,      // e.g. 20:00
        private string $location,

        private string $team1Name,
        private ?string $team1Logo, // filename or null
        private string $team2Name,
        private ?string $team2Logo, // filename or null

        private ?string $status = null,  // pending/validated/rejected (optional)
        private ?string $banner = null    // optional if you display it
    ) {}

    public static function fromRows(array $row): self
    {
        return new self(
            $row['match_id'],
            $row['match_date'],
            $row['match_hour'],
            $row['lieu'],

            $row['team1_name'],
            $row['team1_logo'],
            $row['team2_name'],
            $row['team2_logo'],

            $row['status'],
            $row['banner']
        );
    }

    // --- getters (read-only) ---
    public function getMatchId(): int { return $this->matchId; }
    public function getDate(): string { return $this->date; }
    public function getTime(): string { return $this->time; }
    public function getLocation(): string { return $this->location; }

    public function getTeam1Name(): string { return $this->team1Name; }
    public function getTeam2Name(): string { return $this->team2Name; }

    public function getTeam1Logo(): ?string { return $this->team1Logo; }
    public function getTeam2Logo(): ?string { return $this->team2Logo; }

    public function getStatus(): ?string { return $this->status; }
    public function getBanner(): ?string { return $this->banner; }

}