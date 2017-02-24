<?php
//    for($i = 0; $i < 100000000; $i++){}


    if(isset($_POST['a']) && isset($_POST['b'])){
        echo $_POST['a'] + $_POST['b'];
    }else{
        echo "Hello world via ajax!";
    }


?>