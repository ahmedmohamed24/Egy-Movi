<?php
//here is not the best bractice 
//this comment is written to test github
class dbConnection
{
    var $conn;
    function __construct()
    {
        $this->conn = mysqli_connect("localhost", "id13029806_root", "245502", "id13029806_movie");
        if (!$this->conn)
            die("Connection failed: " . mysqli_connect_error());
    }
    function connect($queryCommand)
    {
        $results = mysqli_query($this->conn, $queryCommand);
        if (mysqli_num_rows($results) > 0) {
            return $results;
        } else {
            return null;
        }
    }
    function inserting($queryCommand)
    {
        if (!mysqli_query($this->conn, $queryCommand)) {
            echo "Error: " . $queryCommand . "<br>" . mysqli_error($this->conn);
        } else {
            return true;
        }
    }
    function updating($queryCommand)
    {
        if (!mysqli_query($this->conn, $queryCommand)) {
            echo "Error: " . $queryCommand . "<br>" . mysqli_error($this->conn);
        } else {
            return true;
        }
    }
    function deleting($queryCommand)
    {
        if (!mysqli_query($this->conn, $queryCommand)) {
            echo "Error: " . $queryCommand . "<br>" . mysqli_error($this->conn);
        } else {
            return true;
        }
    }
    function deConnect()
    {
        mysqli_close($this->conn);
    }
}
