<?php

global $conn;
require_once '../connection.php';

if (isset($_POST['inputValue'])){
    $inputvalue = $_POST['inputValue'];
    $replies = [];

    $datas[] = explode(',', $inputvalue);

    $datas = $datas[0];

    foreach ($datas as $reply) {
        $sql = "SELECT
                    users.users_id,
                    users.users_name,
                    users.users_image,
                    users.users_uesrname,
                    replies.reply_id,
                    replies.reply_text,
                    replies.reply_time
                FROM
                    replies
                INNER JOIN users ON replies.reply_userid = users.users_id
                WHERE replies.reply_id = ". $reply .";";

        $result = $conn->query($sql);

        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        array_push($replies, $data);
    }

    $conn->close();

    header('Content-Type: application/json');

    echo json_encode($replies);
}

?>