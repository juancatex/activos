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
    font-size: 9px;
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
        
        <h1 style="color: #0c49a5;text-align: center;">Documento de Custodia </h1>
       
        <table style=" margin: 0 auto;">
            <tr> 
                <td>
                        <table cellspacing="5" cellpadding="0"> 
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Responsable :</td><td>{{ $user->name }} {{ $user->ap }} {{ $user->am }}</td></tr>
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Unidad Funcional :</td><td>{{ $user->ubicacion->nomambiente }}</td></tr>
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Cargo :</td><td>{{ $user->rol->name }}</td></tr> 
                        </table>
                </td>
            </tr>
        </table>
<br><p>Listado de activos asignados :</p>
        <table class="table">
       <thead>
           <tr>
           <th>Nº</th> 
           <th class="align-middle" style="text-align: center;">Activo</th>
            <th class="align-middle" style="text-align: center;">Codigo</th>
            <th class="align-middle" style="text-align: center;">Descripción</th> 
            <th class="align-middle" style="text-align: center;">Grupo</th>
            <th class="align-middle" style="text-align: center;">Auxiliar</th> 
            <th class="align-middle" style="text-align: center;">Fecha de asignacion</th> 
            <th class="align-middle" style="text-align: center;">Estado</th>  
            <th class="align-middle" style="text-align: center;">Saldo de vida</th>  
            <th class="align-middle" style="text-align: center;">Costo</th>  
            <th class="align-middle" style="text-align: center;">Valor actual</th>  
           </tr>
           
       </thead>
       <tbody>
           @php 
           $i=1; 
           @endphp
           @foreach ($data as $activos)
           <tr>
               <td style="width:25px;text-align: center;">{{$i}}</td>
              
                <td class="align-middle" style="text-align: center;padding:2px"><img src="{{$activos->imagen}}" alt="activo" width="50"></td>
                <td class="align-middle" style="text-align: center;"><b>{{ $activos->codactivo}}</b></td>
                <td class="align-middle" style="text-align: center;">{{ $activos->descripcion }}</td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->nomgrupo }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->nomauxiliar }}</td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->fechaini }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->estadoini==1?'Bueno':($activos->estadoini==2?'Regular':'Malo')}}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->getdepres?$activos->getdepres->vidaft:$activos->vidaft }}</td>
                <td class="align-middle" style="text-align: right;">{{ $activos->costo}} Bs.</td> 
                <td class="align-middle" style="text-align: right;">{{ $activos->getdepres?$activos->getdepres->valor:'0'}} Bs.</td> 
 
                 
           </tr>
           @php 
           $i=$i+1
           @endphp
           @endforeach
          
       </tbody>
   </table>
   <p style="text-align: right;">La Paz, {{$date}}</p><br>
   <p>Activos que se encuentra en custodia según estipula la normativa interna de la institución.</p>
   <p>Nota: La asignación de bienes genera en el funcionario la consiguiente responsabilidad sobre el debido uso, custodia y mantenimiento de los mismos, La pérdida, destrucción o maltrato será atribuida al funcionario a cargo de los bienes, Así mismo, el funcionario que tiene a su cargo bienes de la institución por ningún motivo podrá efectuar préstamo y/o transferencia por cuenta propia.</p>
   
   <p>Para efectos de determinar al usuario responsable, en conformidad firma el presente documento:</p> 
         <br><br><br><br>
         
         <table style=" margin: 0 auto;">
        <tr style="text-align: center;"><td style="padding-right:200px">__________________________</td> <td>__________________________</td></tr>
        <tr style="text-align: center;"><td style="padding-right:200px">VERIFICADO POR</td> <td>CONFORME</td></tr>
        <tr style="text-align: center;"><td style="padding-right:200px">Responsable de Activos Fijos</td> <td>{{ $user->name }} {{ $user->ap }} {{ $user->am }}</td></tr>
        </table>     
    </div>
    </main>
</body>
</html>