<?php

class MongoPOO {
    private $manager;
    private $query;
    private $bulk;

    public static $dsn = "mongodb://localhost:27017";
    public static $dbName = "MediaMongo";
    public static $collectionBooks = "livres";
    public static $collectionUsers = "users";

    /**
     * Initialise le manager
     */
    function __construct($dsn) {
        $this->manager = new MongoDB\Driver\Manager($dsn);
    }

    /**
     * Récupère le manager
     * @return $manager
     */
    private function getManager() {
        return $this->manager;
    }

    /**
     * Get the query
     * @return $query
     */
    private function getQuery() {
        return $this->query;
    }

    /**
     * Get the id of the object
     */
    public function getMongoDbObjectId($instance, $dbName, $collection, $filter = null) {
        $this->query = $instance->initQuery($dbName, $collection, $filter);

        foreach($this->query as $row) {
            $id = $row->_id;
        }

        return $id;
    }
    
    /**
     * Requête avec ou sans filtre
     * @return $query
     */
    public function initQuery($dbName, $collection, $filter = null) {
        if($filter === null) {
            $this->query = new MongoDB\Driver\Query([]);
        } else {
            $this->query = new MongoDB\Driver\Query($filter);
        }

        $this->query = $this->getManager()->executeQuery($dbName . "." . $collection, $this->getQuery());

        return $this->getQuery();
    }

    public function initCommand($collection, $filter = null) {
        $command = $this->getManager()->executeCommand($collection, $filter);

        return $command;
    }

    /**
     * Ajout des données à une collection
     */
    public function addDatas($dbName, $collection, $datasToAdd) {
        $this->bulk = new MongoDB\Driver\BulkWrite;

        foreach($datasToAdd as $row) {
            $this->bulk->insert($row);
        }

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    /**
     * Met à jour des données d'une collection
     */
    public function updateDatas($dbName, $collection, $filter, $datasToUpdate) {
        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->bulk->update($filter, $datasToUpdate);

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    /**
     * Supprime des données d'une collection
     */
    public function deleteDatas($dbName, $collection, $datasToDelete) {
        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->manager = $this->getManager();

        // $this->bulk->delete(['name' => "Poke"], ['limit' => 1]);
        foreach($datasToDelete as $data) {
            $this->bulk->delete($data);
        }
        
        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    /**
     * Efface une collection
     */
    public function deleteCollection($dbName, $collection) {
        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->manager = $this->getManager();

        $this->bulk->delete([]);
        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    // public function displaySpells($dbName, $collectionSpells, $filter = null) {
    //     $query = $this->initQuery($dbName, $collectionSpells, $filter);

    //     echo'Level 1 spell list:<br/>';
    //     foreach ($query as $row) {
    //         echo 'Spell name: ' . $row->name . "<br>";
    //         echo 'Spell level: ' . $row->level . "<br>";

    //         if(isset($row->flavor)) {
    //             echo " (Flavor: " . $row->flavor . ")<br>";
    //         }
    //     }
    // }
}