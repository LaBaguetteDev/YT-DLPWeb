<?php

if(isset($_POST['submit'])) {
    $url = $_POST['video_link'];
    $command = "yt-dlp $url -P /var/www/html/www.labaguettedev.live/dl/video";


    ob_implicit_flush(true);
    ob_end_flush();

    $descriptorspec = array(
        0 => array("pipe", "r"),
        1 => array("pipe", "w"),
        2 => array("pipe", "w")
    );
    flush();
    $process = proc_open($command, $descriptorspec, $pipes, realpath('./'), array());
    $output = '';
    if(is_resource($process)) {
        while($s = fgets($pipes[1])) {
            echo $s . '<br>';
            $output .= $s;
            flush();
        }
    }
    $firstchar = strpos($output, '/var/www/html/www.labaguettedev.live/dl/video/') +46;
    $secondchar = strpos($output, '[download]', $firstchar);
    $filename = substr($output, $firstchar, $secondchar - $firstchar);
    $path = 'video/'.$filename;
    echo 'Opération terminée';
    echo '<a id="link" href="'. $path .'" download="">Télécharger</a>';

}
?>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Download video</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Font-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .formSmall {
            width: 700px;
            margin: 20px auto 20px auto;
        }

        .texto {
            visibility: hidden;
        }
    </style>
    <script type="text/javascript">
        $.when($.ready).then(function () {
            $(".btn").on("click", () => {
                $(".texto").css("visibility", "visible");
            })
        })
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

        <p class="texto">Traitement en cours, ceci peut durer jusqu'à plusieurs minutes...</p>
    </form>
</div>

</body>