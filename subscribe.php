<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>Subscribe</title>
    
    <?php
        require 'importscripts.php';
    ?>
</head>

<body>
    <?php
        function isValidEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) and preg_match('/@.+\./', $email);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!isValidEmail($_POST['email'])) {
                $emailErr = 'Invalid email format.';
            }
            if(!isset($emailErr)) {
                require 'config.php';
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, "insert into subscribers(email) values(?)")) {
                    mysqli_stmt_bind_param($stmt, 's', $email);
                    $email=$_POST['email'];
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    $success = TRUE;
                }
            }
        }
        require 'header.php';
    ?>

    <section class="mbr-section form3 cid-rlfGnMoWkT" id="form3-13">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="align-center pb-2 mbr-fonts-style display-2">KEEP UP WITH OUR THOUGHTS</h2>
                    <h3 class="mbr-section-subtitle align-center pb-5 mbr-light mbr-fonts-style display-5">
                        Subscribe to our Newsletter
                    </h3>
                </div>
            </div>
            <div class="row py-2 justify-content-center">
                <div class="col-12 col-lg-6  col-md-8 " data-form-type="formoid">
                    <!---Formbuilder Form--->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="mbr-form form-with-styler"
                        data-form-title="Subscription Form"><input type="hidden" name="email" data-form-email="true" value="BSzTWiQIeymgbm53icSQ+HT1Zj3YtbyJzcNdAcwdGMz3CG/IDlhz+5YLHi+GmgvAdCLojqAq12/ssfsur67+U7PncbzTrzhtJqJABeGaxaAB/vjK++dttmU68gWj72pm">
                        <div class="row">
                            <div <?php echo isset($success) ? '' : 'hidden="hidden"' ?> data-form-alert="You have subscribed to our newsletter successfully" class="alert alert-success col-12">
                                Thanks for subscribing!</div>
                            <div <?php echo isset($emailErr) ? '' : 'hidden="hidden"' ?> data-form-alert-danger="<?php echo isset($emailErr) ? $emailErr : '' ?>" class="alert alert-danger col-12">
                                <?php echo isset($emailErr) ? $emailErr : '' ?></div>
                        </div>
                        <div class="dragArea row">
                            <div class="form-group col" data-for="email">
                                <input type="email" name="email" placeholder="Email" data-form-field="Email" required="required"
                                    class="form-control display-7" id="email-form3-13">
                            </div>
                            <div class="col-auto input-group-btn">
                                <button type="submit" class="btn btn-primary  display-4">SUBSCRIBE</button>
                            </div>
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