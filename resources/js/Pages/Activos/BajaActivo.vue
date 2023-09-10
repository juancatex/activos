<script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm,router } from '@inertiajs/vue3'; 
import Pagination from '@/Components/Paginations.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInputMotivos from '@/Components/SelectInputMotivos.vue'; 
import SelectInputAmbiente from '@/Components/SelectInputAmbiente.vue';
import Swal from 'sweetalert2';
import {ref,nextTick,onMounted,computed,watch} from 'vue';  
import moment from 'moment';
import { debounce,findIndex,reduce } from 'lodash';
const nameinput=ref(null); 
const titulo=ref('');     
const searchField=ref('');
const searchambiente=ref('');
const form = useForm({
    idactivo:null,
    codactivo: '',
    idambiente: null,
    idgrupo: null,
    idauxiliar: null,
    fechaingreso: moment(new Date()).format('YYYY-MM-DD'),
    costo:null, 
    descripcion: '',
    marca: '',
    serie: '',
    imagen: '',
    obs: ''        
});

const formasig = useForm({ 
    idactivo: null,
    codactivo: '', 
    fechabaja: moment(new Date()).format('YYYY-MM-DD'),
    nrordenbaja: '',
    idmotivobaja: null,
    obsbaja: '',    
});

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
    motivos: {
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
watch(searchField, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('ActivoBaja', {searchambiente: searchambiente.value,search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
}, 300));
watch(searchambiente, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('ActivoBaja', {searchambiente: searchambiente.value,search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
}, 300));
const openModal=(op,idactivo,codactivo,fechabaja,nrordenbaja,idmotivobaja,obsbaja)=>{ 
    nextTick(()=>nameinput.value.focus());   
        formasig.clearErrors();
        formasig.reset();  
        titulo.value='Detalle de baja';
        formasig.idactivo=idactivo;
        formasig.codactivo=codactivo;
        formasig.fechabaja=fechabaja;
        formasig.nrordenbaja=nrordenbaja;
        formasig.idmotivobaja=idmotivobaja;
        formasig.obsbaja=obsbaja; 
    $('#staticBackdrop').modal('show'); 
};
 
const closeModal=()=>{ 
    form.reset();
    formasig.reset();
    $('#staticBackdrop').modal('hide'); 
    $('#modalasignacion').modal('hide'); 
};
 
const guardarDatosAsig=()=>{ 
    formasig.post(route('activodestroy'),{onSuccess:()=>{ok('Registro de baja correctamente')}  });
};
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
const eliminarActivo=(idactivo,codactivo)=>{
     
const alerta=Swal.mixin({buttonsStyling:true});
alerta.fire({
    title:'¿Esta seguro de dar de baja este activo?',
    icon:'question',showCancelButton:true,
    confirmButtonText:'<i class="ti-check"></i> Si',
    cancelButtonText:'<i class="ti-close"></i> Cancelar'
}).then(
    (result)=>{
        if(result.isConfirmed){  
            nextTick(()=>nameinput.value.focus()); 
            titulo.value='Baja del activo'; 
            formasig.clearErrors();
            formasig.reset();
            formasig.idactivo=idactivo;
            formasig.codactivo=codactivo;
            $('#modalasignacion').modal('show'); 

        } 
    }
);
}; 
const reporteasignacion=(id)=>{
    _pl.startReport();
    var url= '/ActivosBajarepo?search=' + searchField.value + '&searchambiente='+ searchambiente.value;
     axios.get(url).then(function (response) { 
                             _pl.ViserReporte(`data:application/pdf;base64,${response.data}`,'Reporte General de Activos Fijos'); 
                })
                .catch(function (error) {
                    console.log(error);
                }); 
};
</script>

<template>
    <Head title="Baja de Activos" /> 
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
                         Baja de Activos
                    </li>
                  </ol>
                </nav>
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
                                                        <option value="" selected>Todos</option>
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
                          <th class="align-middle" style="text-align: center;">Descripción</th>
                          <th class="align-middle" style="text-align: center;">Unidad Funcional</th>
                          <th class="align-middle" style="text-align: center;">Grupo</th>
                          <th class="align-middle" style="text-align: center;">Auxiliar</th> 
                          <th class="align-middle" style="text-align: center;">Fecha Ingreso</th> 
                          <th class="align-middle" style="text-align: center;">Costo</th> 
                          <th class="align-middle" style="text-align: center;">Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="activo in activos.data" :key="activo.idactivo" :class="activo.activo==0?'table-danger':''">
                            <td class="align-middle" style="text-align: center;"><img :src="activo.imagen" alt="activo" width="75"></td>
                            <td class="align-middle" style="text-align: center;"><b>{{ activo.codactivo}}</b></td>
                            <td class="align-middle" style="text-align: center;">{{ activo.descripcion }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomambiente }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomgrupo }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomauxiliar }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.fechaingreso }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.costo }}</td>
                            <td v-if="activo.activo==1" class="button-group align-middle" style="text-align: center;">  
                                    
                                    <div v-if="activo.idasignacion>0">
                                        <button v-if="activo.asigactivo==0" class="btn btn-danger" @click="eliminarActivo(activo.idactivo,activo.codactivo)">
                                        <i class="ti-close"></i>
                                    </button>
                                    <span v-else style="display: block;" class="badge bg-success">Asignado</span>
                                    </div>
                                    <button v-else class="btn btn-danger" @click="eliminarActivo(activo.idactivo,activo.codactivo)">
                                        <i class="ti-close"></i>
                                    </button>
                                   
                            </td>
                            <td v-else class="button-group align-middle" style="text-align: center;"> 
                                <button class="btn btn-warning btn-sm"
                                        @click="openModal(2,activo.idactivo,activo.codactivo,activo.fechabaja,activo.nrordenbaja,activo.idmotivobaja,activo.obsbaja)">
                                        <i class="ti-eye"></i>&nbsp;&nbsp;Ver detalles
                                    </button>  
                                <span style="display: block;" class="badge bg-danger">Dado de baja </span> 
                            </td> 
                        </tr>
                      </tbody>
                     
                    </table>
                    <pagination class="mt-6" :links="activos.links" />
                  </div>
                  <div class="row">
                    <div class=" col-md-12 justify-content-end align-self-center d-none d-md-flex ">
                         <div class="d-flex m-2">
                            <button class="btn btn-info" @click="reporteasignacion()">
                                <i class="fill-white ti-file"></i>
                                Reporte
                            </button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
        <!-- ==================================================================================== -->
        <div class="modal fade" id="modalasignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalasignacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content"> 
                    <div class="
                              modal-header modal-colored-header
                              bg-danger
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
                                            <div :class="formasig.errors.fechabaja?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fechabaja" ref="nameinput" v-model="formasig.fechabaja" type="date"  >
                                                    </TextInput> 
                                                <label for="fechabaja">Fecha de Baja</label>
                                                <small v-show="formasig.errors.fechabaja" class="form-control-feedback">
                                                    {{formasig.errors.fechabaja}}
                                                    </small> 
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.idmotivobaja?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idmotivobaja">Motivo de baja</label> 
                                                    <SelectInputMotivos class="form-select form-select-lg mb-3" id="idmotivobaja" v-model="formasig.idmotivobaja" type="text" :options="motivos"  >
                                                    </SelectInputMotivos>  
                                                <small v-show="formasig.errors.idmotivobaja" class="form-control-feedback">
                                                    {{formasig.errors.idmotivobaja}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.nrordenbaja?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="nrordenbaja" ref="nameinput" v-model="formasig.nrordenbaja" type="text"   >
                                                    </TextInput> 
                                                <label for="nrordenbaja">Nro. Orden</label>
                                                <small v-show="formasig.errors.nrordenbaja" class="form-control-feedback">
                                                    {{formasig.errors.nrordenbaja}}
                                                    </small> 
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.obsbaja?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <textarea rows="5" class="form-control" id="obsbaja" ref="nameinput" v-model="formasig.obsbaja" type="text"   >
                                                    </textarea> 
                                                <label for="obsbaja">Observaciones</label>
                                                <small v-show="formasig.errors.obsbaja" class="form-control-feedback">
                                                    {{formasig.errors.obsbaja}}
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
                    <div   >
                        <button  type="button" class="
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
        </div>
        <!-- ==================================================================================== -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalasignacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content"> 
                    <div class="
                              modal-header modal-colored-header
                              bg-danger
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
                                            <div :class="formasig.errors.fechabaja?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fechabaja" ref="nameinput" v-model="formasig.fechabaja" type="date" readonly >
                                                    </TextInput> 
                                                <label for="fechabaja">Fecha de Baja</label>
                                                <small v-show="formasig.errors.fechabaja" class="form-control-feedback">
                                                    {{formasig.errors.fechabaja}}
                                                    </small> 
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.idmotivobaja?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idmotivobaja">Motivo de baja</label> 
                                                    <SelectInputMotivos class="form-select form-select-lg mb-3" id="idmotivobaja" v-model="formasig.idmotivobaja" type="text" :options="motivos" disabled >
                                                    </SelectInputMotivos>  
                                                <small v-show="formasig.errors.idmotivobaja" class="form-control-feedback">
                                                    {{formasig.errors.idmotivobaja}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.nrordenbaja?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="nrordenbaja" ref="nameinput" v-model="formasig.nrordenbaja" type="text"  readonly >
                                                    </TextInput> 
                                                <label for="nrordenbaja">Nro. Orden</label>
                                                <small v-show="formasig.errors.nrordenbaja" class="form-control-feedback">
                                                    {{formasig.errors.nrordenbaja}}
                                                    </small> 
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-12">
                                            <div :class="formasig.errors.obsbaja?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <textarea rows="5" class="form-control" id="obsbaja" ref="nameinput" v-model="formasig.obsbaja" type="text"  readonly >
                                                    </textarea> 
                                                <label for="obsbaja">Observaciones</label>
                                                <small v-show="formasig.errors.obsbaja" class="form-control-feedback">
                                                    {{formasig.errors.obsbaja}}
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
                    </div>
 

                </div>
            </div>
        </div>
    </Menu>
</template>
