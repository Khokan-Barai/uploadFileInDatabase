<?
$SESS_DBHOST = "localhost";			
$SESS_DBNAME = "test";				
$SESS_DBUSER = "root";				
$SESS_DBPASS = "";
$db = mysqli_connect($SESS_DBHOST, $SESS_DBUSER,$SESS_DBPASS,$SESS_DBNAME);  
?>
<?
    if(isset($_POST["submit"])){
        $uploadOk = 1;
        $path = "uploads/";
        $fileName = $path.($_FILES['file']['name']);

        $imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

        //$newName = $path . time().mt_rand(1000000000, mt_getrandmax()).".".$imageFileType;

        // Allow certain file formats
        if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf"
                && $imageFileType != "jpg" ) {
            $uploadOk = 0;
        }

        if($uploadOk == 0){
            echo "Sorry, only Doc, PDF, JPG files are allowed.";
        }else{
            if(file_exists($fileName)){
                echo "Sorry, file already exists.";
            }else{
                move_uploaded_file($_FILES['file']['tmp_name'],$fileName);

                $sql = "INSERT INTO file_check (file) VALUES ('$fileName')";
                if(mysqli_query($db, $sql))echo "DATA is successfully inserted";
                    else echo "There was a problem in DATA entry";
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
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file" id="file">
    <input type="submit" value="Save" name="submit">
    </form>

</body>
</html>