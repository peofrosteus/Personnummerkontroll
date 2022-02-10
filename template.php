<!DOCTYPE html>
<html lang="en">
<title><?php print $title; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>



<!-- Header -->
<header class="w3-container w3-grey w3-center" style="padding:128px 16px">
  <h1 class="w3-margin"><?php print $title?></h1>
  <p class="w3-xlarge">
    <form action="index.php" method=post>
        Ange personnummer i format YYMMDD-NNNN</p>
        <input type = "text" name = "personnummer" required="Du måste ange ett personnummer"><br/>
        <input type = "submit" value = "kontrollera" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">
        </form>
    <p><?php print $message; ?></p>
    </p>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Exempel</h1>
      <h5 class="w3-padding-32">Giltiga personnummer</h5>
      <table class="w3-table-all">
          <tr>
              <td>640823-3234</td>
              <td>Exempel från Skatteverket</td>
          </tr>
          <tr>
              <td>811218-9876</td>
              <td>Exempel från Wikipedia</td>
          </tr>
          <tr>
              <td>040229-0001</td>
              <td>Skottdagen 2004</td>
          </tr>
          <tr>
              <td>701063-2391</td>
              <td>Samordningsnummer</td>
          </tr>
          <tr>
              <td>900101+0009</td>
              <td>Mer än 100 år gammal, född 1890</td>
          </tr>          
      </table>

      <p class="w3-text-grey"></p>
      <h5 class="w3-padding-32">Ej giltiga personnummer</h5>
      <table class="w3-table-all">
          <tr>
              <td>640823-3233</td>
              <td>Ogiltig kontrollsiffra</td>
          </tr>
          <tr>
              <td>811218-9875</td>
              <td>Ogiltig kontrollsiffra</td>
          </tr>
          <tr>
              <td>030229-0002</td>
              <td>skottdagen 2003</td>
          </tr>
      </table>      

      <p class="w3-text-grey"></p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa far fa-address-card w3-padding-64 w3-text-red" style='font-size:200px'></i>
    </div>
  </div>
</div>

<!--
<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
</div>
-->

<!-- Footer -->

<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
<!--    
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
 </div>
-->
<p>
    <a href="https://sv.wikipedia.org/wiki/Personnummer_i_Sverige">Läs mer om personummer på Wikipedia</a><br/>
    <a href="https://www.skatteverket.se/privat/folkbokforing/personnummerochsamordningsnummer.4.3810a01c150939e893f18c29.html?q=personnummer">Läs mer om personummer hos Skatteverket</a>
</p>
 <p>Av: <a href="https://www.peo.nu" target="_blank">Peo Frosteus</a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
