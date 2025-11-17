<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <!-- <p>Enter you text or URL</p>
    <input type="text" placeholder="Text or URL" id="qrText"> -->
        
    <div id="imgBox">
        <img src="" id="qrImage">
    </div>


    <button onclick=" GenerateQR()">Generate QR Code</button>
</div>

<script>
let imgBox = document.getElementById("imgBox");
let qrImage = document.getElementById("qrImage");


function GenerateQR(){


//   if(qrText.value.length>0){

   qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://localhost/MyCarev1.1/QrGenerator/patientform.php";
     
   imgBox.classList.add("show-img");
// }
// else{
//     qrText.classList.add('error');
//        setTimeout(()=>{
//         qrText.classList.remove('error');
//        },1000);
 //}
// }
}

</script>
    
</body>

</html>