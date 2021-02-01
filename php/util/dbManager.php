<?php
    require "dbConfig.php";
    $DB = new dbManager(); // creates a new istance of Database Class

  class dbManager {
      private $mysqli_conn = null;

      function dbManager() {
        $this->openConnection();
      }
    //Opens a new connection to the database
      function openConnection() {
      if (!$this->isOpen()){
        global $dbHostname;
        global $dbUsername;
        global $dbPassword;
        global $dbName;

            $this->mysqli_conn = new mysqli($dbHostname, $dbUsername, $dbPassword);
          if ($this->mysqli_conn->connect_error)
             die('Connect Error (' . $this->mysqli_conn->connect_errno . ') ' . $this->mysqli_conn->connect_error);
            $this->mysqli_conn->select_db($dbName) or die ('Connection to DB failed: ' . mysqli_error());
        }
      }

    //Checks if the connection to the database is open
      function isOpen() {
      return ($this->mysqli_conn != null);
    }

    //Executes a query and returns the result
    function performQuery($queryText) {
      if (!$this->isOpen())
        $this->openConnection();

      return $this->mysqli_conn->query($queryText);
    }

    function performPrepare($queryText) {
      if (!$this->isOpen())
        $this->openConnection();

      return $this->mysqli_conn->prepare($queryText);
    }

    function sqlInjectionFilter($parameter) {
      if(!$this->isOpen())
        $this->openConnection();

      return $this->mysqli_conn->real_escape_string($parameter);
    }

    //Closes the connection
    function closeConnection(){
      if($this->mysqli_conn !== null)
        $this->mysqli_conn->close();

      $this->mysqli_conn = null;
    }
  }
?>