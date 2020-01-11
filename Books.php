<?php
require_once "MongoPOO.php";

class Books extends MongoPOO {
    
    /**
     * Display every books
     */
    public function displayBooks($dbName, $collection, $filter = null) {
        $this->query = $this->initQuery($dbName, $collection, $filter);
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
        foreach ($this->query as $row) {
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
                $type = $row->fields->type_de_document;
            } else {
                $type = "";
            }
            
            echo "<tr>";
            echo "<td>" . $title ."</td>";
            echo "<td>" . $author ."</td>";
            echo "<td>" . $type ."</td>";
            echo "<td>
            <form action='index.php' method='post'>
                <input type='submit' name='$row->_id' value='Emprunter' />
            </form>
            </td>";
            echo "</tr>";
        }
        
        echo "</tbody>
        </table>";
    }

    /**
     * Display all books taken by the user
     */
    public function displayBooksTaken($dbName, $collection, $filter) {
        $books = $this->initQuery($dbName, $collection);

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

        foreach ($books as $row) {
            $users = $this->initQuery(MongoPOO::$dbName, MongoPOO::$collectionUsers, $filter);
            
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
                $type = $row->fields->type_de_document;
            } else {
                $type =  "";
            }
            
            foreach($users as $user) {
                foreach($user->books as $u) {

                    if($row->_id == $u) {

                        echo "<tr>";
                        echo "<td>" . $title ."</td>";
                        echo "<td>" . $author ."</td>";
                        echo "<td>" . $type ."</td>";
                        echo "<td><button>Rendre</button></td>";
                        echo "</tr>";
                    } 

                }
                
            }
        }    
        echo "</tbody>
        </table>";
    }

    /**
     * Add a book to the user
     */
    public function addBookToUser($dbName, $collection, $filter, $valueToAdd) {
        $this->updateDatas($dbName, $collection, $filter, $valueToAdd);
    }
}