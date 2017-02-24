<?php
//    for($i = 0; $i < 100000000; $i++){}


    if(isset($_POST['a']) && isset($_POST['b'])){


        $result = [
            'number1' => $_POST['a'],
            'number2' => $_POST['b'],
            'result' => $_POST['a'] + $_POST['b']
        ];


        $result = (object)$result;

        echo json_encode($result);

    }else{
        echo "Hello world via ajax!";
    }


?>