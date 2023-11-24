<?php
/* connection */
$con = new mysqli('localhost', 'root', 'Password', 'dbname');
if (!$con) {
    die(mysqli_error($con));
}
/* insert */
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "insert into `crud` (name,email) value('$name','$email')"; /* crud table name */
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die(mysqli_error($con));
    }
}
/* delete */
if (isset($_POST['delete'])) {
    $idToDelete = $_POST['id'];
    $deleteSql = "delete from `crud` where sno = $idToDelete";
    $result = mysqli_query($con, $deleteSql);
    if (!$result) {
        die(mysqli_error($con));
    } else {
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpcrud</title>
</head>

<body>
    <div class="container">
        <form method="post" style="padding: 20px;">
            <div class="form-group" style="padding: 10px;">
                <label>Name</label>
                <input type="text" name="name" placeholder="enter name">
            </div>
            <div class="form-group" style="padding: 10px;">
                <label>email</label>
                <input type="text" name="email" placeholder="enter email">
            </div>
            <button type="submit" name="submit" style="margin-left: 60px;">submit</button>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>sno.</th>
                <th>name</th>
                <th>email</th>
                <th>operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select * from `crud`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $counter=1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['sno'];
                    $name = $row['name'];
                    $email = $row['email'];
                    echo '<tr>
                    <th>'.$counter.'</th>
                    <td>' . $name . '</td>
                    <td>' . $email . '</td>
                    <td style="display:flex;">
                    <button><a href="update.php?id='.$id.'">Update</a></button>
                    <form method="post" action="">
                        <input type="hidden" name="id" value="' . $id . '">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                    </td>
                    </tr>';
                    $counter++;
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>