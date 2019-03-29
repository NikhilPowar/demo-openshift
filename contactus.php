<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>ContactUs</title>
    
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
                $err = 'Invalid email format.';
            }
            if(!isset($err)) {
                require 'config.php';
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, "insert into messages(name, email, phone, message) values(?, ?, ?, ?)")) {
                    mysqli_stmt_bind_param($stmt, 'ssis', $name, $email, $phone, $message);
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                    $phone=(int) $_POST['phone'];
                    $message=$_POST['message'];
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    $success = TRUE;
                }
            }
        }
        require 'header.php';
    ?>

    <section class="mbr-section form1 cid-rlfG04xzzt" id="form1-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">SHARE YOUR THOUGHTS</h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">Want to
                        write your own articles on ThoughtBlog? Or perhaps request an article on a topic? Contact us
                        using the form below.</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <!---Formbuilder Form--->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="mbr-form form-with-styler"
                        data-form-title="Contact Form"><input type="hidden" name="email" data-form-email="true" value="gyCdMqW8FRt30Yvt0S0teWdHt2+ENU13cONqb554HTajSm0oLzSTn8GxOMtUGnv3XwGLIFmv3w7BcaMJEwjsevVp3lLb9SSgxLXAblYHeJ16kLjsK0jw3iMIpycYvSrL">
                        <div class="row row-sm-offset">
                            <div <?php echo isset($success) ? '' : 'hidden="hidden"' ?> data-form-alert="Thanks for sharing your thoughts with us!" class="alert alert-success col-12">
                                Thanks for sharing your thoughts with us!</div>
                            <div <?php echo isset($err) ? '' : 'hidden="hidden"' ?> data-form-alert-danger="<?php echo isset($err) ? $emailErr : '' ?>" class="alert alert-danger col-12">
                                <?php echo isset($err) ? $err : '' ?></div>
                        </div>
                        <div class="dragArea row row-sm-offset">
                            <div class="col-md-4  form-group" data-for="name">
                                <label for="name-form1-10" class="form-control-label mbr-fonts-style display-7">Name</label>
                                <input type="text" name="name" data-form-field="Name" required="required" class="form-control display-7"
                                    id="name-form1-10">
                            </div>
                            <div class="col-md-4  form-group" data-for="email">
                                <label for="email-form1-10" class="form-control-label mbr-fonts-style display-7">Email</label>
                                <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7"
                                    id="email-form1-10">
                            </div>
                            <div data-for="phone" class="col-md-4  form-group">
                                <label for="phone-form1-10" class="form-control-label mbr-fonts-style display-7">Phone</label>
                                <input type="tel" name="phone" data-form-field="Phone" class="form-control display-7"
                                    id="phone-form1-10">
                            </div>
                            <div data-for="message" class="col-md-12 form-group">
                                <label for="message-form1-10" class="form-control-label mbr-fonts-style display-7">Message</label>
                                <textarea name="message" data-form-field="Message" class="form-control display-7" id="message-form1-10"></textarea>
                            </div>
                            <div class="col-md-12 input-group-btn align-center">
                                <button type="submit" class="btn btn-primary btn-form display-4">SEND FORM</button>
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