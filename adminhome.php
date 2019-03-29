<!DOCTYPE html>
<html>

<head>S
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>AdminHome</title>
    
    <?php
        require 'importscripts.php';
    ?>
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION['username'])){
            echo "You must be logged in as admin to access this page. ";
            echo '<a href="adminlogin.php">Login Here</a>';
            echo ' or else <a href="index.php">go to homepage</a>.';
            exit("");
        }
        require 'header.php';
    ?>

    <section class="mbr-section info1 cid-rlgBfzefPv" id="info1-1c">
        <div class="container">
            <div class="row justify-content-center content-row">
                <div class="media-container-column title col-12 col-lg-7 col-md-6">
                    <h3 class="mbr-section-subtitle align-left mbr-light pb-3 mbr-fonts-style display-5">Write a new
                        article from scratch. Convey your thoughts!</h3>
                    <h2 class="align-left mbr-bold mbr-fonts-style display-2">
                        CREATE NEW ARTICLE</h2>
                </div>
                <div class="media-container-column col-12 col-lg-3 col-md-4">
                    <div class="mbr-section-btn align-right py-4"><a class="btn btn-primary display-4" href="articleeditor.php">NEW
                            ARTICLE</a></div>
                </div>
            </div>
        </div>
    </section>

    <section class="features18 popup-btn-cards cid-rleoZTMVJA" id="features18-1d">
        <div class="container">
            <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2"><strong>
                    EDIT ARTICLES</strong></h2>
            <h3 class="mbr-section-subtitle display-5 align-center mbr-fonts-style mbr-light">
                Edit previously written articles. Clarify your thoughts!</h3>
            <div class="media-container-row pt-5">
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
                                            <a href="articleeditor.php?id='.$id.'" class="btn btn-primary display-4">Edit</a>
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

    <?php
        require 'footer.php';
    ?>
</body>

</html>