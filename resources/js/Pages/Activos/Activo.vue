<script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm } from '@inertiajs/vue3'; 
import Pagination from '@/Components/Paginations.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInputAmbiente from '@/Components/SelectInputAmbiente.vue';
import SelectInputGgrupo from '@/Components/SelectInputGgrupo.vue';
import SelectInputAuxiliar from '@/Components/SelectInputAuxiliar.vue';
import SelectInputUsers from '@/Components/SelectInputUsers.vue';
import SelectInputEstados from '@/Components/SelectInputEstados.vue';
import Swal from 'sweetalert2';
import {ref,nextTick,onMounted,computed} from 'vue'; 
const nameinput=ref(null); 
const titulo=ref('');
const estadoasignacion=ref([{'id':1,'name':'Bueno'},{'id':2,'name':'Regular'},{'id':3,'name':'Malo'}]);
const operacion=ref(1);  
const form = useForm({
    idactivo:null,
    codactivo: '',
    idambiente: null,
    idgrupo: null,
    idauxiliar: null,
    fechaingreso: '',
    costo:null, 
    descripcion: '',
    marca: '',
    serie: '',
    imagen: '',
    obs: ''        
});

const formasig = useForm({
    idasignacion:null,
    idactivo: null,
    codactivo: '',
    iduser: null,
    fechaini: '',
    obs: '',
    estadoini: null    
});

const codigo = computed(() => {
    
    return 'MUG'+(form.idambiente!=null?(form.idambiente>9?form.idambiente:'0'+form.idambiente):'')+
   (form.idgrupo!=null? (form.idgrupo>9?form.idgrupo:'0'+form.idgrupo):'')+
    (form.idauxiliar!=null?(form.idauxiliar>9?form.idauxiliar:'0'+form.idauxiliar):'')+
    (props.lastid>9?props.lastid:'0'+props.lastid);
});
const props = defineProps({
    menus: {
        type: Object,
    },
    lastid: {
        type: Number,
    },
    activos: {
        type: Object,
    },
    users: {
        type: Object,
    },
    ambiente: {
        type: Object,
    },
    grupo: {
        type: Object,
    },
    aux: {
        type: Object,
    },
    status: {
        type: String,
    },
});
const openModal=(op,idactivo,codactivo,idambiente,idgrupo,idauxiliar,fechaingreso,costo,descripcion,marca,serie,imagen,obs)=>{ 
    nextTick(()=>nameinput.value.focus());
    operacion.value=op;  
    if(op==1){
        titulo.value='Crear Activo';
        form.reset();
    }else{
        titulo.value='Modificar Activo';
        form.idactivo=idactivo;
        form.codactivo=codactivo;
        form.idambiente=idambiente;
        form.idgrupo=idgrupo;
        form.idauxiliar=idauxiliar;
        form.fechaingreso=fechaingreso;
        form.costo=costo;
        form.descripcion=descripcion;
        form.marca=marca;
        form.serie=serie;
        form.imagen=imagen;
        form.obs=obs; 
    }
    $('#staticBackdrop').modal('show'); 
};
const openModalAsig=(idactivo,codactivo)=>{ 
    nextTick(()=>nameinput.value.focus()); 
    titulo.value='Crear Asignación';
    formasig.idactivo=idactivo;
    formasig.codactivo=codactivo;
    $('#modalasignacion').modal('show'); 
};
const closeModal=()=>{ 
    form.reset();
    formasig.reset();
    $('#staticBackdrop').modal('hide'); 
    $('#modalasignacion').modal('hide'); 
};
const guardarDatos=()=>{
   if(operacion.value==1){
    form.codactivo=codigo.value;
    form.post(route('Activo.store'),{onSuccess:()=>{ok('Creado correctamente')}  });
   }else{
    form.put(route('Activo.update',form.idactivo),{onSuccess:()=>{ok('Modificado correctamente')}  });
   }
};
const guardarDatosAsig=()=>{
    formasig.post(route('ActivoAsig.store'),{onSuccess:()=>{ok('Creado correctamente')}  });
};
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
const eliminarActivo=(id)=>{
    
const alerta=Swal.mixin({buttonsStyling:true});
alerta.fire({
    title:'¿Esta seguro de eliminar el registro?',
    icon:'question',showCancelButton:true,
    confirmButtonText:'<i class="ti-check"></i> Si',
    cancelButtonText:'<i class="ti-close"></i> Cancelar'
}).then(
    (result)=>{
        if(result.isConfirmed){ 
            form.idactivo=id;
            form.post(route('activodestroy'),{onSuccess:()=>{ok('Eliminado correctamente')}  });
        } 
    }
);
}; 
      onMounted(() => {$("#dzid").dropzone({ url: "/file/post" });
      Dropzone.autoDiscover = false;});
