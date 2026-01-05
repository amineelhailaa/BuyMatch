<?php


require_once __DIR__."/../classes/Match.php";
require_once __DIR__."/../classes/MatchSummary.php";
class MatchRepository
{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }


    public function getMatches():array {

        $query = "select * from list_match where status='validated'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function getMatcheById(int $id){
        $query = "select * from list_match where match_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return MatchSummary::fromRows($row);
        }



//        public function createMatch($id1,$id2,$banner,$date,$time,$lieu,$maxSeats,$myId){
        public function createMatch(MatchEvent $match){
        $query = "insert into matches(id_team1,id_team2,banner,match_date,match_hour,lieu,placesMax,status,organizer_id) values(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($match->getTeam1Id(),
            $match->getTeam2Id(),
            $match->getBanner(),
            $match->getDate(),
            $match->getTime(),
            $match->getLocation(),
            $match->getPlacesmax(),
            'in progress',
            $match->getOrganizerId()));
        return $this->pdo->lastInsertId();
        }

        public function updateMatchStatus($id,$status)
        {
            $query = "update matches set status = ? where id = ?";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute(array($status, $id));
        }


        public function eventCountByOrganizerId(int $id){
        $query = "select count(*) from matches where organizer_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count(*)'];
        }

        public function myMatches(int $id)
        {
            $query="select * from list_match where organizer_id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($id));
            $rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $matchesList =[];
            foreach ($rows as $row) {
                $matchSum =MatchSummary::fromRows($row);
                $matchesList[] = $matchSum;
            }
            return $matchesList;
        }

        public function pendingMatches()
        {
            $query="select * from list_match where status = 'in progress'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $matchesList =[];
            foreach ($rows as $row) {
                $matchSum =MatchSummary::fromRows($row);
                $matchesList[] = $matchSum;
            }
            return $matchesList;
        }

        public function getMatchesByStatus($status)
        {
            $query = "select * from list_match where status = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array($status));
            $rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $matchesList =[];
            foreach ($rows as $row) {
                $matchSum =MatchSummary::fromRows($row);
                $matchesList[] = $matchSum;
            }
            return $matchesList;
        }




}