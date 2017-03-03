<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mobirise Free Bootstrap Template, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="SlavoKozar.sk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CodeLeague">
    <title>Coding Bootcamp</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&subset=latin-ext"
          rel="stylesheet">

    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/prezi.css">

</head>
<body>

<div class="container">

            <h1>BootCamp.cz Lectures</h1>
            <ul>
            <?php
                foreach(scandir ( 'lectures' ) as $lecture){
                    if (preg_match('#^\.#', $lecture) !== 1) {
                        echo '<li><a href="lectures/'.$lecture.'/index.html">'.$lecture.'</a></li>'.PHP_EOL;
                    }
                }
            ?>
            </ul>
            <p>&copy; Slavomír Kožár</p>


</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/prezi.js"></script>

</body>
</html>