<script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm,router } from '@inertiajs/vue3'; 
import Pagination from '@/Components/Paginations.vue'; 
import TextInput from '@/Components/TextInput.vue';
import SelectInputAmbiente from '@/Components/SelectInputAmbiente.vue';
import Cropp from '@/Components/CropperImage.vue';
import SelectInputGgrupo from '@/Components/SelectInputGgrupo.vue';
import SelectInputAuxiliar from '@/Components/SelectInputAuxiliar.vue';
import SelectInputUsers from '@/Components/SelectInputUsers.vue';
import SelectInputEstados from '@/Components/SelectInputEstados.vue';
import Swal from 'sweetalert2';
import {ref,nextTick,watch,computed} from 'vue'; 
import { debounce,isNull,findIndex } from 'lodash';
import moment from 'moment';
const nameinput=ref(null); 
const titulo=ref('');
const searchField=ref('');
const usuarios=ref([]);
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
    codactivo: '', 
    fechafin: moment(new Date()).format('YYYY-MM-DD'),
    obsfin: '',
    estadofin: null    
}); 
function getestado(estado) { 
    return isNull(estado)?'':estadoasignacion.value[findIndex(estadoasignacion.value, ['id', estado])]["name"]; 
}
watch(searchField, debounce(() => { 
router.get('ActivoDev', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['activos','users']})
}, 300));

