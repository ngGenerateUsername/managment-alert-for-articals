<?php
require_once('db.php');

$articles = get_articles();
$goodState = TRUE;
//idha ken 3malna post request(famma fel body ta3 request properties chneb3thouhom lel serveur)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // hethi li ta5edh
    if (isset($_POST["take"])) {
        dickrement_quantity($_POST["article_id"]);
        header("Location: index.php");
        exit();
    }

    // ki tenzel 3alli tefsa5
    if (isset($_POST["delete"])) {
        delete_article($_POST["article_id"]);
        header("Location: index.php");
        exit();
    }
    //kif yrajja3
    if (isset($_POST["retake"])) {
        increment_quantity($_POST["article_id"]);
        header("Location: index.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Article Inventory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
 .jumbotron{
    padding-top:10px !important;
    padding-bottom: 10px !important;
 }
 //add dark mode
        body {
  padding: 25px;
  background-color: white;
  color: black;
  font-size: 25px;
}

.dark-mode {
  background-color: black;
  color: white;
}

label.theme-switch {
  position: fixed;
  top: 20px;
  right: 20px;
  display: inline-block;
  width: 60px;
  height: 34px;
}

label.theme-switch input[type="checkbox"] {
  display: none;
}

label.theme-switch div {
  display: inline-block;
  width: 34px;
  height: 34px;
  background-color: #ccc;
  border-radius: 17px;
  transition: background-color 0.2s ease;
}

label.theme-switch input[type="checkbox"]:checked + div {
  background-color: #333;
}

        </style>
</head>
<body>
    <div class="container mt-3 mb-4">
        <h2 class="mb-4 text-center">Article Management</h2>
        <hr>
    
        <div class="jumbotron">

        
        <?php
      
        foreach ($articles as $article) { 
             if($article->current_quant<$article->min_quant)
             {
                $goodState = FALSE;
            ?>
            <div class="alert alert-danger" role="alert">
                ya nadia bech netnekou fel <?php echo $article->name ?>
          </div>
          <?php }
  } ?>
  <?php
        if($goodState)
        {

        
         ?>
         <p class="text-muted text-center pt-3"> <i> No warning for now! </i>  </p>
         <?php }
  ?></div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h5>ADD new Article</h5>
                <form action="add_article.php" method="POST">
                    <div class="form-group">
                        <label for="name">Article Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="min_quant">Minimum Quantity (Alert)</label>
                        <input type="number" class="form-control" name="min_quant" required>
                    </div>
                    <div class="form-group">
                        <label for="current_quant">Current Quantity</label>
                        <input type="number" class="form-control" name="current_quant" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Article</button>
                </form>
            </div>
            <div class="col-md-6">
                <h5>Article state <small class="text-muted">(Q: quantity)</small> </h5> 
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Current (Q)</th>
                            <th>Alert (Q)</th>
                            <th>Action</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article) { ?>
                        <tr>
                            <td><?php echo $article->name; ?></td>
                            <td><?php echo $article->current_quant; ?></td>
                            <td><?php echo $article->min_quant; ?></td>
                           
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="article_id" value="<?php echo $article->article_id; ?>">
                                    <td> <button type="submit" name="take" class="btn btn-outline-primary btn-sm" <?php  ?>>(-)</button> </td>
                                    <td> <button type="submit" name="retake" class="btn btn-outline-primary btn-sm" <?php  ?>>(+)</button> </td>
                                    <td>  <button type="submit"  name="delete" class="btn btn-outline-danger btn-sm" <?php  ?>>delete</button> </td>
                                </form>
                           
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <label class="theme-switch" for="checkbox">
      <input class="theme-switch" type="checkbox" onchange="myFunction()" id="checkbox" />
      <div></div>
    </label>

    <script>
function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}

</script>
</body>
</html>