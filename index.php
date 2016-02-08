<?php

/* Define your constant terms here */
define('DEFAULTFILENAME', 'caught.txt');
define('FILECOMMAND', 'file');
define('TEXTCOMMAND', 'text');
define('CLEARCOMMAND', 'clear');
define('HIDECOMMAND', 'hide');
/***********************************/

$filename = isset($_GET['file']) ? $_GET['file'] : DEFAULTFILENAME;

if (!file_exists($filename) or isset($_GET[CLEARCOMMAND])){
    $file = fopen($filename, "w") or die("Unable to open file"); fclose($file);
}

if(isset($_GET[TEXTCOMMAND])) {
    $file = fopen($filename, "a") or die("Unable to open file"); fwrite($file, $_GET[TEXTCOMMAND] . "\n"); fclose($file);
}

if(isset($_GET[HIDECOMMAND])) {
    die();
}

$file = fopen($filename, "r") or die("Unable to open file");
$content = filesize($filename) != 0 ? fread($file, filesize($filename)) : "";
fclose($file);

$contents = array_reverse(explode("\n", $content));
$filelist = scandir(".");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nyolong gan!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
        iframe { background-color:#eee; border:1px solid #ddd; width:100%;}
        .card-panel, .card .card-content { padding-top: 5px; }
        .textarea { border: 1px solid #ddd; background-color: #eee; width: 100%; height: 80px; color: #77b; padding: 5px;}
        .collection a.collection-item { transition: none;}
        small {color: #999; padding-left: 5px;}
    </style>
</head>
<body class="grey lighten-3">

    <div class="row">

        <div class="col s12 l6 push-l3">
            <div class="card-panel">
                <h5>Caught texts</h5>
                <div class="collection">
                    <?php foreach($contents as $c): ?>
                        <a class="collection-item"><?php echo $c; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


        <div class="col s12 l3 pull-l6">
            <div class="row">
                <div class="col s12 m6 l12">
                    <div class="card-panel">
                        <h5>file lists</h5>
                        <div class="collection">
                            <?php foreach ($filelist as $f):
                                    if ($f == '.' or $f == '..' or $f == 'index.php') continue; ?>
                                <a class="collection-item" href="?file=<?php echo $f;?>"><?php echo $f; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l12">
                    <div class="card-panel">
                        <h5>How to use</h5>
                        <small>use GET parameters below to do things</small>
                        <table class="bordered">
                            <tr>
                                <td><b><?php echo FILECOMMAND; ?></b></td>
                                <td>filename to save caught text</td>
                            </tr>
                            <tr>
                                <td><b><?php echo TEXTCOMMAND; ?></b></td>
                                <td>text to catch, appended to file</td>
                            </tr>
                            <tr>
                                <td><b><?php echo CLEARCOMMAND; ?></b></td>
                                <td>clear all texts in specified file</td>
                            </tr>
                            <tr>
                                <td><b><?php echo HIDECOMMAND; ?></b></td>
                                <td>do not show anything in page</td>
                            </tr>
                        </table>
                        <?php
                            $url = strtok($_SERVER["REQUEST_URI"],'?');
                            $url = "http://$_SERVER[HTTP_HOST]$url" . '?filename=' . $filename . '&text=';
                            echo '<textarea class="textarea">' . $url . '</textarea>';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 l3">
            <div class="row">
                <div class="col s12 m6 l12">
                    <div class="card">
                        <div class="card-content">
                            <h5>raw: <a href="<?php echo $filename;?>"><?php echo $filename; ?></a></h5>
                            <iframe src="<?php echo $filename;?>"></iframe>
                        </div>
                        <div class="card-action">
                            <a href="<?php echo $filename; ?>">see raw</a>
                            <a href="?clear">clear</a>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Cheatsheet</h5>
                            <p>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
