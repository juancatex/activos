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
import { debounce,findIndex,reduce } from 'lodash';
import moment from 'moment';
const nameinput=ref(null); 
const titulo=ref('');
const searchField=ref('');
const searchambiente=ref(null);
const searchfecha=ref(null);
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
    idactivo: null,
    codactivo: '',
    iduser: null,
    fechaini: moment(new Date()).format('YYYY-MM-DD'),
    obs: '',
    estadoini: null    
}); 
  
watch(searchField, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('ActivoAsig', {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos','users']})
}, 300));
watch(searchambiente, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('ActivoAsig', {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
}, 300));
watch(searchfecha, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('ActivoAsig', {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
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
 
const openModalAsig=(idactivo,codactivo,idambiente)=>{ 
    usuarios.value=getuser(props.users,idambiente); 
const contador = reduce(props.users, function (result, value, key) {   if (value.idu == idambiente) {  result++;  }  return result; }, 0);
if(contador>0){
 nextTick(()=>nameinput.value.focus()); 
    titulo.value='Crear Asignación';
    formasig.clearErrors();
    formasig.reset();
    formasig.idactivo=idactivo;
    formasig.codactivo=codactivo;
    $('#modalasignacion').modal('show'); 
}else{
    Swal.fire({
  icon: 'error', 
  text: 'Verifique que algun funcionario este designado al area funcional correspondiente.' });
}
   
};
function getuser(users,idambiente) {
    return reduce(users, function (result, value, key) {

        if (value.idu == idambiente) {
            result.push(value);
        }
        return result;
    },[]);
}
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
const reporteasignacion=(id)=>{
    _pl.startReport();
    axios.get("/ActivoAsigReporte").then(function (response) { 
                             _pl.ViserReporte(`data:application/pdf;base64,${response.data}`,'sdfsdfsdf'); 
                })
                .catch(function (error) {
                    console.log(error);
                });
    // _pl.ViserReporte("/ActivoAsigReporte",'sdfsdfsdf'); 
};
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
 
   
</script>

<template>
    <Head title="Asignación" /> 
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
                        Asignación
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
                  <h4 class="card-title mb-0">Listado general de los activos</h4>
                </div>
                <div class="card-body"> 
                     
                    <div class="row">
                        <div class="col-md-4">
                                             <div class="form-floating mt-3"> 
                                                    <TextInput class="form-control" id="fechaingreso" ref="nameinput" v-model="searchfecha" type="date" >
                                                    </TextInput> 
                                                <label for="fechaingreso">Buscar por Fecha de Ingreso</label> 
                                            </div>
                        </div>
                        <div class="col-md-4"> 
                                            <div class="form-floating mt-3"> 
                                                    <TextInput class="form-control" id="search" ref="nameinput" v-model="searchField" type="text" >
                                                    </TextInput> 
                                                <label for="serie">Buscar por codigo</label> 
                                            </div> 
                        </div>
                        <div class="col-md-4">
                                            <div class=" mb-3'"> 
                                                <label for="idambiente">Buscar por Unidad Funcional</label> 
                                                    <!-- <SelectInputAmbiente class="form-select form-select-lg mb-3" id="idambiente" v-model="searchambiente" type="text" :options="ambiente">
                                                    </SelectInputAmbiente>    -->
                                                    <select class="form-select form-select-lg mb-3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        v-model="searchambiente" 
                                                        ref="input" >  
                                                        <option value="0" selected>Todos</option>
                                                        <option v-for="opt in ambiente" :key="opt.i" :value="opt.idambiente" :selected="opt.idambiente==modelValue" >
                                                            {{ opt.nomambiente }}
                                                        </option>
                                                    </select>
                                            </div>
                        </div>
                        
                    </div>
 
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-bordered"
                    >
                      <thead>
                        <tr style="    background: linear-gradient(to right, rgb(1, 120, 188) 0%, rgb(0, 189, 218) 100%);color: white;">
                          <th class="align-middle" style="text-align: center;">Activo</th>
                          <th class="align-middle" style="text-align: center;">Codigo</th>
                          <!-- <th>Descripción</th> --> 
                          <th class="align-middle" style="text-align: center;">Grupo</th>
                          <th class="align-middle" style="text-align: center;">Auxiliar</th> 
                          <th class="align-middle" style="text-align: center;">Fecha Ingreso</th> 
                          <th class="align-middle" style="text-align: center;">Unidad Funcional</th>
                          <th class="align-middle" style="text-align: center;">Asignación</th> 
                          <th class="align-middle" style="text-align: center;">Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="activo in activos.data" :key="activo.idactivo">
                            <td class="align-middle" style="text-align: center;"><img :src="activo.imagen" alt="activo" width="75"></td>
                            <td class="align-middle" style="text-align: center;"><b>{{ activo.codactivo}}</b></td>
                            <!-- <td class="align-middle" style="text-align: center;">{{ activo.descripcion }}</td> --> 
                            <td class="align-middle" style="text-align: center;">{{ activo.nomgrupo }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomauxiliar }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.fechaingreso }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomambiente }}</td>
                            <td :class="activo.asig?'align-middle':'align-middle text-warning'" style="text-align: center;">{{ activo.asig?activo.asig:'No asignado' }}</td>  
                            <td class="button-group align-middle" style="text-align: center;">  
                                    
                                    <button v-if="!activo.asig" class="btn btn-info"
                                        @click="openModalAsig(activo.idactivo,activo.codactivo,activo.idambiente)">
                                        <i class="ti-user"></i>
                                    </button> 

                                    <button v-else class="btn btn-outline-info  "
                                    @click="reporteasignacion(activo.idasignacion)" >
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
                                                    <SelectInputUsers class="form-select form-select-lg mb-3" id="iduser" v-model="formasig.iduser" type="text" :options="usuarios">
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
