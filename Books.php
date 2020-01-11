<?php
require_once "MongoPOO.php";

class Books extends MongoPOO {

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

    public function displayBooksTaken($dbName, $collectionSpells, $filter = null) {
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
            echo "<td><button>Rendre</button></td>";
            echo "</tr>";
        }
        
        echo "</tbody>
        </table>";
    }
}