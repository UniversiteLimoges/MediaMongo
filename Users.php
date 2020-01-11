<?php
require_once "MongoPOO.php";

class Users extends MongoPOO {

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
            if(isset($row->name)) {
                $name = $row->name;
            } 
            
            if(isset($row->role)) {
                $role = $row->role;
            }
            $items[] = $name;
            if($_SERVER['REQUEST_METHOD'] === "POST" and isset($_POST)) {
                foreach($items as $item) {
                    var_dump($item);
                    if(array_key_exists($item, $_POST)) { 
                        
                        // var_dump($_POST);
                        // $this->deleteDatas(self::$dbName, self::$collectionUsers, [['name' => $name]] );

                        // $items[] = $name;
                    } else {
                        
                    }
                }

            } else {

            }
            // var_dump($items);

            echo "<tr>";
            echo "<td>" . $name ."</td>";
            echo "<td>" . $role ."</td>";
            echo "<td>
            <form action='listUsers.php' method='post'>
                <input type='submit' name='".$name."' value='Supprimer' />
            </form>
            </td>";
            echo "</tr>";

        }
    }
}