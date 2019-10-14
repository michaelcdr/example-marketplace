<?php
    // if (isset($_GET["txtNumero1"])){
    //   echo "aaaaaaa";
    // } else{
    //   echo $_GET["txtNumero1"];
    // }

      $num01=null;
      $num02=null;
      $opera=null;
      
      if (isset($_GET["txtNumero1"]))
        $num01 = $_GET["txtNumero1"];
      
      if (isset($_GET["txtNumero2"]))
        $num02 = $_GET["txtNumero2"];

      if (isset($_GET["slOperacao"]))
        $opera = $_GET["slOperacao"];
        
   

    $resul = "";
    
    if($num01  && $num02){
      switch($opera){
        case "+":
          $resul = ($num01 + $num02);
        break;
        case "-":
          $resul = ($num01 - $num02);
        break;
        case "*":
          $resul = ($num01 * $num02);
        break;
        case "/":
          $resul = ($num01 / $num02);
        break;
      }
    }
 
?>
 
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Operações</title>
     <style>
      input, select{padding:10px; margin: 5px;}
     </style>
   </head>
   <body>
     <h1><?=$resul;?></h1>
     <form method="get">
       <label>Número 1: <input type="text" name="txtNumero1" value="<?php echo $num01;?>"/></label><br>
       <label>Número 2: <input type="text" name="txtNumero2" value="<?php echo $num02;?>"/></label><br>
       <label>Operação:
         <select name="slOperacao">
           <option value="+">Adição</option>
           <option value="-">Subtração</option>
           <option value="*">Multiplicação</option>
           <option value="/">Divisão</option>
         </select>
       </label><br>
       <input type="submit" name="btnCalcular" value="Calcular">
     </form>
   </body>
 </html>	
