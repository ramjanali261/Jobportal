<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
}

$alert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include './config.php';
    $cname = $_POST["cname"];
    $position = $_POST["position"];
    $description = $_POST["description"];
    $skill = $_POST["skill"];
    $ctc = $_POST["ctc"];

    $sql = "INSERT INTO `post` ( `cname`, `position`, `description`, `skill`, `ctc`) VALUES ('$cname','$position','$description','$skill','$ctc')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $alert = true;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <title>Dashboard</title>
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
                                <a class="nav-link ml-4" href="./dashboard.php">Admin Dashboard <span class="sr-only">(current)</span></a>
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
                if ($alert) {
                    echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Posted Successfully</strong> Now you can View on Job Section
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> ';
                }
                ?>
                <div class="d-flex align-items-start mt-3">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-panel-tab" data-bs-toggle="pill" data-bs-target="#v-pills-panel" type="button" role="tab" aria-controls="v-pills-panel" aria-selected="true">Panel</button>
                        <button class="nav-link" id="v-pills-job-tab" data-bs-toggle="pill" data-bs-target="#v-pills-job" type="button" role="tab" aria-controls="v-pills-job" aria-selected="false">Jobs </button>
                        <button class="nav-link" id="v-pills-candidate-tab" data-bs-toggle="pill" data-bs-target="#v-pills-candidate" type="button" role="tab" aria-controls="v-pills-candidate" aria-selected="false">Candidate Applied</button>
                        <button class="nav-link" id="v-pills-contact-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contact" type="button" role="tab" aria-controls="v-pills-contact" aria-selected="false">Contact</button>
                        <button class="nav-link" id="v-pills-logout-tab" data-bs-toggle="pill" data-bs-target="#v-pills-logout" type="button" role="tab" aria-controls="v-pills-logout" aria-selected="false">Logout</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-panel" role="tabpanel" aria-labelledby="v-pills-panel-tab">
                            <div class="panel-lists mt-1 ml-1">
                                <h5 class="mt-1 mb-3 ml-5 ml-5"> Employer Can Post their vacancy here...!</h5>
                                <p>
                                    <button class="btn btn-outline-danger ml-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                        Post Job
                                    </button>
                                </p>
                                <div style="min-height: 120px;">
                                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                        <div class="card card-body ml-3" style="width: 700px;">

                                            <form action="./dashboard.php" method="post">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" name="cname">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPosition" class="form-label">Position</label>
                                                    <input type="text" class="form-control" id="exampleInputposition" name="position">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jobdesc" class="form-label">Job Decription</label>
                                                    <input type="text" class="form-control" id="jobdesc" name="description">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="skil" class="form-label">Skill Required</label>
                                                    <input type="text" class="form-control" id="skil" name="skill">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="CTC" class="form-label">CTC</label>
                                                    <input type="text" class="form-control" id="CTC" name="ctc">
                                                </div>
                                                <button type="submit" class="btn btn-outline-dark">Submit</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-job" role="tabpanel" aria-labelledby="v-pills-job-tab">

                            <div class="job-lists mt-1 ml-1">
                                <table class="table table-dark table-hover mt-3" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th width="100rem" scope="col">Sl No.</th>
                                            <th width="250rem" scope="col">Company Name</th>
                                            <th width="250rem" scope="col">Position</th>
                                            <th width="250rem" scope="col">Skill Required</th>
                                            <th width="250rem" scope=" col">CTC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include './config.php';
                                        $sql = "Select cname,position,skill,ctc from post";
                                        $res = mysqli_query($conn, $sql);
                                        $i = 1;
                                        while ($rows = mysqli_fetch_assoc($res)) {

                                        ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $rows['cname']; ?></td>
                                                <td><?php echo $rows['position']; ?></td>
                                                <td><?php echo $rows['skill']; ?></td>
                                                <td><?php echo $rows['ctc']; ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-candidate" role="tabpanel" aria-labelledby="v-pills-Candidate-tab">
                            <div class="candidate-lists mt-1 ml-1">
                                <table class="table table-dark table-hover mt-3" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th width="80rem" scope="col">Sl No.</th>
                                            <th width="200rem" scope="col">Candidate Name</th>
                                            <th width="200rem" scope=" col">Company</th>
                                            <th width="200rem" scope="col">Position</th>
                                            <th width="200rem" scope="col">Qualification</th>
                                            <th width="200rem" scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include './config.php';
                                        $sql = "Select name,cname,apply,qualification,email from candidate";
                                        $res = mysqli_query($conn, $sql);
                                        $i = 1;
                                        while ($rows = mysqli_fetch_assoc($res)) {

                                        ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['cname']; ?></td>
                                                <td><?php echo $rows['apply']; ?></td>
                                                <td><?php echo $rows['qualification']; ?></td>
                                                <td><?php echo $rows['email']; ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-Contact-tab">
                            <marque>
                                <p style="color: red;">
                                    Email id: studentportal@info.com && Phone No.: +91 759**365**
                                <p>
                            </marque>
                        </div>
                        <div class="tab-pane fade" id="v-pills-logout" role="tabpanel" aria-labelledby="v-pills-logout-tab">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Click here to logout!
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Warning</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you and to Logout?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-dark"><a style="text-decoration:none;" href="./logout.php">Confirm</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="logout.php"></a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</html>