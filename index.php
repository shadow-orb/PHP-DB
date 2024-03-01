<?php include('server.php'); 
    include('notes.php');
if(empty($_SESSION['username']))
{
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <div>
    <h2>Home Page</h2>
    </div>
        <?php if(isset($_SESSION['username'])): ?>
            <p>Welcome <strong><?php echo $_SESSION['username'] ?></strong></p>
            <p><a href="index.php?logout='1'">Logout</a></p>
        <?php endif ?>
        <div>
        <h2>Add Note</h2>
    <form action="" method="post">
        <input type="text" name="note" placeholder="Enter your note" required>
        <button type="submit">Add Note</button>
    </form>
    <h2>Notes</h2>
    <?php $notes = fetchNotes(); ?>
    <ul>
        <?php foreach ($notes as $note): ?>
            <li>
                <span class="note-text"><?php echo $note['note']; ?></span>
                <form action="" method="post" style="display: inline;">
                    <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                    <button type="button" class="edit-btn">Edit</button>
                    <button type="submit" name="delete">Delete</button>
                </form>
                <form action="" method="post" class="edit-field" style="display: none;">
                    <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                    <input type="text" name="edited_note" value="<?php echo $note['note']; ?>" required>
                    <button type="submit" name="edit">Save</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        const editBtns = document.querySelectorAll('.edit-btn');
        editBtns.forEach(editBtn => {
            editBtn.addEventListener('click', function() {
                const listItem = this.parentNode.parentNode;
                const editField = listItem.querySelector('.edit-field');
                const noteText = listItem.querySelector('.note-text');

                if (editField.style.display === 'none') {
                    editField.style.display = 'inline';
                    noteText.style.display = 'none';
                    this.textContent = 'Cancel';
                } else {
                    editField.style.display = 'none';
                    noteText.style.display = 'inline';
                    this.textContent = 'Edit';
                }
            });
        });
    </script>
</body>
</html>