<?php
class MongoPOO {
    private $manager;
    private $query;
    private $dsn;
    private $bulk;

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
    private function initQuery($dbName, $collection, $filter) {
        if($filter === null) {
            $this->query = new MongoDB\Driver\Query([]);
        } else {
            $this->query = new MongoDB\Driver\Query($filter);
        }

        $this->query = $this->getManager()->executeQuery($dbName . "." . $collection, $this->getQuery());

        return $this->getQuery();
    }

    public function addDatas($dbName, $collection, $valuesToAdd) {
        $this->bulk = new MongoDB\Driver\BulkWrite;

        foreach($valuesToAdd as $row) {
            $this->bulk->insert($row);
        }

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    public function updateDatas($dbName, $collection, $valuesToUpdate) {
        $this->bulk = new MongoDB\Driver\BulkWrite;

        foreach($valuesToUpdate as $row) {
            $this->bulk->update($row[0], $row[1]);
        }

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    public function deleteDatas($dbName, $collection) {
        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->manager = $this->getManager();

        // $bulk->delete(['name' => "Poke"], ['limit' => 1]);
        $this->bulk->delete(['name' => "Poke"]);
        $this->bulk->delete(['name' => "Zap"]);
        $this->bulk->delete(['name' => "Blast"]);

        $this->manager->executeBulkWrite($dbName . "." . $collection, $this->bulk);
    }

    public function displayBooks($dbName, $collectionSpells, $filter = null) {
        $query = $this->initQuery($dbName, $collectionSpells, $filter);
        echo "<table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($query as $row) {
            if(isset($row->fields->titre_avec_lien_vers_le_catalogue)) {
                $title = $row->fields->titre_avec_lien_vers_le_catalogue;
            } else {
                $title = "";
            }
            if(isset($row->fields->auteur)) {
                $author = $row->fields->auteur;
            }
            if (isset($row->fields->type_de_document)) {
                $type =  $row->fields->type_de_document;
            }
            
            echo "<tr>";
            echo "<td>" . $title ."</td>";
            echo "<td>" . $author ."</td>";
            echo "<td>" . $type ."</td>";
            echo "<td><button>Emprunter</button></td>";
            echo "</tr>";
        }
        
        echo "</tbody>
        </table>";
    
    }

    public function displaySpells($dbName, $collectionSpells, $filter = null) {
        $query = $this->initQuery($dbName, $collectionSpells, $filter);

        echo'Level 1 spell list:<br/>';
        foreach ($query as $row) {
            echo 'Spell name: ' . $row->name . "<br>";
            echo 'Spell level: ' . $row->level . "<br>";

            if(isset($row->flavor)) {
                echo " (Flavor: " . $row->flavor . ")<br>";
            }
        }
    }
}