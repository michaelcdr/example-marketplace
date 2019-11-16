

<!doctype html>
<html lang="en">
    <head>
        <title>Area administrativa</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" 
            rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/libs/sweetAlert2/sweetalert2.min.css" >
        <link rel="stylesheet" href="/css/estilos.css">
        <style>
            .nav-breadcrumb a:link,
            .nav-breadcrumb a:visited,
            .nav-breadcrumb a:hover,
            .nav-breadcrumb a:active{
                color:#bbb;
            }
            .nav-breadcrumb{
                font-size: 80%;
                font-weight: 400;
                padding:0px;
                margin:0px;
            }
            .nav-breadcrumb li{
                display:inline;
            }
            .nav-breadcrumb li:after{
                content: ">";
            }
            .nav-breadcrumb li:last-child:after{
                content: "";
            }
        </style>
    </head>
    <body>
        <?php require_once './views/partials/nav-admin.php' ?>