<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php 
    $username = 'lolol';
        $userTeacher = 'tch';
        $userStudent = 'std';
        echo $userIndicator = substr($username, 0, 4);
        echo strlen($userIndicator);
        # Login student/teacher
        
    ?>
    <div class="container mt-5 d-flex   justify-content-center">

        <form action="includes/login.inc.php" method="post" class="d-flex flex-column">
            <h1>Log in</h1>
            <input class="mt-3" type="text" placeholder="Student number" name="usernumber">
            <input class="mt-3" type="password" placeholder="Password" name="password">
            <button class="mt-3" type="submit" name="submit">login</button>
            <?php
    # Error message
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo '<p>Missing Fields!</p>';
        }
        else if($_GET["error"] == "usernotfound"){
            echo '<p>Theres no such user!</p>';
        }
        else if($_GET["error"] == "wronglogin"){
            echo '<p>Incorrect login!</p>';
        }
    }
    ?>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>