<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Upload</title>
</head>



<?php	

$n=10; 
function getName() { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < 10; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 


$i=0;
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    foreach ($_FILES['fichier']['error'] as $error) 
    {  
    	if (isset($_FILES) && $error === 0)
        { 

        	$allowedtype = ['image/jpeg', 'image/png', 'image/gif'];
        	$filename =	$_FILES['fichier']['name'][$i];
        	$filetmp = $_FILES['fichier']['tmp_name'][$i];	
        	$filetype =	$_FILES['fichier']['type'][$i];
        	$filesize =	$_FILES['fichier']['size'][$i];
            $i++;
        	$pathupload = "images/";
        	$errors = [];
        	$maxsize = 1000000;
        	// $fileerror = $_FILES['fichier']['error'];
        	$ext = pathinfo($filename, PATHINFO_EXTENSION);
        		if ($filesize > $maxsize) 
                {
        			$errors['size'] = "you file is too big";
        		}
        		if (!in_array($filetype, $allowedtype)) 
                {
        			$errors['type'] = "type not accepted";
        		}
        		if (file_exists($pathupload. $filename)) 
                {
        			$errors['exist'] = "your file alerady exist"; 
        		}
        	}
        	foreach ($errors as $error) 
            {
        		echo $error;
        	}
        	
    }
    if (empty($errors)) 
            {
                $finalfilename = "image" . getname() . "." . substr($filetype,6);
                $uploadfile = $pathupload . basename($finalfilename);
                move_uploaded_file($filetmp, $uploadfile);
            }
}	
?>

<form action="" method="POST" enctype="multipart/form-data"  multiple="multiple">
    <input type="file" name="fichier[]" multiple="multiple"/>
    <input type="submit" value="Send" />
</form>	

<form class="form-group" method="post" action="delete.php">
        <div class="row">
            <?php
            $files = glob('images/*.*');
            foreach ($files as $file) {?>
            <div class="col-3">
                <img src="<?= $file ?>" class="img-thumbnail"">
                <div>
                    <button class="btn btn-info" type="submit" name="image" value="<?= $file ?>">Delete</button>
                </div>
            </div>
            <?php }  ?>
        </div>
    </form>



<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>