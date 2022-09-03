<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Download video</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function scroll() {
            const element = document.getElementById('cons');
            element.scrollTop = element.scrollHeight;
        }
    </script>
</head>
<body>
<section class="login">
    <section class="login_box">
        <div class="left">
            <div class="contact">
                <form method="post">
                    <h3>Télécharger une vidéo</h3>
                    <input type="text" name="video_link" placeholder="URL">
                    <button id="submit" class="submit" name="submit" type="submit">Télécharger</button>
                </form>
            </div>
        </div>

        <div class="right cons" id="cons">
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

    foreach(glob('./video/*.*') as $path) {
        $filename = substr($path, 8);
        $p = urlencode($path);
        echo "<p><a href='download.php?f=$p'>Télécharger $filename</a></p>";
        echo '<script>scroll()</script>';
    }

    echo "
</div>";

}
?>
        </div>
    </section>
</body>