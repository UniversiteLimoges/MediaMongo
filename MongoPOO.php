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
     * Récupère la requête
     * @return $query
     */
    private function getQuery() {
        return $this->query;
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

    /**
     * Ajout des données à une collection
     */
    public function addDatas($dbName, $collection, $valuesToAdd) {
        $this->bulk = new MongoDB\Driver\BulkWrite;

        foreach($valuesToAdd as $row) {
            $this->bulk->insert($row);
        }

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    /**
     * Met à jour des données d'une collection
     */
    public function updateDatas($dbName, $collection, $valuesToUpdate) {
        $this->bulk = new MongoDB\Driver\BulkWrite;

        foreach($valuesToUpdate as $row) {
            $this->bulk->update($row[0], $row[1]);
        }

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    /**
     * Supprime des données d'une collection
     */
    public function deleteDatas($dbName, $collection, $datasToDelete) {
        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->manager = $this->getManager();

        // $bulk->delete(['name' => "Poke"], ['limit' => 1]);
        // $this->bulk->delete(['name' => "Poke"]);
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
}