const codigo = computed(() => { 
    return 'MUG'+(props.lastid>9?props.lastid:'0'+props.lastid)+(form.idambiente!=null?(form.idambiente>9?form.idambiente:'0'+form.idambiente):'')+
   (form.idgrupo!=null? (form.idgrupo>9?form.idgrupo:'0'+form.idgrupo):'')+
    (form.idauxiliar!=null?(form.idauxiliar>9?form.idauxiliar:'0'+form.idauxiliar):'');
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
 
const openModalAsig=(idasignacion,codactivo)=>{  
    nextTick(()=>nameinput.value.focus()); 
        titulo.value='Crear Devolución';
        formasig.clearErrors();
        formasig.reset();
        formasig.idasignacion=idasignacion;
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
    formasig.put(route('ActivoDev.update',formasig.idasignacion),{onSuccess:()=>{ok('Devuelto correctamente')}  });
};
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
 
      
 
   
</script>

<template>
    <Head title="Devolución" /> 
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
                        Devolución
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
                
              </div>
            </div>
          </div>
        </div>
        
        <div class="container-fluid"> 
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="border-bottom title-part-padding">
                  <h4 class="card-title mb-0">Listado general de los activos asignados</h4>
                </div>
                <div class="card-body"> 
                    <div class="col-md-6 ">
                         <div class="form-floating mb-3"> 
                                                    <TextInput class="form-control" id="search" ref="nameinput" v-model="searchField" type="text" >
                                                    </TextInput> 
                                                <label for="serie">Buscar por codigo</label> 
                          </div>

                    </div>



                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table  table-bordered"
                    >
                      <thead>
                        <tr style="    background: linear-gradient(to right, rgb(1, 120, 188) 0%, rgb(0, 189, 218) 100%);color: white;">
                          <th class="align-middle" style="text-align: center;">Activo</th>
                          <th class="align-middle" style="text-align: center;">Codigo</th>
                          <th class="align-middle" style="text-align: center;">Asignado a</th> 
                          <!-- <th>Descripción</th> --> 
                          <!-- <th class="align-middle" style="text-align: center;">Grupo</th>
                          <th class="align-middle" style="text-align: center;">Auxiliar</th> 
                          <th class="align-middle" style="text-align: center;">Unidad Funcional</th> -->
                          <th class="align-middle" style="text-align: center;">Fecha Asignación</th> 
                          <th class="align-middle" style="text-align: center;">Estado de Asignación</th> 
                          <th class="align-middle" style="text-align: center;">Observaciones de Asignación</th> 
                          <th class="align-middle" style="text-align: center;">Fecha Devolución</th> 
                          <th class="align-middle" style="text-align: center;">Estado de Devolución</th> 
                          <th class="align-middle" style="text-align: center;">Observaciones de Devolución</th>  
                          <th class="align-middle" style="text-align: center;">Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="activo in activos.data" :key="activo.idactivo" :class="activo.asigactivo==0?'table-danger':''">
                            <td class="align-middle" style="text-align: center;"><img :src="activo.imagen" alt="activo" width="75"></td>
                            <td class="align-middle" style="text-align: center;"><b>{{ activo.codactivoasig}}</b></td>
                            <!-- <td class="align-middle" style="text-align: center;">{{ activo.descripcion }}</td> --> 
                            <!-- <td class="align-middle" style="text-align: center;">{{ activo.nomgrupo }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomauxiliar }}</td> 
                            <td class="align-middle" style="text-align: center;">{{ activo.nomambiente }}</td>-->
                            <td v-if="activo.asigactivo==1" :class="activo.asig?'align-middle':'align-middle text-warning'" style="text-align: center;">{{ activo.asig?activo.asig:'No asignado' }}</td>  
                            <td v-else class="align-middle" style="text-align: center;"><span  class="badge bg-warning">Devuelto</span></td>  
                            <td class="align-middle" style="text-align: center;">{{ activo.fechaini }}</td>
                            <td class="align-middle" style="text-align: center;">{{ getestado(activo.estadoini) }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.obsini }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.fechafin }}</td>
                            <td class="align-middle" style="text-align: center;">{{ getestado(activo.estadofin) }}</td>
                             <td class="align-middle" style="text-align: center;">{{ activo.obsfin }}</td> 
                            <td class="button-group align-middle" style="text-align: center;">  
                                    
                                    <button v-if="activo.asigactivo==1" class="btn btn-warning"
                                        @click="openModalAsig(activo.idasignacion,activo.codactivoasig)">
                                        <i class="ti-close"></i>
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
        <!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
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
                                                <label for="idambiente">Unidad Funcional</label> 
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
                                            <table
                                                :class="form.errors.imagen?'form-floating dropzone mb-3 has-danger':'form-floating dropzone mb-3'">
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td class="align-middle" style="text-align: center;">
                                                            <img v-if="form.imagen" style="width: 60%;" :src="form.imagen" alt="">
                                                           <Cropp v-model="form.imagen"/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr style="max-height: 30px;text-align: center;">
                                                        <td class="align-bottom"> 
                                                            <small v-show="form.errors.imagen"
                                                                class="form-control-feedback">
                                                                {{form.errors.imagen}}
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
        </div>   -->
        <!-- ==================================================================================== -->
        <div class="modal fade" id="modalasignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalasignacionLabel" aria-hidden="true">
            <div class="modal-dialog ">
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
                                           <h1 style=" text-align: center;font-weight: bold;margin-bottom: 23px;">{{formasig.codactivo}}</h1>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.estadofin?'  mb-3 has-danger':'  mb-3'">
                                                <label for="estadofin">Estado Final</label> 
                                                    <SelectInputEstados class="form-select form-select-lg mb-3" id="estadofin" v-model="formasig.estadofin" type="text" :options="estadoasignacion">
                                                    </SelectInputEstados>  
                                                <small v-show="formasig.errors.estadofin" class="form-control-feedback">
                                                    {{formasig.errors.estadofin}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div :class="formasig.errors.fechafin?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fechafin" ref="nameinput" v-model="formasig.fechafin" type="date" >
                                                    </TextInput> 
                                                <label for="fechafin">Fecha de devolución</label>
                                                <small v-show="formasig.errors.fechafin" class="form-control-feedback">
                                                    {{formasig.errors.fechafin}}
                                                    </small> 
                                            </div>
                                        </div> 
 
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.obsfin?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="obsfin" ref="nameinput" v-model="formasig.obsfin" type="text" >
                                                    </TextInput> 
                                                <label for="obsfin">Observaciones</label>
                                                <small v-show="formasig.errors.obsfin" class="form-control-feedback">
                                                    {{formasig.errors.obsfin}}
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
