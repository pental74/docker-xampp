<?php

require_once 'db_functions.php';
$db = new DB_Functions();

// Allow cross-origin requests (VERY IMPORTANT for testing on localhost)
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

// Fix Deprecated trim() warning
//$pathInfo = $_SERVER['PATH_INFO'] ?? '';
//var_dump($pathInfo);
//exit;
//$request = explode('/', trim($pathInfo,'/'));

// Handle the request
switch ($method) {
  case 'GET':
    if (isset($request[0]) && is_numeric($request[0])) {
      // Get a single contact by ID
      $contact = $db->getContactById($request[0]);
      if ($contact) {
        echo json_encode($contact);
      } else {
        http_response_code(404); // Not Found
        echo json_encode(array("message" => "Contact not found."));
      }
    } else {
      // Get all contacts
      $contacts = $db->getAllContacts();
      echo json_encode($contacts);
    }
    break;
  case 'POST':
    // Create a new contact
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['name']) && isset($data['email']) && isset($data['phone'])) {
      $contact = $db->createContact($data['name'], $data['email'], $data['phone']);
      if ($contact) {
        http_response_code(201); // Created
        echo json_encode($contact);
      } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(array("message" => "Unable to create contact."));
      }
    } else {
      http_response_code(400); // Bad Request
      echo json_encode(array("message" => "Missing required fields."));
    }
    break;
  case 'PUT':
    // Update an existing contact
    if (isset($request[0]) && is_numeric($request[0])) {
      $data = json_decode(file_get_contents('php://input'), true);
      if (isset($data['name']) && isset($data['email']) && isset($data['phone'])) {
        $result = $db->updateContact($request[0], $data['name'], $data['email'], $data['phone']);
        if ($result) {
          echo json_encode(array("message" => "Contact updated successfully."));
        } else {
          http_response_code(500); // Internal Server Error
          echo json_encode(array("message" => "Unable to update contact."));
        }
      } else {
        http_response_code(400); // Bad Request
        echo json_encode(array("message" => "Missing required fields."));
      }
    } else {
      http_response_code(400); // Bad Request
      echo json_encode(array("message" => "Missing contact ID."));
    }
    break;
  case 'DELETE':
    // Delete a contact
    if (isset($request[0]) && is_numeric($request[0])) {
      $result = $db->deleteContact($request[0]);
      if ($result) {
        echo json_encode(array("message" => "Contact deleted successfully."));
      } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(array("message" => "Unable to delete contact."));
      }
    } else {
      http_response_code(400); // Bad Request
      echo json_encode(array("message" => "Missing contact ID."));
    }
    break;
  default:
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Method not allowed."));
    break;
}
?>