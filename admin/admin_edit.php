<html>
<head>

    <head>
        <meta charset="UTF-8">
        <title>ViewComics inc.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="assets/images/favicon.ico" />
        <link rel="stylesheet" href="assets/CSS/style.css" type="text/css">
        <link rel="stylesheet" href="assets/CSS/flexboxgrid.min.css" type="text/css">
        <link rel="stylesheet" href="assets/CSS/utilities.css" type="text/css">
        <link rel="stylesheet" href="assets/CSS/catalog.css" type="text/css">
        <link rel="stylesheet" href="assets/CSS/sidebar.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    </head>
</head>
<body>
<section class="section section--white">
    <div class="container container-fluid">

<?php
include '../geral/server-connection.php';
$SelectedBookId =$_GET['id'];
$result = pg_query($connection, "select book_name, book_price, book_publisher, book_date, book_author, book_description from livro WHERE book_id = $SelectedBookId");
$result = pg_fetch_all($result);

foreach ($result as $linha) {
    echo("
     <form method='POST' action='admin/admin_edit.php' >
        <li>Book Name:</li>
        <li><input type='text' name='book_name' value='{$linha['book_name']}' /></li>
        <li>Price (USD):</li><li><input type='text' name='book_price' value='{$linha['book_price']}' /></li>
        <li>Date of publication:</li>
        <li><input type='text' name='book_date' value='{$linha['book_date']}' /></li>
        <li> <input type='submit' name='new' /></li>
     </form>
    ");
}
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $var=$_GET['user'];
        $BOOKNAMEUPDATE = $_POST["book_name"];
        $BOOKPRICEUPDATE = $_POST["book_price"];
        $BOOKDATEUPDATE = $_POST["book_date"];
        $query ="UPDATE livro 
        SET (book_name, book_price, book_date) = 
        ('$BOOKNAMEUPDATE','$BOOKPRICEUPDATE','$BOOKDATEUPDATE')
        WHERE book_id= '$SelectedBookId' ";
        $result = pg_query($query);

        if (!$result) {
            echo "Update failed!!";
        } else {
            echo "Update successfull;";
            header('Location: http://localhost:63342/SI_PROJECT/admin/SeeBook.php?id='. $SelectedBookId);
        }
}?>
    </div>
</section>
</body>
</html>