<?php

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'db_connect.php';
        // connecting to database
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
       $db = new DB_Connect();
       $db->close();
    }

    // Create a new contact
    public function createContact($name, $email, $phone) {
        $stmt = $this->conn->prepare("INSERT INTO contacts(name, email, phone) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $phone);

        $result = $stmt->execute();

        $stmt->close();

        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE name = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $contact = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $contact;
        } else {
            return false;
        }
    }

    // Get contact by ID
    public function getContactById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $contact = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $contact;
        } else {
            return NULL;
        }
    }

    // Get all contacts
    public function getAllContacts() {
        $result = $this->conn->query("SELECT * FROM contacts");
        $contacts = array();

        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        return $contacts;
    }

    // Update contact
    public function updateContact($id, $name, $email, $phone) {
        $stmt = $this->conn->prepare("UPDATE contacts SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $phone, $id);

        $result = $stmt->execute();

        $stmt->close();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Delete contact
    public function deleteContact($id) {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

?>