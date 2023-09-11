<?php require_once 'vendor/autoload.php';
if (($_GET["action"] ?? null) === "delete") {
    $opzione = $_POST["opzione"];
    // create array of values
    $values = [];
    foreach ($opzione as $key => $value) {
        // cast to int
        $values[] = (int) $value;
    }
    // open file
    $file = fopen('db.csv', 'r');
    // create new file
    $newFile = fopen('db_tmp.csv', 'w');
    // read file line by line
    $idx = 0;
    while (($line = fgetcsv($file)) !== FALSE) {
        // if line number is not in values array
        if (!in_array($idx, $values)) {
            // write line to new file
            fputcsv($newFile, $line);
        }
        $idx++;
    }
    // close files
    fclose($file);
    fclose($newFile);
    rename('db_tmp.csv', 'db.csv');
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} elseif (($_GET["action"] ?? null) === "append") {
    $url_lp = $_POST['url_lp'];
    $url_lh = $_POST['url_lh'];
    $title = $_POST['title'];
    $data = array($url_lp, $title, $url_lh);
    $fp = fopen('db.csv', 'a');
    fputcsv($fp, $data);
    fclose($fp);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .w-5 {
            width: 5% !important;
        }

        .w-20 {
            width: 20% !important;
        }

        .invisible-if-children-exist:not(:empty) {
            display: none;
        }

        .invisible-if-table-is-empty:not(:not(:empty)) {
            display: none;
        }
    </style>

</head>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare le righe selezionate?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('form_add_row').submit()">Conferma</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-center">

            <div class="p-2">
                <a href="https://www.livehelp.it" target="_blank"><img src="/static/download.png" style="height: 50px;" alt="Livehelp.png"></a>
            </div>
            <div class="p-2">
                <h1 class="text-center text-primary">LiveHelp MailUp Console</h1>
            </div>
            <div>
                <a href="https://mailup.it/" target="_blank"><img src="/static/mailup.png" style="height: 70px;" alt="mailup.png"></a>
            </div>
        </div>
        <p class="text-center">
            <a class="btn btn-primary disabled" id="delete" name="delete" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Delete
            </a>
            <button class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Add row
            </button>
            <button class="btn btn-primary" type="button" onclick="location.href = location.href/* location.reload(true) */">
                Refresh
            </button>
        </p>
        <div class="container collapse" id="collapseExample">
            <div class="card card-body">
                <form method="post" action="?action=append">
                    <div class="row align-items-center mb-3">
                        <div class="col-1">
                            <label for="url_lp" class="col-form-label">URL LP</label>
                        </div>
                        <div class="col-11">
                            <input type="text" class="form-control" id="url_lp" name="url_lp" required>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-1">
                            <label for="url_lh" class="col-form-label">URL LH</label>
                        </div>
                        <div class="col-md-auto">
                            <span id="url_lh_prefix">{{DOMAIN}}<?= URL_ROOT_PORTION ?>/</span>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="url_lh" name="url_lh" required>

                            <script>
                                var url_lh_prefix = document.getElementById("url_lh_prefix").innerHTML;
                                document.getElementById("url_lh_prefix").innerHTML = url_lh_prefix.replace("{{DOMAIN}}", document.location.origin);
                            </script>

                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-1">
                            <label for="title" class="col-form-label">TITLE</label>
                        </div>
                        <div class="col-11">
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" name="append" id="append">Add</button>
                </form>
            </div>
        </div>
        <div class="invisible-if-table-is-empty"></div>
        <form method="post" id="form_add_row" action="?action=delete">
            <table class="table">
                <tr>
                    <th scope="col"><input class="form-check-input" type="checkbox" onclick="selectAll()"></th>
                    <th scope="col">URL "parlante"</th>
                    <th scope="col">Titolo tab browser</th>
                    <th scope="col">URL originale MailUp</th>
                </tr>
                <?php


                $row = 0;
                $fileHasRows = false;
                if (($handle = fopen('db.csv', "r")) !== FALSE) {
                    while (($data = fgetcsv($handle)) !== FALSE) {
                        $fileHasRows = true;
                        $num = count($data);
                        printf(
                            '<tr>
                        <td class="w-5" >
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="opzione[]" value="%4$d" id="checkbox%4$d">
                            </div>
                        </td>
                        <td class="w-20" ><a href="' . URL_ROOT_PORTION . '%1$s" target="_blank">%1$s</a></td>
                        <td class="w-20" >%2$s</td>
                        <td><a href="%3$s" target="_blank">%3$s</a></td>
                    </tr>',
                            htmlEncode($data[0]),
                            htmlEncode($data[1]),
                            htmlEncode($data[2]),
                            $row
                        );
                        $row++;
                    }
                    fclose($handle);
                }
                if (!$fileHasRows) {
                    echo '<tr><td colspan="4" class="text-center">Nessun dato presente</td></tr>';
                }
                ?>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        window.onbeforeunload = function(event) {
            if (document.getElementById('url_lp').value != '' || document.getElementById('url_lh').value != '' || document.getElementById('title').value != '') {
                //event.preventDefault();
                const message = 'Are you sure you want to leave?';
                (event || window.event).returnValue = message;
                return message;
            }
        }
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(event) {
                document.getElementById('delete').classList.add('disabled');
                for (let i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        document.getElementById('delete').classList.remove('disabled');
                        break;
                    }
                }
            });
        });
    </script>
</body>

</html>