<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>AdminLogin</title>
    
    <?php
        require 'importscripts.php';
    ?>
</head>

<body>

<?php
    $unameErr = $pswErr = $credErr = "";
    $uname = $psw = $role = "";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['logout'])) {
            session_destroy();
            die();
        }
        $uname = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$uname)) {
            $unameErr = "Only letters and white space allowed";
        }
        $psw = test_input($_POST["password"]);
        if (!preg_match("/^[a-zA-Z]*$/",$psw)) {
            $pswErr = "Only letters allowed";
        }
        if(strcmp($unameErr, "")==0 and strcmp($pswErr, "")==0) {
            require 'config.php';
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, "select password from admins where name=?")) {
                mysqli_stmt_bind_param($stmt, 's', $name);
                $name = $uname;
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $p);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
                if($psw==$p){
                    $_SESSION['username']=$uname;
                    header('Location: http://localhost/ThoughtBlog/adminhome.php');
                    die();
                }
                else {
                    $credErr = "Invalid credentials.";
                }
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
    
    <?php
        require 'header.php';
    ?>

    <section class="mbr-section form1 cid-rlgxZhsGpX" id="form1-18">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">ADMIN LOGIN</h2>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo '<h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                            You are already logged in as admin.</h3>';
                        }
                        else {
                        echo '<h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                            Login to create and manage articles as administrator.</h3>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <!---Formbuilder Form--->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="mbr-form form-with-styler">
                        <div class="row row-sm-offset">
                            <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                            </div>
                        </div>
                        <div class="dragArea row row-sm-offset">
                            <div class="col-md-4  form-group" data-for="name">
                                <label for="name" class="form-control-label mbr-fonts-style display-7">Username</label>
                                <input type="text" name="name" data-form-field="Name" required="required" class="form-control display-7"
                                    id="name" <?php echo isset($_SESSION['username']) ? 'disabled="disabled"' : '' ?> >
                            </div>
                            <div class="col-md-4  form-group" data-for="email">
                                <label for="password" class="form-control-label mbr-fonts-style display-7">Password</label>
                                <input type="password" name="password" data-form-field="Password" required="required" class="form-control display-7"
                                    id="password" <?php echo isset($_SESSION['username']) ? 'disabled="disabled"' : '' ?> >
                            </div>
                            <div class="col-md-12 input-group-btn align-center"><button type="submit" class="btn btn-primary btn-form display-4"
                                <?php echo isset($_SESSION['username']) ? 'disabled="disabled"' : '' ?> >LOGIN</button></div>
                        </div>
                    </form>
                    <!---Formbuilder Form--->
                </div>
            </div>
        </div>
    </section>
    
    <?php
        require 'footer.php';
    ?>
</body>
</html>