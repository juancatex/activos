import Swal from 'sweetalert2';
export function ViserReporte(id) {

    return Swal.fire({  
      html: '<div id="framepdf" style="display:inline;">'+
      '<div style=" width: 100%; "> <div class=" justify-content-end" style="float: right;    float: right; padding-right: 31px; padding-bottom: 5px;"><button id="reloadedFrame" style="font-size: 26px;display: contents;" class="btn btn-sm"><i class="ti-reload "></i></button></div> </div>'+
      '<iframe id="printpdf" name="printpdf" src="'+id+'" style="width:100%;height: 80vh;" allowfullscreen></iframe></div>',
      showConfirmButton: false, 
      showCancelButton: true,
      allowOutsideClick: false,
      allowEscapeKey:false,  
      showCloseButton: true,
      cancelButtonText:'Cerrar', 
      confirmButtonColor: '#4dbd74',
      cancelButtonColor: '#f86c6b',  
      reverseButtons: true,
      willOpen: function() { 
        Swal.showLoading() ; 
        Swal.disableButtons();
          $( "#close_id_swal" ).click(function() {
            Swal.close();  
          });
          $( "#reloadedFrame" ).click(function() {
            $('#printpdf').attr("src", $('#printpdf').attr("src")); 
          });
    
          $('#printpdf').on('load', function() {
            $("#framepdf").css("display", "inline"); 
            Swal.hideLoading() ; 
            $(".swal2-popup").css("width", "86%"); 
            $(".swal2-popup").css("padding", "0px 0px 20px 0px"); 
            });
          
        }
      }); 
    }
export function mensaje401() {

    Swal.fire({
        title: 'Su sesion a caducado..',
        text: 'Debe de ingresar al sistema nuevamente',
        type: 'error',
        footer: 'Al ir a inicio, sus datos registrados en el formulario previo no seran recuperados.',
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey:false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#89898a',
        confirmButtonText: 'Ir a inicio',
        cancelButtonText: 'Seguir',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger' 
        }).then((result) => {
            if (result.value) {
                window.location.href = "/";
            }  
        }); 
    }
    export function startReport(){
        Swal.fire({
            title: "Generando reporte",
            allowOutsideClick: () => false,
            allowEscapeKey: () => false,
            showConfirmButton: false, 
            showCancelButton: false, 
            willOpen: function() {
                Swal.showLoading();
            }
        });
    }
    export function preparando(){
        Swal.fire({
            title: "Obteniendo datos...",
            allowOutsideClick: () => false,
            allowEscapeKey: () => false,
            showConfirmButton: false, 
            showCancelButton: false, 
            willOpen: function() {
                Swal.showLoading();
            }
        });
    }
    export function startDepre(){
      Swal.fire({
        title: "Registrando los Datos",
        html: '<div class="progress" style="height: 22px;"><div id="save" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">0%</div></div> <span id="text_saving" style="font-size: 13px;"></span>',
        allowOutsideClick: () => false,
        allowEscapeKey:() => false,
        showConfirmButton:false,
        showCancelButton:false
        }); 
    }
    export function ok(msj){
      Swal.fire({title:msj,icon:'success'});
    }
    export function close(){
      Swal.close();
    }