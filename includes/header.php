<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snippets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="../librerias/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../librerias/materialbootstrap/materialicons.css">
    <link rel="stylesheet" type="text/css" href="../librerias/materialbootstrap/bootstrap-material-design.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertify/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertify/css/alertify.css">

</head>
<body class="bg-light">
    <main id="app">
    <div class="row">
        <ul class="nav fixed-top bg-success">
            <div class="col-sm-8">
            </div>
            <div class="col-sm-4">
                <div v-if="menu == true">
                    <a class="btn btn-primary" href="index.php"><i class="material-icons">home</i></a>
                    <a class="btn btn-primary" href="alta.php"><i class="material-icons">add</i></a>
                    <a class="btn btn-primary" href="../login/salir.php">Salir</a>                 
                </div>
            </div> 
        </ul>
    </div>

