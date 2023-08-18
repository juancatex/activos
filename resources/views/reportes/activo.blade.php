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
    font-size: 12px;
    border: 1px solid;     

}
th, td {
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
        
        <h1 style="color: #0c49a5;text-align: center;">Listado General de Activos Fijos </h1>
       
 
        <table class="table">
       <thead>
           <tr>
           <th>Nº</th> 
           <th class="align-middle" style="text-align: center;">Activo</th>
            <th class="align-middle" style="text-align: center;">Codigo</th>
            <th class="align-middle" style="text-align: center;">Descripción</th>
            <th class="align-middle" style="text-align: center;">Unidad Funcional</th>
            <th class="align-middle" style="text-align: center;">Grupo</th>
            <th class="align-middle" style="text-align: center;">Auxiliar</th> 
            <th class="align-middle" style="text-align: center;">Fecha Ingreso</th> 
            <th class="align-middle" style="text-align: center;">Costo</th>  
           </tr>
           
       </thead>
       <tbody>
           @php 
           $i=1; 
           @endphp
           @foreach ($data as $activos)
           <tr>
               <td style="width:25px;text-align: center;">{{$i}}</td>
              
                <td class="align-middle" style="text-align: center;"><img src="{{$activos->imagen}}" alt="activo" width="50"></td>
                <td class="align-middle" style="text-align: center;"><b>{{ $activos->codactivo}}</b></td>
                <td class="align-middle" style="text-align: center;">{{ $activos->descripcion }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->nomambiente }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->nomgrupo }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->nomauxiliar }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->fechaingreso }}</td>
                <td class="align-middle" style="width:60px;text-align: right;">{{ $activos->costo }}Bs.</td>
                 
           </tr>
           @php 
           $i=$i+1
           @endphp
           @endforeach
          
       </tbody>
   </table>
              
    </div>
    </main>
</body>
</html>