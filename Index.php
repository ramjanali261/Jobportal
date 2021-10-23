<?php
$alert = false;
$serror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include './config.php';
    $name = $_POST["name"];
    $apply = $_POST["apply"];
    $cname = $_POST["cname"];
    $email = $_POST["email"];
    $qualification = $_POST["qualification"];
    $year = $_POST["year"];

    $sql = "INSERT INTO `candidate` ( `name`,`apply`,`cname`, `email`, `qualification`,`year`) VALUES ('$name','$apply','$cname','$email','$qualification','$year')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $alert = true;
    } else {
        $serror = "Unable to apply";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>Job Portal</title>
</head>

<body>
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
                                <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./dashboard.php">Admin Panel</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                                Search
                            </button>
                        </form>
                    </div>
                </nav>
                <?php
                if ($alert) {
                    echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Applied Successfully</strong> Now you can apply other
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                if ($serror) {
                    echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error! </strong> ' . $serror . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                ?>
                <img class="img-fluid mt-3" src="./image/job1.jpg" width="100%" height="25%" alt="" />
                <div class="row jobs-section">
                    <?php
                    include './config.php';
                    $sql = "Select cname,position,description,skill,ctc from post";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                            echo '
                            <div class="card mt-4 ml-4 mr-4" style="width: 16.75rem; text-align: center" id="cardy">
                            <div class="card-body">
                                <h5 class="card-title mb-2 pb-1"><b>' . $rows['position'] . '</b></h5>
                                <h6 class="card-subtitle mb-2 text-muted mb-1 pb-1 ">Company Name: <b>' . $rows['cname'] . '</b></h6>
                                <div>
                             <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Apply Now</button>
                                </div>
                                <p class="card-text mt-2 pt-2"><b> Description : </b>
                                    ' . $rows['description'] . '
                                </p>
                                <h6><b>Skill Required: </b>' . $rows['skill'] . ' </h6>
                                <h6><b>CTC :</b>' . $rows['ctc'] . ' </h6>
                                
                            </div>
                        </div>';
                        }
                    }
                    ?>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><strong>Fill the Details</strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="./index.php" method="post" class="sub">
                                        <div class="form-floating mb-2 ">
                                            <input type="text" class="form-control mt-2 ml-1 w-75 mx-auto" id="floatingName" placeholder="name@example.com" name="name" required />
                                            <label for="floatingName">Full Name</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control ml-1 w-75 mx-auto" id="floatingInput" placeholder="Company Name" name="apply" required />
                                            <label for="floatingInput">Applying For</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control ml-1 w-75 mx-auto" id="floatingInput" placeholder="Position" name="cname" required />
                                            <label for="floatingInput">Comapany Name</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="email" class="form-control ml-1 w-75 mx-auto" id="floatingInput" placeholder="name@example.com" name="email" required />
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control ml-1 w-75 mx-auto" id="floatingPassword" placeholder="Password" name="qualification" required />
                                            <label for="floatingPassword">Qualification</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" class="form-control ml-1 w-75 mx-auto" id="floatingPassword" placeholder="Confirm Password" name="year" required />
                                            <label for="floatingPassword">Year of Passing</label>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-dark text-red">Apply</button>
                                </div>
                                </form>
                            </div>
                        </div>
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