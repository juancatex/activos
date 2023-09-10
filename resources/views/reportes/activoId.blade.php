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
        
        <h1 style="color: #0c49a5;text-align: center;">Acta de Asignación de Activo Fijo</h1>
       
      <br><br>
        <table style=" margin: 0 auto;">
            <tr>
                <td style="text-align: center;">
                    <table style=" border: 1px solid; margin:4px;">
                        <tr>
                            <td style="padding:4px 4px 4px 4px"><img
                                    src="data:image/png;base64,{{base64_encode($qrval)}}"></td>
                        </tr>
                        
                    </table>
                </td>
                <td>
                        <table cellspacing="0" cellpadding="0"> 
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Responsable :</td><td>{{ $activos->responsable }}</td></tr>
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Unidad Funcional :</td><td>{{ $activos->nomambiente }}</td></tr>
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Grupo :</td><td>{{ $activos->nomgrupo }}</td></tr>
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Auxiliar :</td><td>{{ $activos->nomauxiliar }}</td></tr>
                            <tr><td style="font-weight: bold;padding-right: 1.5em;"> Fecha Ingreso :</td><td>{{ $activos->fechaingreso }}</td></tr>
                        </table>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <p>En la ciudad de La Paz en fecha se procede a la asignación del bien de acuerdo al siguiente detalle:</p>
        <br>
        <table class="table">
       <thead>
           <tr> 
           <th class="align-middle" style="text-align: center;">Activo</th>
            <th class="align-middle" style="text-align: center;">Codigo</th> 
            <th class="align-middle" style="text-align: center;">Fecha Asignación</th>
            <th class="align-middle" style="text-align: center;">Descripción</th> 
            <th class="align-middle" style="text-align: center;">Estado</th>
            <th class="align-middle" style="text-align: center;">Costo</th>   
            <th class="align-middle" style="text-align: center;">Vida Util (Mes)</th>  
           </tr> 
       </thead>
       <tbody> 
           <tr>
                
                <td class="align-middle" style="text-align: center;"><img src="{{$activos->imagen}}" alt="activo" width="50"></td>
                <td class="align-middle" style="text-align: center;"><b>{{ $activos->codactivo}}</b></td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->fechaini }}</td>
                <td class="align-middle" style="text-align: center;">{{ $activos->descripcion }}</td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->estadoini==1?'Bueno':($activos->estadoini==2?'Regular':'Malo') }}</td> 
                <td class="align-middle" style="text-align: center;">{{ $activos->costo }} Bs.</td>  
                <td class="align-middle" style="text-align: center;">{{ $activos->vida*12 }}</td>
               
           </tr> 
       </tbody>
   </table>
   <br>
         <p>La presente acta de recepción y entrega de bienes demuestra la asignación de bienes de uso (Activo Fijo) que la empresa efectúa al funcionario para la realización de las funciones y tareas para las cuales fue sido contratado.</p>
         <p>La asignación de bienes genera en el funcionario la consiguiente responsabilidad sobre el debido uso, custodia y mantenimiento de los mismos, la pérdida, destrucción, maltrato o negligencia será imputada a su persona. Así mismo el funcionario que ahora tiene a su cargo dichos bienes, por ningún concepto podrá presentarlos o transferirlos por cuenta propia, en tal caso la empresa asumirá acciones de acuerdo a ley, efectuando las denuncias civiles y/o penales que correspondan.</p>
         <p>Para efectos de determinar al usuario responsable, en conformidad firma el presente acta:</p>    
         <br><br><br><br><br><br>
         <table style=" margin: 0 auto;">
        <tr style="text-align: center;"><td style="padding-right:200px">__________________________</td> <td>__________________________</td></tr>
        <tr style="text-align: center;"><td style="padding-right:200px">ENTREGADO CONFORME</td> <td>RECEPCIONADO CONFORME</td></tr>
        <tr style="text-align: center;"><td style="padding-right:200px">Responsable de Activos Fijos</td> <td>{{ $activos->responsable }}</td></tr>
        </table>
         
    </div>
    </main>
</body>
</html>