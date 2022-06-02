<?php

if(isset($_POST["lienSubmit"])) {
    $a_link = $_POST["link"];

    switch ($_POST['algo']) {
        case 'textblob':
            $commande = '"C:/Program Files/Python310/python.exe" c:/xampp/htdocs/SentimentAnalysis/python/methode_text_blob.py -l "'.$a_link.'"';
            break;

        case 'classique':
            $commande = '"C:/Program Files/Python310/python.exe" c:/xampp/htdocs/SentimentAnalysis/python/methode_classique.py -l "'.$a_link.'"';
            break;
        
        default:
            die();
    }
    $output = shell_exec($commande);
    // print "$output<br>";
    $output = (float)substr($output, 0, -1);
}
elseif (isset($_POST["fileSubmit"])) {
    switch ($_POST['algo']) {
        case 'textblob':
            $commande = '"C:/Program Files/Python310/python.exe" c:/xampp/htdocs/SentimentAnalysis/python/methode_text_blob.py -f';
            break;

        case 'classique':
            $commande = '"C:/Program Files/Python310/python.exe" c:/xampp/htdocs/SentimentAnalysis/python/methode_classique.py -f';
            break;
        
        default:
            die();
    }
    $fileName = $_FILES["file"]["name"];
    $fileSize = $_FILES["file"]["size"];
    $fileTmp = $_FILES["file"]["tmp_name"];
    $err = $_FILES["file"]["error"];
    $extension = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
    if($extension == "txt") {
        if ($err == 0) {
            $fileName = "myText.txt";
            $chemin = "python/myText.txt";

            if(file_exists($chemin)) {
                unlink('./'.$chemin);
            }

            if(move_uploaded_file($fileTmp, $chemin)) {
                $output = shell_exec('"C:/Program Files/Python310/python.exe" c:/xampp/htdocs/SentimentAnalysis/python/methode_text_blob.py -f');
                
                // print "$output <br>";
                $output = (float)substr($output, 0, -1);
            }            
            else{
                $msg = "Erreur de telechargement du fichier.";
            }
        }
        else {
            $msg = "Erreur de telechargement du fichier";
        }
    }
    else {
        $msg = "Extension non acceptee";
    }
}
// var_dump($output);

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la détection des sentiments</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    
</head>
<body>
    
    <div class="container my-5 mx-auto p-4">

    <?php if ($output < -0.4) {?>
        <div class="row p-1">
            <div class="col align-content-center">
                <img src="image/tnegatif.png" class="rounded mx-auto d-block mb-2" alt="Très négatif" width="200" height="auto">
            </div>
        </div>
        <div class="result alert alert-danger">
            <p> Le sentiment détecté est <strong>très négatif.</strong></p>
            <p> La valeur est <strong> <?php echo $output; ?></strong></p> 
        </div>
    <?php } elseif (($output >= -0.4) && ($output < -0.1)) {?>
        <div class="row p-1">
            <div class="col align-content-center">
                <img src="image/negatif.png" class="rounded mx-auto d-block mb-2" alt="Négatif" width="200" height="auto">
            </div>
        </div>
        <div class="result alert alert-warning">
            <p> Le sentiment détecté est <strong>négatif.</strong></p>
            <p> La valeur est <strong> <?php echo $output; ?></strong></p> 
        </div>
    <?php } elseif (($output >= -0.1) && ($output < 0.1)) {?>
        <div class="row p-1">
            <div class="col align-content-center">
                <img src="image/neutre.png" class="rounded mx-auto d-block mb-2" alt="Neutre" width="200" height="auto">
            </div>
        </div>
        <div class="result alert alert-primary">
            <p> Le sentiment détecté est <strong>neutre.</strong></p>
            <p> La valeur est <strong> <?php echo $output; ?></strong></p> 
        </div>
    <?php } elseif (($output >= 0.1) && ($output < 0.4)) {?>
        <div class="row p-1">
            <div class="col align-content-center">
                <img src="image/positif.png" class="rounded mx-auto d-block mb-2" alt="Positif" width="200" height="auto">
            </div>
        </div>
        <div class="result alert alert-info">
            <p> Le sentiment détecté est <strong>positif.</strong></p>
            <p> La valeur est <strong> <?php echo $output; ?></strong></p> 
        </div>
    <?php } else {?>
        <div class="row p-1">
            <div class="col align-content-center">
                <img src="image/tpositif.png" class="rounded mx-auto d-block mb-2" alt="Très positif" width="200" height="auto">
            </div>
        </div>
        <div class="result alert alert-success">
            <p> Le sentiment détecté est <strong>très positif.</strong></p>
            <p> La valeur est <strong> <?php echo $output; ?></strong></p> 
        </div>
    <?php } ?>

    <a href="/SentimentAnalysis/" class="btn btn-success"> Réessayer ! </a>
    
    </div>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/hiddeTheButton.js"></script>
</body>
</html>