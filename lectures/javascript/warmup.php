<?php
/*
 * Warm Up Activity
 * Create a simple "talking" computer.
 *
 * 1) ask for name (in form), print "Hi {name}!"
 *
 * 2) ask for age (in same form)
 *      If age is below 12 print "Hi {name}, go to bed!"
 *      If age is over 12 and below 18 print "Hi {name}, go study!"
 *      If age is over 18 and below 60 print "Hi {name}, go to work!"
 *      If age is over 60 and below 60 print "Hi {name}, go wherever you want!"
 *      If age is not a number print "Hi {name}, that's not number!"
 */
?>

<html>
<body>
<h1>
<?php
    if(isset($_GET['name'])){
        $name = $_GET['name'];

        if(isset($_GET['age'])){
            $age = $_GET['age'];

            //check whether age is a number
            if(is_numeric($age)){

                //compare ages
                if($age < 12){
                    echo 'hi '. $name .', go to bed!';
                }else if($age >= 12 && $age < 18){
                    echo 'hi '. $name .', go study!';
                }else if($age >= 18 && $age < 60){
                    echo 'hi '. $name .', go to work!';
                }else if($age >= 60){
                    echo 'hi '. $name .', go wherever you want!';
                }
            }else{
                //age is not a number
                echo 'hi '. $name .', that\'s not number!';
            }
        }else{
            echo 'hi '. $name .'!';
        }
    }
?>
</h1>

<form>
    <input name="name" placeholder="name">
    <input name="age" placeholder="age">
    <button type="submit">Submit</button>
</form>


<script src="script.js">
</script>


</body>
</html>
