<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Download video</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.css" rel="stylesheet">
    <script type="application/javascript">
        function scroll() {
            const element = document.getElementById('cons');
            element.scrollTop = element.scrollHeight;
        }
    </script>
</head>
<body>
<div class="container">
    <form method="post" action="" class="formSmall">
        <div class="row">
            <div class="col-lg-12">
                <h7 class="text-align"> Download Video</h7>
            </div>
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" name="video_link" placeholder="Paste link.." <?php if(isset($_POST['video_link'])) echo "value='".$_POST['video_link']."'"; ?>>
                    <span class="input-group-btn">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary click">Go!</button>
                      </span>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="cons" id="cons">
<?php

if(isset($_POST['submit'])) {
    $url = $_POST['video_link'];
    $command = " yt-dlp -P /var/www/html/www.labaguettedev.live/dl/video $url";
    while(@ ob_end_flush());
    $proc = popen($command, 'r');
    while (!feof($proc)) {
        echo '<p>' . fread($proc, 4096) . '</p>';
        echo '<script>scroll()</script>';
        @ flush();
    }



    echo "
</div>";

    foreach(glob('./video/*.*') as $path) {
        $filename = substr($path, 8);
        $p = urlencode($path);
        echo "<p><a href='download.php?f=$p'>Télécharger $filename</a></p>";
    }

}
?>
</body>