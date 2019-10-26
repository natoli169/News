<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Central News</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php
                require_once 'core/init.php';


                $sql = "SELECT id,name,parent_id FROM categories WHERE parent_id=0";
                $stmt = $conn->prepare("SELECT id,name,parent_id FROM categories WHERE parent_id=?");
                $result = $conn->query($sql);

                $dbdata = array();


                while ($row = $result->fetch_row()) {
                    $id = (int)$row[0];
                    $name = $row[1];
                    echo '<li class="nav-item">
              <div class="dropdown">
                  <button class="btn nav-link dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ';
                    echo $name;
                    echo ' </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $child_result = $stmt->get_result();
                    while ($child_row = $child_result->fetch_row()) {
                        echo '<a class="dropdown-item" href=index.php?id="' . (int)$child_row[0] . '">' . $child_row[1] . '</a>';
                    }

                    echo '      </div>
                </div>
          </li>';

                }

                $send = array("data" => $dbdata);

                $stmt->close();

                ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- Post Content Column -->
        <div class="col-lg-8">

        <?php
        $sql = null;
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = "SELECT id,title,author,time,category,headline,view,body,img FROM posts WHERE id =$id ";

        }else{
           // DO SOMETHING here
        }
        $result = $conn->query($sql);



        while ($row = $result->fetch_row()) {
            $title = $row[1];
            $author = $row[2];
            $body = $row[7];
            $img = $row[8];
            $time = $row[3];
            $id = (int)$row[0];
            $view = $row[6];

            $stmt2 = $conn->prepare("UPDATE posts SET view = ? WHERE id=?");
            $view = $view + 1;
            $stmt2->bind_param("ii",$view,$id);
            $stmt2->execute();
            echo '<h1 class="mt-4">'.$title.'</h1>';
            echo '     <p class="lead">
                by
                <a href="#">'.$author.'</a>
            </p>';
            echo '<p>'.$view.' views</p>';
            echo ' <hr><p>Posted on ';
            echo $time;
            echo '</p>

            <hr>';
            echo '<img class="img-fluid rounded" src="admin/scripts/posts/uploads/'.$img.'" alt="">';
            echo ' <hr>  <p class="lead">';
            echo $body;
            echo '</p>';
        }




        ?>









        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">


            <div class="card my-4">
                <h5 class="card-header">Headlines</h5>
                <div class="card-body">
                    <?php

                    $sql = "SELECT id,title,author,time,category,headline,view,body FROM posts WHERE headline='Yes' ORDER BY time DESC ";
                    $result = $conn->query($sql);

                    echo '<ul style="list-style: none">';
                    while ($row = $result->fetch_row()) {
                        $title = $row[1];
                        $id = (int)$row[0];
                        echo '<li><a href="details.php?id='.$id.'">'.$title.'</a></li>';
                    }


                    ?>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Central News 2019</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
