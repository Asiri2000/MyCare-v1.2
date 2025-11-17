<?php include "db_conn.php"; ?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            min-height: 100vh;
        }

        .alb {
            width: 950px;
            height: 700px;
            padding: 5px;

        }

        .alb img {
            width: 100%;
            height: 100%;
            border-style: solid;
            border-color: green;
        }

        a {
            text-decoration: none;
            color: black;
        }

        #back {
            padding: 0;
            margin: 0;
        }
    </style>


</head>

<body>





    <a href="http://localhost/MyCareV1.1/dashboard.php"><button type="button" class="btn btn-primary btn">Go
            Back</button> </a>

    <?php

    session_start();
    $user_id = $_SESSION["user_id"];

    $viewQuery = "SELECT * FROM repository WHERE user_id='$user_id' ORDER BY img_id DESC";
    $result = mysqli_query($conn, $viewQuery);

    if (mysqli_num_rows($result) > 0) {
        while ($images = mysqli_fetch_assoc($result)) { ?>

            <div class="alb" class="border border-success">
                <img src="upload/<?= $images['image_url'] ?>">
            </div>

        <?php }
    } ?>



</body><!-- comment -->

</html>