<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
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
    font-size: 10px;
    border: 1px solid;     

}
.table th,.table td {
  border: 1px solid black;
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

</style>
<body >
<header> 
  <img src="{{ public_path('assets/images/header.png') }}" width="100%" height="100%">   
</header>
<footer>
 <img src="{{ public_path('assets/images/footer.png') }}" width="100%" height="100%">  
</footer>

    <main>
    <div class="body_wrapper">
        
        <h1 style="color: #0c49a5;text-align: center;">Listado General de Depreciación de Activos Fijos </h1>
       
 
        <table class="table">
       <thead>
           <tr>
           <th>Nº</th> 
           <th class="align-middle" style="text-align: center;">Codigo</th>
            <th class="align-middle" style="text-align: center;">Costo</th>
            <th class="align-middle" style="text-align: center;">Residual</th>
            <th class="align-middle" style="text-align: center;">Coeficiente</th>
            <th class="align-middle" style="text-align: center;">Vida Util</th>
            <th class="align-middle" style="text-align: center;">Gestión Dep.</th> 
            <th class="align-middle" style="text-align: center;">Saldo de vida</th> 
            <th class="align-middle" style="text-align: center;">Depreciación acumulada</th>  
            <th class="align-middle" style="text-align: center;">Valor actual</th>  
           </tr>
           
       </thead>
       <tbody>
           @php 
           $i=1; 
           @endphp
           @foreach ($data as $activos)
           
                @if(!empty($activos->getdepres)) 
                <tr> 
                <td style="width:25px;text-align: center;">{{$i}}</td>
                <td class="align-middle" style="text-align: center;"><b>{{ $activos->codactivo}}</b></td>  
                <td class="align-middle" style="text-align: right;">{{ $activos->costo}} Bs.</td>  
                <td class="align-middle" style="text-align: center;">{{ $activos->residual}}</td>  
                <td class="align-middle" style="text-align: center;">{{ $activos->coeficiente}}</td>  
                <td class="align-middle" style="text-align: center;">{{ $activos->vida}}</td>  
                <td class="align-middle" style="text-align: center;">{{ $activos->getdepres->gestion}}</td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->getdepres->vidaf}}</td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->getdepres->acu}} </td> 
                <td class="align-middle" style="text-align: right;">{{ $activos->getdepres->valor}} Bs.</td> 
                </tr> 
                @endif 
          
           @php 
           $i=$i+1
           @endphp
           @endforeach
          
       </tbody>
         </table>
         <br><br>
         <p>Verificado por:</p>
         <br><br>
         
         <table style=" margin: 0 auto;">
        <tr style="text-align: center;"><td>__________________________</td></tr> 
        <tr style="text-align: center;"><td>Responsable de Activos Fijos</td></tr>
        </table>     
    </div>
    </main>
</body>
</html>