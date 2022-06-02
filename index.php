<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détection des sentiments</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="row justify-content-center">
        <img src="image/50131cover.jpg" alt="Une image" style="width:500px;"> <br>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <div class=" d-flex justify-content-center">       
                <div class="btn btn-outline-primary" id="btnLien" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Lien (Url)
                </div>          
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-center">
                <div class="form-group">
                    <label for="algo">Choisissez quel algorithme préfériez-vous</label>
                    <select class="form-select mt-1" id="select-algo">
                        <option value="classique">Classique</option>
                        <option value="textblob">Text Blob</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class=" d-flex justify-content-center">       
                <div class="btn btn-outline-primary" id="btnFichier" data-bs-toggle="collapse" data-bs-target="#collapseExampleFile" aria-expanded="false" aria-controls="collapseExampleFile">
                    Ficher text
                </div>          
            </div>
        </div>
    </div>
    
    

    
    <div class="collapse" id="collapseExample">
        <div class="container w-50 mt-5">
            <form action="result.php" method="post">
                <div class="form-group">
                    <label for="">Donner le lien :</label>
                    <input class="form-control mt-2" type="url" placeholder="lien..." name="link">
                </div>

                <input type="hidden" name="algo" value="classique">
                <input type="submit" name="lienSubmit" class="d-block btn btn-primary mt-2" value="Submit">
                
            </form>
        </div>
    </div>
    
    <div class="collapse" id="collapseExampleFile">
        <div class="container w-50 mt-5">
            <form action="result.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Charger le fichier text :</label>
                    <input class="form-control mt-2" type="file" name="file">
                </div>

                <input type="hidden" name="algo" value="classique">
                <input type="submit" name="fileSubmit" class="d-block btn btn-primary mt-2" value="Submit">
                
            </form>
        </div>
    </div>
    
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/hiddeTheButton.js"></script>
    <script>
        document.getElementById("select-algo").addEventListener("change", function () {
            document.getElementsByName('algo')[0].value = document.getElementById("select-algo").value;
            document.getElementsByName('algo')[1].value = document.getElementById("select-algo").value;

            console.log("document.getElementsByName('algo')[0].value = " + document.getElementsByName('algo')[0].value)
            console.log("document.getElementsByName('algo')[1].value = " + document.getElementsByName('algo')[1].value)
        });
    </script>
</body>
</html>