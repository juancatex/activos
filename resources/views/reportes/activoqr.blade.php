<!DOCTYPE html>
<html lang="en">
<head>
    <title>Listado de Qrs de Activos fijos</title> 
</head>
<style>@page {
    margin: 0cm 0cm;
}

.body_wrapper {
    padding: 10px 20px 10px 20px;
    background: rgb(255, 255, 255) none;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    max-width: 750px;
    margin: 0 auto;

}

.table {
    border-collapse: collapse;
    width: 100%; 
    font-size: 12px;
    border: 1px solid;     

}
 
 
p {
    text-align: justify;
    font-size: 16px;
}

span {
    font-weight: bold;
}

.span2 {
    font-size: 10px;
}

.derecha {
    text-align: right;
}

header {
    position: fixed;
    top: 0cm;
    left: 0cm;
    right: 0cm;
    height: 1.8cm; 
}

footer {
    position: fixed;
    bottom: 0cm;
    left: 0cm;
    right: 0cm;
    height: 1.5cm; 
}

body {
    margin-top: 2.5cm;
    margin-left: 1.5cm;
    margin-right: 1.5cm;
    margin-bottom: 2cm;
    font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
     font-size: 12px;
}
.contenedor div{ float:left; }
</style>
<body >
<header> 
  <img src="{{ public_path('assets/images/header.png') }}" width="100%" height="100%">   
</header>
<footer>
 <img src="{{ public_path('assets/images/footer.png') }}" width="100%" height="100%">  
</footer>

    <main>
    <div class="contenedor">
            @php 
           $i=0; 
           @endphp
           @foreach ($qrout as $activos)
           <div style=" border: 2px solid; margin:4px;">  
                <table>
                    <tr>
                        <td style="padding:4px 4px 1px 4px"><img src="data:image/png;base64,{{base64_encode($activos['qrval'])}}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;font-weight: bold;">{{ $activos['cod']}}</td>
                    </tr>
                </table>
            </div>
           @php 
           $i=$i+1
           @endphp

            @if ($i == 5)
            @php 
              $i=0;
              <br>
             @endphp
            @endif

           @endforeach
           
    </div>
    </main>
</body>
</html>