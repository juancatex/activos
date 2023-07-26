<script setup>
import { onMounted, ref } from 'vue';

const props=defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    
}); 
const fileon = ref(null)

const emit =defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
     
});
function cerrar(){
    emit('update:modelValue',null);
    $('#idimagen').cropper('destroy');
    $('#imgbene').html('');
    $('#fileon').val("");   
    $('#modalcropp').modal('hide'); 
    
}
function setcropp(){
    $("#idimagen").cropper({ 
                        aspectRatio: 1/1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 1,
                        restore: false, 
                        guides: false, 
                        rotatable: false,
                        multiple: false,responsive:true,
                        cropBoxResizable: true,
					}); 
}
function guardarDatos(){
    const imagebenefi=$("#idimagen").cropper('getCroppedCanvas',{ width: 300, height: 300 }).toDataURL(); 
    emit('update:modelValue',imagebenefi);
      $('#idimagen').cropper('destroy');
      $('#imgbene').html('');
      $('#fileon').val("");   
      $('#modalcropp').modal('hide'); 
                   
}
function imagenView(evt){   
                   if(fileon.value.files.length==0){  
                             $('#imgbene').html('');     
                       return;
                   }else{   
                     $('#idimagen').cropper('destroy');
                     $('#imgbene').html(''); 
                   var file = fileon.value.files[0]; 
                    var reader = new FileReader();
                    reader.onload = function(event) {  
                    $('#imgbene').append(`<img src='${event.target.result}' id="idimagen" style="max-width: 100%;"> `);  
                    $('#modalcropp').modal('show'); 
                    setTimeout(function() {
                        setcropp(); 
                    }, 500);
                    }
                    reader.readAsDataURL(file);
                   }
            }
 
</script>

<template> 
     <div :class="modelValue?'d-grid':''">
         <button v-if="modelValue" type="button" class="btn btn-outline-info" @click="$refs.fileon.click()">Cambiar  imagen</button>
         <button v-else type="button" class="btn btn-outline-success" @click="$refs.fileon.click()">Seleccionar  imagen</button>
         <input type="file" ref="fileon"  name='fotografia'  style="display: none;" accept="image/x-png,image/jpeg" @change="imagenView" >
         <!-- modall -->
         <div class="modal fade" id="modalcropp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content"> 
                    <div class="
                              modal-header modal-colored-header
                              bg-info
                              text-white
                            ">
                        <h4 class="modal-title" id="warning-header-modalLabel"> Fotografia </h4>
                        <button type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body"> 
                                <form>
                                    <div class="col-md-12"> 
                                        <div   id="imgbene"></div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
 
                    <div class="modal-footer">
                        <button type="button" class="
                                btn btn-light-success
                                text-success
                                font-weight-medium
                              " @click="guardarDatos">
                            Seleccionar
                        </button>
                        <button type="button" class="btn btn-light" @click="cerrar">
                            Cancelar
                        </button> 
                    </div>
                </div>
            </div>
        </div>
         <!-- fin modal -->
     </div> 
</template>