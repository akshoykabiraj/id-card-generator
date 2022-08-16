<?php
$sname = "localhost";

$unmae = "root";

$password = "";

$db_name = "id";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {

    echo "";
} else {
    echo "";
}

$fn = $_POST["inputName"];
$email = $_POST["inputEmail"];
$ph = $_POST["inputPhone"];
$add = $_POST["inputAddress"];
$blood = $_POST['inputBLG'];
$gen = $_POST["gender"];
$dob = $_POST["inputDOB"];
$id = $_POST["inputID"];
$dept = $_POST["inputDept"];
$filename = $_FILES["img"]["name"];
$tempname = $_FILES["img"]["tmp_name"];
$folder = "./picture/" . $filename;

list($width, $height) = getimagesize($tempname);

$src = imagecreatefromstring(file_get_contents($tempname));
$dst = imagecreatetruecolor(100, 100);
imagecopyresampled($dst, $src, 0, 0, 0, 0, 100, 100, $width, $height);
imagejpeg($dst, $tempname,); // adjust format as needed
imagedestroy($src);
imagedestroy($dst);

$selid = "select * from id_cards where ID ='$id'";
$res = mysqli_query($conn, $selid);
$chkid = mysqli_num_rows($res);
if ($chkid >= 1) {
    echo "ID already exists !";
} else {
    $query = "INSERT INTO id_cards (name,email,phone,address,blood,gender,dob,dept,ID,file) VALUES 
                    ('$fn', '$email', '$ph', '$add','$blood','$gen', '$dob', '$dept','$id', '$filename')";
    $run = mysqli_query($conn, $query);
    if ($run) {
        echo "";
    } else {
        echo "";
    }
}

if (move_uploaded_file($tempname, $folder)) {
    echo "";
} else {
    echo "";
}

//    mysqli_fetch_assoc($run);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>   
<title>ids</title>
</head>
<style>

    .container {
        width: 480px;
        height: 280px;
        background-image:url('back.jpg');
        background-repeat: no-repeat;
        border-radius: 10px;
        border: 1px dashed black;
        -webkit-print-color-adjust: exact;
    }   
</style>

<body>
<div class="container" id="idcard">
    <?php

    $query2 = "SELECT * FROM id_cards WHERE id = $id";
    $q = mysqli_query($conn, $query2);
    $details = mysqli_fetch_assoc($q);

    ?>
            <h3 style="text-align: center"><img src="logo.jpg" style="-webkit-print-color-adjust: exact;"> Dr.B C Roy Engineering College</h3>
    <span style="text-align: center">Jemua Road,Fuljhore Durgapur-713206 Mail-info@bcrec.ac.in</span>
            <h6 style="text-align: center">IDENTITY CARD</h6><br>
            <div class="row">
                <div class="col-3">
                    <img src="./picture/<?php echo $filename; ?>"
                    style="box-shadow: 2px 5px 9px #888888;border-radius: 10px;">
                </div>
                <div class="col-9">
                <span><b>I.D. No.:</b> <?php echo $details['ID'] ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span><b>Dept:</b> <?php echo $details['dept'] ?></span>
                    <h6><b>Name:</b> <?php echo $details['name'] ?></h6>
                    <h6><b>Address:</b> <?php echo $details['address'] ?></h6>
                    <span><b>D.O.B.:</b> <?php echo $details['dob'] ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span><b>Blood Group:</b> <?php echo $details['blood'] ?></span>
                    <h6><b>Phone Number:</b> <?php echo $details['phone'] ?></h6>
                </div>
            </div>
            
</div>
<p>hello</p>
<button class="btn btn-primary" id="download">Download</button>
</body>

<script>
    window.onload = function(){
        document.getElementById("download").addEventListener("click",()=>{
                const icard = this.document.getElementById("idcard");
                html2pdf().from(icard).save();
        })
    }
</script>

</html>