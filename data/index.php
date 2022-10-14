<?php
// $readDir = '../data'.DIRECTORY_SEPARATOR;
// $readDir = '..'; //الفولدر اللي عاوز اخرجله
// $readDir = '.'; //الفولدر اللي واققف فيه
$readDir = __DIR__; //abs path للي انا وقف فيه 
$basePath = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']);
$imagesPath = $basePath."/images/";
$dataPath = $basePath."/data/";

// REQUEST_URI:                        "/AdvancedCourse/5-%20DiscoverFiles/data/"
// dirname($_SERVER['REQUEST_URI'])    "/AdvancedCourse/5-%20DiscoverFiles/"
// var_dump($_SERVER);die;
 
$readFiles = scandir($readDir);

prepareDir($readFiles);
function prepareDir(array &$readFiles){
    array_splice($readFiles,0,2); // delete . , ..
    array_splice($readFiles,array_search('index.php',$readFiles),1); // delete index.php
}

function getImage(string $file) :string{
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    if($extension === " "){    
       return 'folder.png';
        
    }else{
        switch ($extension) {
            case 'php':
                return 'php.png';
            case 'txt':
                return 'file.png'; 
            case 'doc':
            case 'docx':                        
                return 'word.png';
            // case 'png':
                //     return 'default.png';
            case 'pdf':
                return 'pdf.png';
            case 'html':
                return 'html.png';
            default:
                return 'default.png';
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container flex">
        <div class="row">
            <div class="col-12 text-center text-dark my-5 h1">
                <?= basename($readDir) ?>
            </div>
            <?php foreach($readFiles As $file): ?>
            <div class="col-2">
                <a href="<?= $dataPath . $file ?>" >
                    <div class="card text-left">
                        <!-- we use this relative path -->
                        <!-- http://localhost/AdvancedCourse/5-%20DiscoverFiles/images/folder.png -->
                        
                        <img class="w-100 card-img-top" src="<?= $imagesPath.getImage($file)?>" alt="">
                        <div class="card-body">
                            <h4 class="card-title"><?= $file ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script> 
</body>
</html>