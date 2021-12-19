<?php 

require_once 'Database.php';

class Contender {

    public $rating = 1500;
    public $wins   = 0;
    public $losses = 0;


    /**
     * Method for creating new contender.
     */
    public function create() {
        
        global $db;

        $sql  = "INSERT INTO contenders (name, image, rating, wins, losses)";
        $sql .= " VALUES (:name, :image, :rating, :wins, :losses);";
 
        $sth = $db->connection->prepare($sql);
        $sth->bindParam(':name', $this->name);
        $sth->bindParam('image', $this->image);
        $sth->bindParam(':rating', $this->rating);
        $sth->bindParam(':wins', $this->wins);
        $sth->bindParam(':losses', $this->losses);

        $sth->execute();
    }

    /**
     * @return array
     */
    public function getRandomContenders() {

        global $db;

        $sql  = "SELECT * FROM contenders ORDER BY RAND() LIMIT 2";
        $sth = $db->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        $contenders = [];

        foreach($result as $record) {
            $contenders[] = $this->instantiate($record);
        }

        return $contenders;
    }

    /**
     * @param $id
     * @return Contender|null
     */
    public static function findById($id) {

        global $db;

        $sql  = "SELECT * FROM contenders WHERE id = {$id}";
        $sth = $db->connection->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 1) {
            $contender = new self;
            return $contender->instantiate($result[0]);
        } else {
            return null;
        }
    }

    public function save() {

        global $db;

        $sql = "UPDATE contenders SET ";

        $properties = array_keys(get_object_vars($this));
        $updatePairs = [];

        foreach ($properties as $property) {
            $updatePairs[] = $property . ' = ' . "\"{$this->$property}\"";
        }

        $sql .= join(',', $updatePairs);
        $sql .= " WHERE id = {$this->id};";

        $sth = $db->connection->prepare($sql);
        $sth->execute();

    }



    /**
     * @param $record
     * @return Contender
     */
    private function instantiate($record) {

        $contender = new self;
        $properties = array_keys($record);

        foreach($properties as $property) {
            $contender->$property = $record[$property];
        }

        return $contender;

    }

    

}