<?php

    if(isset($_POST['n1']) && isset($_POST['n2']) && isset($_POST['op'])){

        if($_POST['op'] == '+'){
            echo $_POST['n1'] + $_POST['n2'];
        }else if($_POST['op'] == '-'){
            echo $_POST['n1'] - $_POST['n2'];
        }

    }else{
        header('Location: calc.html');
        die();
    }

?>