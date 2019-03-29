<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>Article</title>
    
    <?php
        require 'importscripts.php';
    ?>
</head>

<body>
    <?php
        session_start();
        require 'config.php';

        $id = (int) $_GET['id'];
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, "select date, header, description, content, picture from articles where articleID=?")) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $date, $head, $desc, $content, $picPath);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
        require 'header.php';
    ?>

    <section class="mbr-section content5 cid-rlfmPmBlIs mbr-parallax-background" id="content5-e"
        style="background-image: url('<?php echo $picPath?>')">
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 col-md-8">
                    <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-1"><?php echo $head ?></h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5"><?php echo $desc ?></h3>
                </div>
            </div>
        </div>
    </section>

    <section class="mbr-section article content1 cid-rlfocgvZ4q" id="content1-g">
        <div class="container">
            <div class="media-container-row">
                <div class="mbr-text col-12 mbr-fonts-style display-7 col-md-8"><?php echo $content ?></div>
            </div>
        </div>
    </section>

    <section class="mbr-section article content1 cid-rlfDoXtMIw" id="content1-w">
        <div class="container">
            <div class="media-container-row">
                <div class="mbr-text col-12 mbr-fonts-style display-7 col-md-8">
                    <p><strong>Check out our <a href="disclaimer.php">Disclaimer</a>.</strong></p>
                </div>
            </div>
        </div>
    </section>

    <section class="cid-rlfmFuox6H" id="social-buttons3-d">
        <div class="container">
            <div class="media-container-row">
                <div class="col-md-8 align-center">
                    <h2 class="pb-3 mbr-section-title mbr-fonts-style display-2">
                        SHARE THIS ARTICLE!
                    </h2>
                    <div>
                        <div class="mbr-social-likes">
                            <span class="btn btn-social socicon-bg-facebook facebook mx-2" title="Share link on Facebook">
                                <i class="socicon socicon-facebook"></i>
                            </span>
                            <span class="btn btn-social twitter socicon-bg-twitter mx-2" title="Share link on Twitter">
                                <i class="socicon socicon-twitter"></i>
                            </span>
                            <span class="btn btn-social plusone socicon-bg-googleplus mx-2" title="Share link on Google+">
                                <i class="socicon socicon-googleplus"></i>
                            </span>
                            <span class="btn btn-social vkontakte socicon-bg-vkontakte mx-2" title="Share link on VKontakte">
                                <i class="socicon socicon-vkontakte"></i>
                            </span>
                            <span class="btn btn-social odnoklassniki socicon-bg-odnoklassniki mx-2" title="Share link on Odnoklassniki">
                                <i class="socicon socicon-odnoklassniki"></i>
                            </span>
                            <span class="btn btn-social pinterest socicon-bg-pinterest mx-2" title="Share link on Pinterest">
                                <i class="socicon socicon-pinterest"></i>
                            </span>
                            <span class="btn btn-social mailru socicon-bg-mail mx-2" title="Share link on Mailru">
                                <i class="socicon socicon-mail"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
        require 'footer.php';
    ?>
</body>
</html>