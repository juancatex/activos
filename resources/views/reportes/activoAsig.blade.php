<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<style>


.body_wrapper {
    padding: 10px 20px 10px 20px;
    background: rgb(255, 255, 255) none;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    max-width: 750px;
    margin: 0 auto;
    
}
table {
        
        border-collapse: collapse;
        /* border: 1px solid #000; */
        width: 100%;
        font-size: 15px;
        
       
        caption-side: top; 
    }
    
    body{/* quitar el body para la impresion*/
        font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
        position: relative;
        font-size:12px;
        
       /*    
        margin: 8px auto 8px auto;
         */

    }
    p{
        text-align: justify;
        font-size: 16px;
    }
    span{
        font-weight: bold;
    }
    .span2{
        font-size: 10px;
    }
    .derecha{
        text-align:right;
    }
</style>
<body style="text-align:center">
<div class="body_wrapper">
<div class="left"> <img src="{{$foto}}" width="90%"> </div>
   <h2 style="color: #0c49a5;">REGISTRO DE INGRESO HOSPEDAJE N°  </h2>
   <hr>
    
   <h3 style="text-align: left;">NOTA:</h3>
   <span class="span">Estimado Cliente ASCINALSS Comunica a usted lo siguiente:
<ul style="text-align: left;">
    <li>
        La hora maxima establecida para la entrega de las piezas es hasta Hrs. 12:30
pasada esta hora se ejecutara automaticamente un dia mas de Tarifa
    </li>
    <li>
    Toda pertenencia de valor que no sea registrada en la administracion del Hotel, en
caso de perdida no sera responsabilidad de ASCINALSS
    </li>
    <li>
    La llave de la pieza debe dejarse en la administracion de ASCINALSS
    </li>
</ul> 

   
    
    </div> 
</body>
</html>