</script>

<template>
    <Head title="Activos" /> 
    <Menu :listmenus="menus">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-md-5 align-self-center">
              <h3 class="page-title">Activos</h3>
              <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a>
                        <Link   :href="route('dashboard')"> 
                         </Link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Activos
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
                  Registrar nuevo Activo
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
                  <h4 class="card-title mb-0">Listado general de los activos</h4>
                </div>
                <div class="card-body"> 
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr> 
                          <th>Cogido</th>
                          <th>Descripción</th>
                          <th>Ambiente</th>
                          <th>Grupo</th>
                          <th>Auxiliar</th> 
                          <th>Fecha Ingreso</th> 
                          <th>Asignación</th> 
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="activo in activos.data" :key="activo.idactivo">
                            <td>{{ activo.codactivo}}</td>
                            <td>{{ activo.descripcion }}</td>
                            <td>{{ activo.nomambiente }}</td>
                            <td>{{ activo.nomgrupo }}</td>
                            <td>{{ activo.nomauxiliar }}</td>
                            <td>{{ activo.fechaingreso }}</td>
                            <td>{{ activo.asig?activo.asig:'No asignado' }}</td>  
                            <td class="button-group">  
                                   <button class="btn btn-warning"
                                        @click="openModal(2,activo.idactivo,activo.codactivo,activo.idambiente,activo.idgrupo,activo.idauxiliar,activo.fechaingreso,
                                        activo.costo,activo.descripcion,activo.marca,activo.serie,activo.imagen,activo.obs)">
                                        <i class="ti-book"></i>
                                    </button> 
                                
                                    <button class="btn btn-danger" @click="eliminarActivo(activo.idactivo)">
                                        <i class="ti-close"></i>
                                    </button>

                                    <button v-if="!activo.asig" class="btn btn-info"
                                        @click="openModalAsig(activo.idactivo,activo.codactivo)">
                                        <i class="ti-user"></i>
                                    </button> 

                                    <button v-else class="btn btn-outline-info  " >
                                        <i class="ti-file"></i>
                                    </button> 
                                 

                                    
                            </td> 
                        </tr>
                      </tbody>
                     
                    </table>
                    <pagination class="mt-6" :links="activos.links" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-xl">
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
                                        <div class="col-md-12 row">
                                           <h1 style=" text-align: center;font-weight: bold;margin-bottom: 23px;">{{operacion==1?codigo:form.codactivo}}</h1>
                                        </div>
                                        <div class="col-md-4">
                                            <div :class="form.errors.idambiente?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idambiente">Ambiente</label> 
                                                    <SelectInputAmbiente class="form-select form-select-lg mb-3" id="idambiente" v-model="form.idambiente" type="text" :options="ambiente">
                                                    </SelectInputAmbiente>  
                                                <small v-show="form.errors.idambiente" class="form-control-feedback">
                                                    {{form.errors.idambiente}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div :class="form.errors.idgrupo?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idgrupo">Grupo</label> 
                                                    <SelectInputGgrupo class="form-select form-select-lg mb-3" id="idgrupo" v-model="form.idgrupo" type="text" :options="grupo">
                                                    </SelectInputGgrupo>  
                                                <small v-show="form.errors.idgrupo" class="form-control-feedback">
                                                    {{form.errors.idgrupo}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div :class="form.errors.idauxiliar?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idauxiliar">Auxiliar</label> 
                                                    <SelectInputAuxiliar class="form-select form-select-lg mb-3" id="idauxiliar" v-model="form.idauxiliar" type="text" :options="aux">
                                                    </SelectInputAuxiliar>  
                                                <small v-show="form.errors.idauxiliar" class="form-control-feedback">
                                                    {{form.errors.idauxiliar}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class="form.errors.descripcion?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="descripcion" ref="nameinput" v-model="form.descripcion" type="text" >
                                                    </TextInput> 
                                                <label for="descripcion">Descripción</label>
                                                <small v-show="form.errors.descripcion" class="form-control-feedback">
                                                    {{form.errors.descripcion}}
                                                    </small> 
                                            </div>
                                        </div>
 
                                       
                                        <div class="col-md-8 row" >
                                            <div class="col-md-6">
                                            <div :class="form.errors.costo?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="costo" ref="nameinput" v-model="form.costo" type="number" >
                                                    </TextInput> 
                                                <label for="costo">Costo</label>
                                                <small v-show="form.errors.costo" class="form-control-feedback">
                                                    {{form.errors.costo}}
                                                    </small> 
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div :class="form.errors.marca?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="marca" ref="nameinput" v-model="form.marca" type="text"  >
                                                    </TextInput> 
                                                <label for="marca">Marca</label>
                                                <small v-show="form.errors.marca" class="form-control-feedback">
                                                    {{form.errors.marca}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div :class="form.errors.serie?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="serie" ref="nameinput" v-model="form.serie" type="text" >
                                                    </TextInput> 
                                                <label for="serie">Serie</label>
                                                <small v-show="form.errors.serie" class="form-control-feedback">
                                                    {{form.errors.serie}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div :class="form.errors.fechaingreso?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fechaingreso" ref="nameinput" v-model="form.fechaingreso" type="date" >
                                                    </TextInput> 
                                                <label for="fechaingreso">Fecha de Ingreso</label>
                                                <small v-show="form.errors.fechaingreso" class="form-control-feedback">
                                                    {{form.errors.fechaingreso}}
                                                    </small> 
                                            </div>
                                        </div>
                                            <div class="col-md-12">
                                                <div :class="form.errors.obs?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                                    <TextInput class="form-control" id="obs" ref="nameinput" v-model="form.obs" type="text">
                                                    </TextInput>
                                                    <label for="obs">Observaciones</label>
                                                    <small v-show="form.errors.obs" class="form-control-feedback">
                                                        {{form.errors.obs}}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 row">
                                            <div class="dropzone" id="dzid">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>
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
        <!-- ==================================================================================== -->
        <div class="modal fade" id="modalasignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalasignacionLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content"> 
                    <div class="
                              modal-header modal-colored-header
                              bg-info
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
                                        <div class="col-md-12 row">
                                           <h1 style=" text-align: center;font-weight: bold;margin-bottom: 23px;">{{formasig.codactivo}}</h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.iduser?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="iduser">Personal</label> 
                                                    <SelectInputUsers class="form-select form-select-lg mb-3" id="iduser" v-model="formasig.iduser" type="text" :options="users">
                                                    </SelectInputUsers>  
                                                <small v-show="formasig.errors.iduser" class="form-control-feedback">
                                                    {{formasig.errors.iduser}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.estadoini?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="estadoini">Estado Inicial</label> 
                                                    <SelectInputEstados class="form-select form-select-lg mb-3" id="estadoini" v-model="formasig.estadoini" type="text" :options="estadoasignacion">
                                                    </SelectInputEstados>  
                                                <small v-show="formasig.errors.estadoini" class="form-control-feedback">
                                                    {{formasig.errors.estadoini}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div :class="formasig.errors.fechaini?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fechaini" ref="nameinput" v-model="formasig.fechaini" type="date" >
                                                    </TextInput> 
                                                <label for="fechaini">Fecha de Asignación</label>
                                                <small v-show="formasig.errors.fechaini" class="form-control-feedback">
                                                    {{formasig.errors.fechaini}}
                                                    </small> 
                                            </div>
                                        </div> 
 
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.obs?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="obs" ref="nameinput" v-model="formasig.obs" type="text" >
                                                    </TextInput> 
                                                <label for="obs">Observaciones</label>
                                                <small v-show="formasig.errors.obs" class="form-control-feedback">
                                                    {{formasig.errors.obs}}
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
                        btn btn-light-info
                                text-info
                                font-weight-medium
                              " @click="guardarDatosAsig">
                            Guardar
                        </button>
                    </div>
 

                </div>
            </div>
        </div>
    </Menu>
</template>
