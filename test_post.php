<?php
    function request_name_method($name_method): callable{
        return function() use ($name_method): void{
            echo  ' i\'m a ' . $name_method;
        };
    }

    $call_name_mathod = request_name_method($_SERVER['REQUEST_METHOD']);

    if(isset($_POST['name']) | isset($_GET['name'])){
        echo 'Hi ' . $_REQUEST['name'];
        $call_name_mathod();
    }




?>