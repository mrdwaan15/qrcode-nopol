<!DOCTYPE html>
<html>
<head>
<script src="jquery.min.js"></script>    
<script src="html2canvas.js"></script> 
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<style>
    #html-content-holder 
    {
      position: relative;
    }
    .centered {
  position: absolute;
  top: 190px;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
</head>
<body>

    
    <div class="container">
      
    </div>

    <?php

 include "phpqrcode/qrlib.php"; 
  $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    //ambil logo
    $logopath="logo_new.png";

 //isi qrcode jika di scan
 $codeContents = 'https://dashboard.my-pertamina.id/'; 

 //simpan file qrcode
 QRcode::png($codeContents, $tempdir.'qrwithlogo.png', QR_ECLEVEL_H, 10,4);


 // ambil file qrcode
 $QR = imagecreatefrompng($tempdir.'qrwithlogo.png');

 // memulai menggambar logo dalam file qrcode
 $logo = imagecreatefromstring(file_get_contents($logopath));
 
 imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
 imagealphablending($logo , false);
 imagesavealpha($logo , true);

 $QR_width = imagesx($QR);
 $QR_height = imagesy($QR);

 $logo_width = imagesx($logo);
 $logo_height = imagesy($logo);

 // Scale logo to fit in the QR Code
 $logo_qr_width = $QR_width/2;
 $scale = $logo_width/$logo_qr_width;
 $logo_qr_height = $logo_height/$scale;

 imagecopyresampled($QR, $logo, $QR_width/3.3, $QR_height/2.4, 0, 0, $logo_qr_width/1.2, $logo_qr_height/1.1, $logo_width, $logo_height);

 // Simpan kode QR lagi, dengan logo di atasnya
 imagepng($QR,$tempdir.'qrwithlogo.png');

  //menampilkan file qrcode 
 echo '<div id="html-content-holder" align="center">';
 echo '<div class="centered"><h2>B 3219 SJW</h2></div>';
 echo '<img src="'.$tempdir.'qrwithlogo.png'.'" /></div>';
 echo '</div>';


 ?>
        <div align="center">
           <a id="btn-Convert-Html2Image" href="#"><button>Download</button></a> </div>
           <div id="previewImage">
        </div>
    <script> 

        $("#btn-Convert-Html2Image").on('click', function () {
        html2canvas(document.getElementById("html-content-holder"),		{
        }).then(function (canvas) {
            var anchorTag = document.createElement("a");		
                anchorTag.download = "filename.jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.click();
        });
    });
            
    </script> 
    </body>
    </html> 
    