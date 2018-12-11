<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ViewComics inc.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <link rel="stylesheet" href="../assets/CSS/flexboxgrid.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/utilities.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/statistics.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/sidebar.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>
<div id="mySidenav" class="sidenav w-color">
    <p class="sidebar_title"><strong>Hi</strong> Admin</p>
    <label class="check_container">Catalog
        <input type="radio"  name="radio">
        <span class="checkmark"></span>
    </label>
    <label class="check_container">Statistics
        <input type="radio" checked="checked" name="radio">
        <span class="checkmark"></span>
    </label>
    <label class="check_container">Edit Account Settings
        <input type="radio" name="radio">
        <span class="checkmark"></span>
    </label>
    <div class="logout w-color">
        <a class="w-color" href="../geral/logout.php">Logout</a>
    </div>
    <div class="w-color">
        <a class="w-color" href="../cliente/cliente_account-collection.php">Coleção</a>
    </div>
</div>
<section class="main">
    <div class="main_header">
        <h1>Edit account Settings</h1>
    </div>
    <?php
    include '../geral/header.php';
    ?>
    <div class="row">
        <div class="col-xs-10">
            <div class="main-container">
                <p> <b> Lorem ipsum dolor sit amet, nec tibique argumentum cu, at mei nulla soleat omnesque, his et simul quando iisque.</b>
                    Est fugit tempor prodesset in, ad sumo noluisse moderatius duo.</p>
                <div class="main_books">
                    <?php
                    include '../geral/server-connection.php';
                    $result = pg_query($connection, "select cliente_firstname, cliente_lastname, cliente_email from cliente WHERE cliente_id = {$_SESSION["user_logged_id"]}");
                    $result = pg_fetch_all($result);
                    foreach ($result as $linha) {
                        echo "
                        <form method='POST'>
                            <li>First Name:</li>
                            <li><input type='text' name='cliente_firstname' value='{$linha['cliente_firstname']}'/></li>
                            <li>Second Name:</li>
                            <li><input type='text' name='cliente_lastname' value='{$linha['cliente_lastname']}'/></li>
                            <li>User Email:</li>
                            <li><input type='text' name='cliente_email' value='{$linha['cliente_email']}'/></li>
                            <li> <input type='submit' name='new' /></li>
                        </form>";
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $USERNAMEUPDATE = $_POST["cliente_firstname"];
                        $USERLASTNAMEUPDATE = $_POST["cliente_lastname"];
                        $USEREMAILUPDATE = $_POST["cliente_email"];
                        $query ="UPDATE cliente 
                                 SET (cliente_firstname, cliente_lastname, cliente_password) = 
                                ('$USERNAMEUPDATE','$USERLASTNAMEUPDATE','$USEREMAILUPDATE')
                                WHERE cliente_id= '{$_SESSION["user_logged_id"]}' ";
                        $result = pg_query($query);

                        if (!$result) {
                            echo "Update failed!!";
                        } else {
                            header('Location: http://localhost:63342/SI_PROJECT/cliente/cliente_account-settings.php');
                            echo "Update successfull;";
                        }

                    }?>

                </div>
            </div>
        </div>
</section>
</body>

