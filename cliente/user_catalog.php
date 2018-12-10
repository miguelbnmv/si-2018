<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ViewComics inc.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <link rel="stylesheet" href="../assets/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/utilities.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/catalog.css" type="text/css">
    <link rel="stylesheet" href="../assets/CSS/sidebar.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>

  <div id="mySidenav" class="sidenav w-color">
      <p class="sidebar_title">To make your life </br><strong>a lot easier</strong>, sort by</p>
      <form method="POST" id="formCreateComment">
          <label class="check_container">Name
              <input type="radio" name="order" value="book_name">
              <span value="book_name" class="checkmark"></span>
          </label>
          <label class="check_container">Author
              <input type="radio" name="order" value="book_author">
            <span value="book_author" class="checkmark"></span>
          </label>
          <label class="check_container">Year
              <input type="radio" name="order" value="book_date">
            <span value="book_date" class="checkmark"></span>
          </label>
          <label class="check_container">Price
              <input type="radio" name="order" value="book_price">
            <span value="book_price" class="checkmark"></span>
          </label>
          <label class="check_container">Publishing Company
              <input type="radio" name="order" value="book_publisher">
              <span value="book_publisher" class="checkmark"></span>
          </label>
          <input type='submit' value='submit_order' name='submit_rating'>
      </form>

      <?php
      include '../geral/header.php';
      include '../geral/server-connection.php';

      echo"
   
      <a href='../cliente/cliente_account-settings.php?id' > oi mano</a>
        <a href='../cliente/cliente_account-favorites.php?id' > oi mano fav</a>
      " ?>
      <script type="text/javascript">
          function displayForm(c){
              if(c.value == "1"){
                  document.getElementById("panel").style.visibility='visible';
              }
              else{
                  document.getElementById("panel").style.visibility='hidden';
              }
          }
      </script>
  </div>
  <section class="main">

      <div class="main-container">
        <?php
        include '../geral/server-connection.php';

        if(isset($_POST["submit_rating"])) {
            $result = pg_query($connection, "SELECT book_id, book_name, book_author, book_price, book_publisher, book_date FROM livro order by {$_POST["order"]}");
            $result = pg_fetch_all($result);
            foreach ($result as $linha)
            {
                echo "
                    <div class=\"book\">
                        <a href='user_book_nb.php?id={$linha['book_id']}'>
                          <img src=\"../assets/images/cover.jpg\">
                          <p class=\"book_title\">{$linha['book_name']}</p>
                          <p class=\"book_price\">{$linha['book_price']}€</p>
                        </a>
                    </div>
            ";
            }
        } else {
            $result = pg_query($connection, "SELECT book_id, book_name, book_author, book_price, book_publisher, book_date FROM livro");
            $result = pg_fetch_all($result);
            foreach ($result as $linha)
            {
               echo "
                    <div class=\"book\">
                        <a href='user_book_nb.php?id={$linha['book_id']}'>
                          <img src=\"../assets/images/cover.jpg\">
                          <p class=\"book_title\">{$linha['book_name']}</p>
                          <p class=\"book_price\">{$linha['book_price']}€</p>
                        </a>
                    </div> 
            ";
            }
        }
        ?>
      </div>
      <div class="logout b-color">
          <a class="b-color" href="../geral/logout.php">logout</a>
      </div>
  </section>
</body>
</html>

