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
    private function initQuery($dbName, $collection, $filter) {
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
            } else {
                $author = "";
            }
            if (isset($row->fields->type_de_document)) {
                $type =  $row->fields->type_de_document;
            } else {
                $type =  "";
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

    public function displayUsers($dbName, $collectionSpells, $filter = null) {
        $query = $this->initQuery($dbName, $collectionSpells, $filter);
        echo "<table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Suppression</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($query as $key => $row) {
            // echo "<pre>";
            // var_dump($row);
            // var_dump($key, $row->name);
            if(isset($row->name)) {
                $name = $row->name;
            } 
            
            if(isset($row->role)) {
                $role = $row->role;
            }
            
            echo "<tr>";
            echo "<td>" . $name ."</td>";
            echo "<td>" . $role ."</td>";
            echo "<td>
            <form action='' method='post'>
                <input type='submit' name='".$name."' value='Supprimer' />
            </form>
            </td>";
            echo "</tr>";

            $items[] = $name;
        }
        
        // if($_SERVER['REQUEST_METHOD'] === "POST" and isset($_POST)){
        //     foreach($items as $item) {
                // if($item == array_keys($_POST)) { 
                    // echo "ya";
                    //     unset($Array[$k]); 
                    // $this->deleteDatas(self::$dbName, self::$collectionUsers, [['name' => $name]] );
                // } else {
                //     var_dump($item);
                    // var_dump(array_keys($_POST));
                    
                }
                // var_dump($item);
            }
            // var_dump($_POST);

            //     if($val == "GeeksForGeeks_3") { 
            //         unset($Array[$k]); 
            //     } 
            // $this->deleteDatas(self::$dbName, self::$collectionUsers, [['name' => $name]] );
        }
        // var_dump($items);

        
        
    }
}