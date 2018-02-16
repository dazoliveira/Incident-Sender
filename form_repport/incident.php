<?php
require_once('conexao.inc.php');
$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user, $pass);

$sql = 'SELECT * FROM `tb_customers_email`';
$stmt = $db->prepare($sql);
$stmt->execute();
$regs =  $stmt->fetchAll();



?>

<!DOCTYPE HTML>
<html lang="pt-BR">

<head>
<meta charset="utf-8">          
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Repport Incident</title>
<meta name="description" content="">            
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="css/layout_seq.css" rel="stylesheet" />
    <link href="css/mobile_seq.css" rel="stylesheet" />
</head>

<body>

    <article>

        <section>

            <form id="myForm" name="myForm" method="POST">
                    <h1>Create an Incident</h1>
                    <hr>

            <div id="erroName">*field was requierd</div>
                <label id="label" for="name">Incident Name:<small>*required</small></label><br/>
                <input type="text" name="name" id="name" required><br/>

            <div  id="erroMensagem">*field was requierd</div>
                <label id="label" for="mensagem">Message:<small>*required</small></label><br/>
                <textarea name="mensagem" id="mesagem" rows="4" cols="50" required></textarea><br><br /><br/>
<div id='submit'>
 <?php
 
 
foreach ($regs as $reg) {
	echo '<div id="erroEmail">*field was requierd</div><select id="email"  required ><option value="">--- Choose a email ---</option><option  value="'.$reg['email'].'">'.$reg['email'].'</option></select>';    
};                
?>            </form>

            <img src="img/botton_send.png" alt="envio do formulario" onclick="agradece(); verifica()">
</div>    
        <!-- <div id="agradece"></div> -->
        <div align="center" id="alerta"></div>

        </section>
       
    </article>


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

      <script>   

      var txtName = document.getElementById("name");
      var txtEmail = document.getElementById("email");
      var txtMensagem = document.getElementById("mesagem");
      var frm = document.getElementById("myForm");
       var divErroName = document.getElementById("erroName");
       var divErroEmail = document.getElementById("erroEmail");
       var divErroMensagem = document.getElementById("erroMensagem");


function agradece(){

   if (txtName.value != '' && txtEmail.value != ''  && txtMensagem.value != '') 

    {

 var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("alerta").innerHTML = this.responseText;
                  
                    frm.reset();
                }
            }
            xmlhttp.open("POST", "contato.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send("name="+ txtName.value +
                         "&email=" + txtEmail.value + 
                         "&mensagem="+ txtMensagem.value);

    } 
    else { alert("Um ou mais campos não foram preenchidos!!\nFavor verificar e tentar novamente")}       

    
};

function verifica(){     

    divErroName.style.visibility="hidden";
    divErroEmail.style.visibility="hidden";
    divErroMensagem.style.visibility="hidden"; 

    if (txtName.checkValidity() == false) {
        divErroName.style.visibility= "visible";
    }

    if (txtEmail.checkValidity() == false) {
       divErroEmail.style.visibility= "visible";
    }

    if (txtMensagem.checkValidity() == false) {
    divErroMensagem.style.visibility= "visible";
    }
}
   
      </script>      
    
</body>
</html>