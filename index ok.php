<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <!-- add botton submit text -->
    <form action="test_post.php" method="post">
        <input type="text" name="name" required>
        <input type="submit" value="submit_post">
    </form>
    <!-- add something whit get method -->
    <form action="test_post.php" method="get">
        <input type="text" name="name">
        <input type="submit" value="submit_get">
    </form>
    <?php
    // create a function to create an object
    function createObject($id, $name, $surname, $age)
    {
        return (object) [
            'id' => $id,
            'name' => $name,
            'surname' => $surname,
            'age' => $age
        ];
    }
    // create a loop that create an array of objects
    $array = [];
    for ($i = 0; $i < 10; $i++) {
        $array[] = createObject($i, 'name' . $i, 'surname' . $i, $i);
    }

    // create a for loop to print name, surname and age in a table getted from the array of objects abd the last column is a button that delete the row of the table
    

    
    
    function createTableOfObject($array)
    {
        echo '<table class="table">';
        echo '<tr>';
        echo '<th scope="col">id</th>';
        echo '<th scope="col">name</th>';
        echo '<th scope="col">surname</th>';
        echo '<th scope="col">age</th>';
        echo '<th scope="col">delete</th>';
        echo '</tr>';

        for ($i = 0; $i < count($array); $i++) {
            echo '<tr>';
            echo '<td>' . $array[$i]->id . '</td>';
            echo '<td>' . $array[$i]->name . '</td>';
            echo '<td>' . $array[$i]->surname . '</td>';
            echo '<td>' . $array[$i]->age . '</td>';
            echo '<td>    <div class="form-check">
            <input class="form-check-input" type="checkbox" name="flexCheckDefault" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault"></label>
          </div></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    function deleteRow($array, $id)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]->id == $id) {
                unset($array[$i]);
            }
        }
        return $array;
    }

    createTableOfObject($array);


    ?>





    <form action="#" method="post">
        <input type="submit" name="delete_selection" value="delete_selection">
    </form>

    <?php
    if (isset($_POST['delete_selection'])) {
        echo 'delete_selection';
        $array = deleteRow($array, $_POST['id']);
        var_dump($_POST['id']);
        //createTableOfObject($array);
    }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>