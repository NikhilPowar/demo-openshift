<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>Home</title>
    
    <?php
        require 'importscripts.php';
    ?>
</head>

<body>
    <?php
        require 'header.php';
    ?>

    <section class="header1 cid-rleo5smHMm mbr-parallax-background" id="header1-1">
        <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(20, 157, 204);">
        </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">
                        WELCOME TO THOUGHTBLOG</h1>
                    <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-2">A PLACE FOR
                        ALL OUR THOUGHTS</h3>
                    <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">
                        Read the thoughts and opinions of your fellow humans on relevant issues.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features18 popup-btn-cards cid-rleoZTMVJA" id="features18-3">
        <div class="container">
            <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
                Our thought-provoking articles</h2>
            <h3 class="mbr-section-subtitle display-5 align-center mbr-fonts-style mbr-light">Choose from an array of
                our articles to get your brain thinking!</h3>
            <div class="media-container-row pt-5 ">
                <?php
                    require 'config.php';
                    $stmt = mysqli_stmt_init($conn);
                    if(mysqli_stmt_prepare($stmt, "select articleID, header, description, picture, date from articles order by date desc")){
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id, $header, $desc, $picture, $date);
                        while(mysqli_stmt_fetch($stmt)){
                            echo '
                            <div class="card p-3 col-12 col-md-6 col-lg-4">
                                <div class="card-wrapper ">
                                    <div class="card-img">
                                        <div class="mbr-overlay"></div>
                                        <div class="mbr-section-btn text-center">
                                            <a href="article.php?id='.$id.'" class="btn btn-primary display-4">Read</a>
                                        </div>
                                        <img src="'.$picture.'" alt="Image">
                                    </div>
                                    <div class="card-box">
                                        <h4 class="card-title mbr-fonts-style display-7">
                                            '.$header.'
                                        </h4>
                                        <p class="mbr-text mbr-fonts-style align-left display-7">
                                            '.$desc.' (Published: '.$date.')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        mysqli_stmt_close($stmt);
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="mbr-section form3 cid-rleplErtag" id="form3-4">
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
                    <form action="subscribe.php" method="POST" class="mbr-form form-with-styler"
                        data-form-title="Subscribe Form"><input type="hidden" name="email" data-form-email="true" value="Lr7zHC/Vsy/i2Q5mRHxQtvs1iB/Y/TT8nPUUw9KwJbQki6ybVplKnD2jNzB83jY3PzW1PNZpvl0IzXDNeyc60u0EJk4yhl12cUqohSd1ldHDcL+mT+Tf32TWDB5f8Q8I">
                        <div class="row">
                            <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                            <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12"></div>
                        </div>
                        <div class="dragArea row">
                            <div class="form-group col" data-for="email">
                                <input type="email" name="email" placeholder="Email" data-form-field="Email" required="required"
                                    class="form-control display-7" id="email-form3-4">
                            </div>
                            <div class="col-auto input-group-btn">
                                <button type="submit" class="btn btn-primary display-4">SUBSCRIBE</button>
                            </div>
                        </div>
                    </form>
                    <!---Formbuilder Form--->
                </div>
            </div>
        </div>
    </section>

    <section class="mbr-section form1 cid-rlepmbv3vk" id="form1-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">SHARE YOUR THOUGHTS</h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">Want to
                        write your own articles on ThoughtBlog? Or perhaps request an article on a topic? Contact us using
                        the form below.</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <!---Formbuilder Form--->
                    <form action="contactus.php" method="POST" class="mbr-form form-with-styler"
                        data-form-title="Contact Form"><input type="hidden" name="email" data-form-email="true" value="ov1V+Q41ib3g690MkXs72Zv4cU7jOl92m7LJFIJIZXBpxeqUm5z0l3+xVCXZdHahXMWMBNp6bFVESUhxUjnklahug0yWqNRqFMcYCjeZuwkudOPm0rDBuLTPdrttkvwU">
                        <div class="row row-sm-offset">
                            <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                            <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12"></div>
                        </div>
                        <div class="dragArea row row-sm-offset">
                            <div class="col-md-4  form-group" data-for="name">
                                <label for="name-form1-5" class="form-control-label mbr-fonts-style display-7">Name</label>
                                <input type="text" name="name" data-form-field="Name" required="required" class="form-control display-7"
                                    id="name-form1-5">
                            </div>
                            <div class="col-md-4  form-group" data-for="email">
                                <label for="email-form1-5" class="form-control-label mbr-fonts-style display-7">Email</label>
                                <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7"
                                    id="email-form1-5">
                            </div>
                            <div data-for="phone" class="col-md-4  form-group">
                                <label for="phone-form1-5" class="form-control-label mbr-fonts-style display-7">Phone</label>
                                <input type="tel" name="phone" data-form-field="Phone" class="form-control display-7"
                                    id="phone-form1-5">
                            </div>
                            <div data-for="message" class="col-md-12 form-group">
                                <label for="message-form1-5" class="form-control-label mbr-fonts-style display-7">Message</label>
                                <textarea name="message" data-form-field="Message" class="form-control display-7" id="message-form1-5"></textarea>
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