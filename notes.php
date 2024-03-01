<?php
// Create database connection
$connection = mysqli_connect('localhost', 'root', 'thisIsAPassword', 'registration');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handle note addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['note'])) {
    $note = filter_var($_POST['note'], FILTER_SANITIZE_SPECIAL_CHARS);
    $user_id = $_SESSION['user_id'];
    if (!empty($note)) {
        $sql = "INSERT INTO notes (userid, note) VALUES ('$user_id', '$note')";
        mysqli_query($connection, $sql);
    }
}

// Handle note editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit']) && isset($_POST['note_id']) && isset($_POST['edited_note'])) {
    $noteId = $_POST['note_id'];
    $editedNote = $_POST['edited_note'];
    $sql = "UPDATE notes SET note = ? WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("si", $editedNote, $noteId);
    $statement->execute();
    $statement->close();
}

// Handle note deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete']) && isset($_POST['note_id'])) {
    $noteId = $_POST['note_id'];
    $sql = "DELETE FROM notes WHERE id = ?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("i", $noteId);
    $statement->execute();
    $statement->close();
}

// Fetch notes
function fetchNotes() {
    global $connection;
    $user_notes = $_SESSION['user_id'];
    $sql = "SELECT id, note FROM notes WHERE userid=$user_notes";
    $result = $connection->query($sql);
    $notes = array();
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
    return $notes;
}

?>