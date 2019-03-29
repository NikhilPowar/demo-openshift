<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/thought-2123970-1920-122x85.jpg" type="image/x-icon">

    <title>ArticleEditor</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php
        require 'importscripts.php';
    ?>
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION['username'])){
            echo "You must be logged in as admin to access this page";
            echo '<a href="adminlogin.php">Login Here</a>';
            echo 'Or else <a href="index.php">Go to homepage</a>';
            exit("");
        }

        require 'config.php';

        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $headErr = $descErr = $contentErr = $picErr = "";
        $head = $desc = $content = $pic = "";
        $targetDir = "pictures/";
        $new = FALSE;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['del'])){
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, "delete from articles where articleID=?")) {
                    mysqli_stmt_bind_param($stmt, "i", $artID);
                    $artID = $_POST['id'];
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    header('Location: http://localhost/ThoughtBlog/adminhome.php');
                    die();
                }
            }
            $head = $_POST["head"];
            $desc = $_POST["desc"];
            $content = $_POST["content"];
            $pic = $_FILES["picture"]["name"];
            $imageFileType = strtolower(pathinfo(basename($pic),PATHINFO_EXTENSION));

            if($imageFileType != "jpg" and $imageFileType != "png" and $imageFileType != "jpeg" and $imageFileType != "gif" and $imageFileType != "bmp") {
                $picErr = "Only JPG, JPEG, PNG, BMP & GIF files are allowed.";
            }
            if (strcmp($picErr, '')==0) {
                if ($id === NULL) {
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, "select max(articleID) from articles")) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $artID);
                        mysqli_stmt_fetch($stmt);
                        $id = $artID + 1;
                        if(!isset($artID)){
                            $id = 1;
                        }
                        mysqli_stmt_close($stmt);
                    }
                    $new = TRUE;
                }
                $picPath = $targetDir.$id.".".$imageFileType;
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $picPath)) {
                } else {
                    $picErr = "An error occured while uploading your file.";
                }
            }

            if(strcmp($headErr, "")==0 and strcmp($descErr, "")==0 and strcmp($contentErr, "")==0 and strcmp($picErr, "")==0){
                $stmt = mysqli_stmt_init($conn);
                if (!$new) {
                    mysqli_stmt_prepare($stmt, "update articles set date=now(), header=?, description=?, content=?, picture=? where articleID=?");
                } else {
                    mysqli_stmt_prepare($stmt, "insert into articles(date, header, description, content, picture, articleID) values(now(), ?, ?, ?, ?, ?)");
                }
                mysqli_stmt_bind_param($stmt, 'ssssi', $h, $d, $c, $p, $i);
                $h = $head;
                $d = $desc;
                $c = $content;
                $p = $picPath;
                $i = $id;
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header('Location: http://localhost/ThoughtBlog/adminhome.php');
                die();
            }
        } else if ($id !== NULL) {
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, "select header, description, content, picture from articles where articleID=?")) {
                mysqli_stmt_bind_param($stmt, 'i', $ID);
                $ID = $id;
                echo $ID;
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $head, $desc, $content, $pic);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            }
        }
        require 'header.php';
    ?>

    <section class="header1 cid-rlgCXUKYPm" id="header16-1g">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-10 align-center">
                    <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                        ARTICLE EDITOR</h1>
                    <p class="mbr-text pb-3 mbr-fonts-style display-5">Create an article to articulate your thoughts!</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mbr-section form1 cid-rlgDFyxZkg" id="form1-1h">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid">
                    <!---Formbuilder Form--->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="mbr-form form-with-styler"
                        data-form-title="Mobirise Form" enctype="multipart/form-data">
                        <input type="hidden" name="email" data-form-email="true" value="k1LxhAbqOtaFY7efcXdYcd0aoeCJxiSaKTHmiseo/JelKuyOUZiRKkGHh1qoXkuxTim01hAj9nHMyLuqoTRdGFu4MSiAHDPDOv9NVUv/wPo8+zU9+9eKi7nxoCuRhtno">
                        <div class="row row-sm-offset">
                            <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Submitted!</div>
                            <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12"><?php echo isset($picErr) ? $picErr : '' ?></div>
                        </div>
                        <div class="dragArea row row-sm-offset">
                            <div class="col-md-4  form-group" data-for="head">
                                <label for="head" class="form-control-label mbr-fonts-style display-7">Title</label>
                                <input type="text" name="head" data-form-field="Header" required="required" class="form-control display-7"
                                    value="<?php echo isset($head) ? $head : '' ?>" id="head">
                            </div>
                            <div class="col-md-4  form-group" data-for="desc">
                                <label for="desc" class="form-control-label mbr-fonts-style display-7">Short Description</label>
                                <input type="text" name="desc" data-form-field="Description" required="required" class="form-control display-7"
                                    value="<?php echo isset($desc) ? $desc : '' ?>" id="desc">
                            </div>
                            <div data-for="picture" class="col-md-4  form-group">
                                <label for="picture" class="form-control-label mbr-fonts-style display-7">Picture</label>
                                <input type="file" name="picture" data-form-field="Picture" required="required" class="form-control display-7"
                                    value="<?php echo isset($pic) ? $pic : '' ?>" id="picture">
                            </div>
                            <div data-for="content" class="col-md-12 form-group">
                                <label for="content" class="form-control-label mbr-fonts-style display-7">Content</label>
                                <textarea name="content" data-form-field="Content" required="required" class="form-control display-7"
                                id="content"><?php echo isset($content) ? $content : '' ?></textarea>
                            </div>
                            <div class="col-md-12 input-group-btn align-center">
                                <button type="submit" class="btn btn-primary btn-form display-4">SAVE ARTICLE</button>
                                <button type="reset" class="btn btn-warning btn-form display-4">RESET</button>
                                <?php if (isset($_GET['id'])) {
                                    echo '<button type="button" onclick="deleteArticle(<?php echo $id ?>)" class="btn btn-danger btn-form display-4">DELETE ARTICLE</button>';
                                } ?>
                                <button type="button" onclick="toAdminHome()" class="btn btn-info btn-form display-4">CANCEL</button>
                            </div>
                        </div>
                    </form>
                    <!---Formbuilder Form--->
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" language="javascript">
        var toAdminHome = function() {
            window.location = "http://localhost/ThoughtBlog/adminhome.php";
        }

        var deleteArticle = function(articleID) {
            var r = confirm("Warning: Are you sure you want to delete this article? This cannot be undone.");
            if (r == true) {
                $.ajax({
                    url: 'http://localhost/ThoughtBlog/articleeditor.php',
                    type: 'POST',
                    data: {
                        id: articleID,
                        del: 'true'
                    },
                    success: function (msg){
                        window.location = "http://localhost/ThoughtBlog/adminhome.php";
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                });
            } else {
                return;
            }
        }
    </script>
    
    <?php
        require 'footer.php';
    ?>
</body>
</html>