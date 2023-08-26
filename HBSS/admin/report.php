<?php
ob_start();
global $conn;
include'header.php';
SESSION_START();

if(isset($_SESSION['auth']))
{
    if($_SESSION['auth']!=1)
    {
        header("location:login.php");
    }
}
else
{
    header("location:login.php");
}
include'lib/connection.php';
$inserted=null;
$inserted2=null;
if (isset($_POST['submit']))
{
    $created_at=$_POST['created_at'];

    $sql = "SELECT * FROM posts where created_at>='$created_at'";
    $result = $conn -> query ($sql);

}

$query = "SELECT *
          FROM posts
          INNER JOIN users ON users.users_id=posts.post_userid";
$result2 = $conn->query($query);
$query2="SELECT users_username
          FROM users
          INNER JOIN report ON report.users_user_name=users.users_username";
$result3 = $conn->query($query2);




if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `posts` WHERE post_id = '$remove_id'");
    header('location: report.php');
};

if (isset($_GET["users_id"])) {
    $useridToBlock = $_GET["users_id"];


    $sql = "UPDATE users SET user_status = 'blocked' WHERE users_id = '$useridToBlock'";
    if ($conn->query($sql) === TRUE) {
        echo "User '$useridToBlock' has been blocked.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

ob_end_flush();
?>
<div class="container">
    <div class="container pendingbody">
        <h5>All Posts</h5>
        <table class="table">
            <thead>
            <tr>

                <th scope="col">User Id</th>
                <th scope="col">User Name</th>
                <th scope="col">Users_username</th>
                <th scope="col">Post</th>
                <th scope="col">Time</th>


            </tr>
            </thead>
            <tbody>
            <?php
            if (mysqli_num_rows($result2) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result2)) {
                    ?>
                    <tr>
                        <td><?php echo $row["users_id"] ?></td>
                        <td><?php echo $row["users_name"] ?></td>
                        <td><?php echo $row["users_username"] ?></td>
                        <td><?php echo $row["document"] ?></td>
                        <td><?php echo $row["created_at"] ?></td>
                        <td><a href="report.php?remove=<?php echo $row['post_id']; ?>">remove</a></td>
                        <td><a href="report.php?users_id=<?php echo $row["users_id"]?>">Block</a></td>
                    </tr>
                    <?php
                }
            }
            if (mysqli_num_rows($result3) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result3)) {
                    ?>
                    <tr>

                        <td><?php echo $row["users_username"] ?></td>


                    </tr>
                    <?php
                }
            }
            else
                echo "0 results";
            ?>
            </tbody>
        </table>

    </div>
