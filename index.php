<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        echo '<table>';
        echo '<tr>';
        echo '<th>id</th>';
        echo '<th>name</th>';
        echo '<th>surname</th>';
        echo '<th>age</th>';
        echo '<th>delete</th>';
        echo '</tr>';

        for ($i = 0; $i < count($array); $i++) {
            echo '<tr>';
            echo '<td>' . $array[$i]->id . '</td>';
            echo '<td>' . $array[$i]->name . '</td>';
            echo '<td>' . $array[$i]->surname . '</td>';
            echo '<td>' . $array[$i]->age . '</td>';
            echo '<td><button>delete</button></td>';
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
    // reload the page and delete the row of the table
    if (isset($_GET['id'])) {
        $array = deleteRow($array, $_GET['id']);
    }
    echo '<table>';
    echo '<tr>';
    echo '<th>id</th>';
    echo '<th>name</th>';
    echo '<th>surname</th>';
    echo '<th>age</th>';
    echo '<th>delete</th>';
    echo '</tr>';
    for ($i = 0; $i < count($array); $i++) {
        echo '<tr>';
        echo '<td>' . $array[$i]->id . '</td>';
        echo '<td>' . $array[$i]->name . '</td>';
        echo '<td>' . $array[$i]->surname . '</td>';
        echo '<td>' . $array[$i]->age . '</td>';
        echo '<td><a href="index.php?id=' . $array[$i]->id . '">delete</a></td>';
        echo '</tr>';
    }
    echo '</table>';


    ?>



</body>

</html>