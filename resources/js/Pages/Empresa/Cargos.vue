<script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm } from '@inertiajs/vue3'; 
import Pagination from '@/Components/Paginations.vue';
import TextInput from '@/Components/TextInput.vue'; 
import Swal from 'sweetalert2';
import {ref,nextTick,onMounted,computed} from 'vue';  
const nameinput=ref(null); 
const titulo=ref('');  
const operacion=ref(1);  
const form = useForm({
    idrol:null,
    name: '',    
    descripcionrol: ''        
});

 

 
const props = defineProps({
    menus: {
        type: Object,
    }, 
    roles: {
        type: Object,
    }, 
});
const openModal=(op,rol)=>{ 
    nextTick(()=>nameinput.value.focus());
    operacion.value=op;  
    if(op==1){
        titulo.value='Crear Cargo';
        form.clearErrors();
        form.reset(); 
    }else{
        titulo.value='Modificar Cargo';
        form.idrol=rol.idrol;
        form.name=rol.name;
        form.descripcionrol=rol.descripcionrol; 
        
    }
    $('#staticBackdrop').modal('show'); 
};
 
const closeModal=()=>{ 
    form.reset(); 
    $('#staticBackdrop').modal('hide');  
};
const guardarDatos=()=>{ 
   if(operacion.value==1){
    form.post(route('Roles.store'),{onSuccess:()=>{ok('Creado correctamente')}  });
   }else{
    form.put(route('Roles.update',form.idrol),{onSuccess:()=>{ok('Modificado correctamente')}  });
   }
};
 
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
const eliminarActivo=(id)=>{ 
const alerta=Swal.mixin({buttonsStyling:true});
alerta.fire({
    title:'¿Esta seguro de eliminar el cargo?',
    icon:'question',showCancelButton:true,
    confirmButtonText:'<i class="ti-check"></i> Si',
    cancelButtonText:'<i class="ti-close"></i> Cancelar'
}).then(
    (result)=>{
        if(result.isConfirmed){ 
            form.idrol=id;
            form.post(route('Rolesdestroy'),{onSuccess:()=>{ok('Eliminado correctamente')}  });
        } 
    }
);
}; 
     
</script>

<template>
    <Head title="Cargos" /> 
    <Menu :listmenus="menus">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-md-5 align-self-center">
              <!-- <h3 class="page-title">Activos</h3> -->
              <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a>
                        <Link   :href="route('dashboard')"> 
                         </Link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                         Cargos
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
            <div
              class="
                col-md-7
                justify-content-end
                align-self-center
                d-none d-md-flex
              "
            >
              <div class="d-flex"> 
                <button class="btn btn-success" @click="openModal(1)">
                  <i   class="fill-white ti-plus"></i>
                  Registrar nuevo Cargo
                </button>
              </div>
            </div>
          </div>
        </div>
        
        <div class="container-fluid"> 
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="border-bottom title-part-padding">
                  <h4 class="card-title mb-0">Listado general de Cargos</h4>
                </div>
                <div class="card-body"> 
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-bordered"
                    >
                      <thead>
                        <tr style="    background: linear-gradient(to right, rgb(1, 120, 188) 0%, rgb(0, 189, 218) 100%);color: white;">
                           
                          <th class="align-middle" style="text-align: center;">Nombre</th>
                          <th class="align-middle" style="text-align: center;">Descripción</th> 
                          <th class="align-middle" style="text-align: center;">Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="rol in roles.data" :key="rol.idrol">
                             
                            <td class="align-middle" style="text-align: center;">{{ rol.name }}</td>
                            <td class="align-middle" style="text-align: center;">{{ rol.descripcionrol }}</td> 
                            <td class="button-group align-middle" style="text-align: center;">  
                                   <button class="btn btn-warning"
                                        @click="openModal(2,rol)">
                                        <i class="ti-book"></i>&nbsp;&nbsp;Editar
                                    </button> 
                                    
                                <button class="btn btn-danger" @click="eliminarActivo(rol.idrol)">
                                        <i class="ti-close"></i>&nbsp;&nbsp;Eliminar
                                 </button>  
 
                            </td> 
                        </tr>
                      </tbody>
                     
                    </table>
                    <pagination class="mt-6" :links="roles.links" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content"> 
                    <div class="
                              modal-header modal-colored-header
                              bg-warning
                              text-white
                            ">
                        <h4 class="modal-title" id="warning-header-modalLabel">
                            {{titulo}}
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body"> 
                                <form>
                                    <div class="row">  
                                        
                                        <div class="col-md-12">
                                            <div :class="form.errors.name?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="name" ref="nameinput" v-model="form.name" type="text" >
                                                    </TextInput> 
                                                <label for="name">Nombre del cargo</label>
                                                <small v-show="form.errors.name" class="form-control-feedback">
                                                    {{form.errors.name}}
                                                    </small> 
                                            </div>
                                        </div>
                                         
                                           
                                            <div class="col-md-12">
                                            <div :class="form.errors.descripcionrol?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <textarea rows="5" class="form-control" id="descripcionrol" ref="nameinput" v-model="form.descripcionrol" type="text"   >
                                                    </textarea> 
                                                <label for="descripcionrol">Descripción</label>
                                                <small v-show="form.errors.descripcionrol" class="form-control-feedback">
                                                    {{form.errors.descripcionrol}}
                                                </small> 
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="
                                btn btn-light-warning
                                text-warning
                                font-weight-medium
                              " @click="guardarDatos">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </Menu>
</template>
