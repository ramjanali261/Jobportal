<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>Login</title>
</head>

<body>
    <?php
    $login = false;
    $serror = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include './config.php';
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "Select * from user where email='$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    header("location:dashboard.php");
                }
            }
        }
    } else {
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="./index.php"><img src="./image/logo.jpg" height="45px" width="45px" /> GIG
                        FEST</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link ml-5 pl-2" href="./dashboard.php">Admin Panel <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">
                                Search
                            </button>
                        </form>
                    </div>
                </nav>
                <?php

                if ($login) {
                    echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Login Successfull</strong> you are logged in
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                ?>
                <div class="row mt-3 p-4" style="min-height: 500px">
                    <div class="col bg-light">
                        <div id="carouselExampleIndicators" class="carousel slide mt-3 mb-3" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="./image/ss1.jpg" class="d-block w-100 img-fluid" alt="..." />
                                </div>
                                <div class="carousel-item">
                                    <img src="./image/aa.jpg" class="d-block w-100" alt="..." />
                                </div>
                                <div class="carousel-item">
                                    <img src="./image/qw.jpg" class="d-block w-100" alt="..." />
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col bg-light">
                        <h4 class="ml-0 pl-4 mt-5 pt-1" style="text-align: center;"><b>SIGN IN</b></h4>
                        <form action=" login.php" method="post" class="sub">
                            <div class="form-floating mb-3 ">
                                <input type="email" class="form-control mt-5 ml-1 w-75 mx-auto" id="floatingInput" placeholder="name@example.com" name="email" />
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control ml-1 w-75 mx-auto" id="floatingPassword" placeholder="Password" name="password" />
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" id="log-but" class="btn btn-outline-dark mt-3 mb-3">
                                Login
                            </button>
                        </form>
                        <h5 class="ml-0 pl-5 mt-4 " style="text-align: center;">
                            New Registration? <a href="signup.php">SignUp</a>
                        </h5>
                    </div>
                </div>
                <footer class="page-footer font-small blue bg-light mt-3">

                    <div class="footer-copyright text-center py-3">© 2021 Copyright: All Right Reserved </div>

                </footer>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</html>