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
  idag:null,
  vida:null,
  codgrupo: '',    
  nomgrupo: ''        
});

 

 
const props = defineProps({
    menus: {
        type: Object,
    }, 
    grupo: {
        type: Object,
    }, 
    lastid: {
        type: Number,
    },
});
const openModal=(op,amb)=>{ 
    nextTick(()=>nameinput.value.focus());
    operacion.value=op;  
    if(op==1){
        titulo.value='Crear grupo';
        form.clearErrors();
        form.reset(); 
        form.codgrupo=codigo.value;
    }else{
        titulo.value='Modificar grupo';
        form.idag=amb.idag;
        form.codgrupo=amb.codgrupo;  
        form.nomgrupo=amb.nomgrupo;  
        form.vida=amb.vida;  
    }
    $('#staticBackdrop').modal('show'); 
};

const codigo = computed(() => { 
    return (props.lastid>9?props.lastid:'0'+props.lastid);
});
 
const closeModal=()=>{ 
    form.reset(); 
    $('#staticBackdrop').modal('hide');  
};
const guardarDatos=()=>{ 

   if(operacion.value==1){ 
    form.post(route('Grupo.store'),{onSuccess:()=>{ok('Creado correctamente')}  });
   }else{
    form.put(route('Grupo.update',form.idag),{onSuccess:()=>{ok('Modificado correctamente')}  });
   }
};
 
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
const eliminarActivo=(id)=>{ 
const alerta=Swal.mixin({buttonsStyling:true});
alerta.fire({
    title:'¿Esta seguro de eliminar el area funcional?',
    icon:'question',showCancelButton:true,
    confirmButtonText:'<i class="ti-check"></i> Si',
    cancelButtonText:'<i class="ti-close"></i> Cancelar'
}).then(
    (result)=>{
        if(result.isConfirmed){ 
            form.idag=id;
            form.post(route('Grupodestroy'),{onSuccess:()=>{ok('Eliminado correctamente')}  });
        } 
    }
);
}; 
     
</script>

<template>
    <Head title="Grupo" /> 
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
                      Grupo
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
                  Registrar nuevo Grupo
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
                  <h4 class="card-title mb-0">Listado general de grupos</h4>
                </div>
                <div class="card-body"> 
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-bordered"
                    >
                      <thead>
                        <tr style="    background: linear-gradient(to right, rgb(1, 120, 188) 0%, rgb(0, 189, 218) 100%);color: white;">
                           
                          <th class="align-middle" style="text-align: center;">Codigo</th>
                          <th class="align-middle" style="text-align: center;">Nombre</th> 
                          <th class="align-middle" style="text-align: center;">vida</th> 
                          <th class="align-middle" style="text-align: center;">Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="grupoact in grupo.data" :key="grupoact.idag">
                             
                            <td class="align-middle" style="text-align: center;">{{ grupoact.codgrupo }}</td>
                            <td class="align-middle" style="text-align: left;">{{ grupoact.nomgrupo }}</td> 
                            <td class="align-middle" style="text-align: center;">{{ grupoact.vida }}</td> 
                            <td class="button-group align-middle" style="text-align: center;">  
                                   <button class="btn btn-warning"
                                        @click="openModal(2,grupoact)">
                                        <i class="ti-book"></i>&nbsp;&nbsp;Editar
                                    </button> 
                                    
                                <button class="btn btn-danger" @click="eliminarActivo(grupoact.idag)">
                                        <i class="ti-close"></i>&nbsp;&nbsp;Eliminar
                                 </button>  
 
                            </td> 
                        </tr>
                      </tbody>
                     
                    </table>
                    <pagination class="mt-6" :links="grupo.links" />
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
                                            <div :class="form.errors.codgrupo?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="codgrupo" ref="nameinput" v-model="form.codgrupo" type="text" readonly>
                                                    </TextInput> 
                                                <label for="codgrupo">Codigo</label>
                                                <small v-show="form.errors.codgrupo" class="form-control-feedback">
                                                    {{form.errors.codgrupo}}
                                                    </small> 
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-12">
                                            <div :class="form.errors.nomgrupo?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="nomgrupo" ref="nameinput" v-model="form.nomgrupo" type="text" >
                                                    </TextInput> 
                                                <label for="nomgrupo">Nombre del area funcional</label>
                                                <small v-show="form.errors.nomgrupo" class="form-control-feedback">
                                                    {{form.errors.nomgrupo}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div :class="form.errors.vida?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="vida" ref="nameinput" v-model="form.vida" type="number" >
                                                    </TextInput> 
                                                <label for="vida">Vida</label>
                                                <small v-show="form.errors.vida" class="form-control-feedback">
                                                    {{form.errors.vida}}
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
