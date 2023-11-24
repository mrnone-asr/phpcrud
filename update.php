<?php
/* connection */
$con = new mysqli('localhost', 'root', 'Password', 'dbname');
if (!$con) {
    die(mysqli_error($con));
}
$idToUpdate = $_GET['id'];
$sql = "select * from `crud` where sno = $idToUpdate";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['sno'];
$name = $row['name'];
$email = $row['email'];

/* update */
if (isset($_POST['update'])) {
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];

    $updateSql = "UPDATE `crud` SET name = '$newName', email = '$newEmail' WHERE sno = $idToUpdate";
    $updateResult = mysqli_query($con, $updateSql);

    if ($updateResult) {
        header('location:main.php');
    }else{
        echo "Error updating record: " . mysqli_error($con);
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
                <input type="text" name="new_name" value="<?php echo $name ?>">
            </div>
            <div class="form-group" style="padding: 10px;">
                <label>email</label>
                <input type="text" name="new_email" value="<?php echo $email ?>">
            </div>
            <button type="submit" name="update" style="margin-left: 60px;">update</button>
        </form>
    </div>
</body>

</html>