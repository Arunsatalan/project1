<?php

use mishaf\DBConnector;

require_once 'DBConnector.php';

class ChildrenFetcher
{
    public function fetchChildren()
    {
        $db = new DBConnector();
        $con = $db->getConnection();

        $sql = "SELECT c.id as childID, CONCAT(c.firstname, ' ', c.lastname) as childName, u.id as parentID, u.phone_no as parentPhone
                FROM Children c
                JOIN Users u ON c.parent_id = u.id";

        $result = $con->query($sql);

        $children = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $children[] = $row;
            }
        }

        $db->closeConnection($con);

        return $children;
    }
}

$fetcher = new ChildrenFetcher();
echo json_encode($fetcher->fetchChildren());
?>
