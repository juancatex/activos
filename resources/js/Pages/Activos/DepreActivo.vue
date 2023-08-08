<script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm,router } from '@inertiajs/vue3'; 
import Pagination from '@/Components/Paginations.vue'; 
import TextInput from '@/Components/TextInput.vue'; 
import Swal from 'sweetalert2';
import {ref,nextTick,watch,computed} from 'vue'; 
import { debounce,findIndex,reduce } from 'lodash';
import moment from 'moment';
const nameinput=ref(null); 
const titulo=ref('');
const searchField=ref('');
const searchambiente=ref(null);
const searchfecha=ref(null);
const arrayDepreciaciones=ref([]);
const usuarioprincipal=ref({});
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
router.get('Depre',  {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
}, 300));
watch(searchambiente, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('Depre', {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
}, 300));
watch(searchfecha, debounce(() => {
// router.get('ActivoAsig', {search: searchField.value}, {preserveState: true})
router.get('Depre', {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos']})
}, 300));
 
const props = defineProps({
    menus: {
        type: Object,
    }, 
    activos: {
        type: Object,
    },
    ufvini: {
        type: Object,
    },
    ufvfin: {
        type: Object,
    },
    ambiente: {
        type: Object,
    },
        
});
 function  diastransc(fini,ffin){ //dias transcurridos
            var fechaini = new Date(fini);
            var fechafin = new Date(ffin);
            return Math.round((fechafin.getTime()-fechaini.getTime())/86400000);
        }
        function tiempotransc(fini,ffin){
            var aa=ffin.substr(0,4)-fini.substr(0,4);
            var mm=ffin.substr(5,2)-fini.substr(5,2);
            if(mm<0) {mm=12+mm; aa--;} 
            return aa+'a'+' '+mm+'m';
        }
function formatomon(x){  //215451.325145 --> 215,451.32
            if(x<0) x*=-1;
            var num=Math.round(x*100)/100;
            var cad=num.toString();
            if(!cad.includes('.')) cad=cad+'.00';
            cad=cad.split('').reverse();
            if(cad[1]=='.') cad.unshift('0');
            var arr=[]; var c=0;
            for(var i=0;i<cad.length;i++){
                if(i<3) arr.push(cad[i]);
                else {
                    if(c<3){ arr.push(cad[i]); c++; }
                    else { arr.push(','); c=0; i--; }
                }
            }
            return arr.reverse().join('');
        }
const openModalAsig=(activo)=>{ 
    usuarioprincipal.value=activo;   
    titulo.value='Depreciación de activos';
   /* var gesini=activo.anio;
    var gesfin=activo.aniofin;
    var depranual=(activo.costo/activo.vida);
    var depracum=0;
    arrayDepreciaciones.value=[];
   for(var ges=gesini; ges<gesfin; ges++){
                var regDepreciacion=new Object();
                regDepreciacion.gestion=ges;
                regDepreciacion.ufvini=props.ufvini[ges-2008].valor;
                regDepreciacion.ufvfin=props.ufvfin[ges-2008].valor;
                regDepreciacion.depranual=depranual;
                if(ges==gesini) {
                    regDepreciacion.ufvini=activo.valor;
                    var cantdias= diastransc(activo.fechaingreso,gesini+'-12-31')
                    regDepreciacion.depranual=(activo.costo/(activo.vida*365))*cantdias;
                }
                regDepreciacion.incranual=activo.costo*((regDepreciacion.ufvfin/regDepreciacion.ufvini)-1);
                depracum+=regDepreciacion.depranual;
                regDepreciacion.depracum=depracum;
                regDepreciacion.valorfin=activo.costo-depracum+regDepreciacion.incranual;
                var ini=activo.fechaingreso; 
                var fin=ges+'-12-31';
                regDepreciacion.consumido=tiempotransc(ini,fin);
                ini=(ges+1)+'-01-01'; fin=(gesini+activo.vida)+activo.fechaingreso.substr(4,6);
                regDepreciacion.saldovida=tiempotransc(ini,fin);
                arrayDepreciaciones.value.push(regDepreciacion);
                console.log(regDepreciacion);
            }*/
                 _pl.preparando(); 
                 axios.post('/getdepre',{
                                'id':activo.idactivo
                            }).then(function (response) {  
                                arrayDepreciaciones.value=response.data;
                       _pl.close();
                    $('#modalasignacion').modal('show');  
                })
                .catch(function (error) {
                    console.log(error);
                });
   
  
};
 
const closeModal=()=>{ 
    form.reset();
    formasig.reset();
    $('#staticBackdrop').modal('hide'); 
    $('#modalasignacion').modal('hide'); 
};
  function getanios(meses){
   var anios=0;
   var outmeses=meses;
   while (outmeses>=12) {
    anios++;
    outmeses-=12; 
   } 
return anios+"años y "+outmeses+"meses"; 
  }
async function depreciar(){
   // _pl.startReport(); 
   _pl.startDepre();
                try {
                    var result = await axios.get("/getall");
                    await axios.post("/trunn"); 
                    var posi=0;
                    var sizema=result.data.length;  
                    for (var element of result.data){
                        posi++;
                        var valuestatus=parseInt((posi*100)/sizema); 
                        $('.progress-bar[id="save"]').css('width', valuestatus+'%').attr('aria-valuenow', valuestatus).text(valuestatus+'%');  
                        $('#text_saving').text('Depreciando activo COD: '+element.codactivo);
                            await axios.post('deprecion',{
                                'id':element.idactivo
                            }); 
                    } 
                    _pl.ok("Se depreciaron los activos correctamente");
                    router.get('Depre', {searchambiente: searchambiente.value,search: searchField.value,searchfecha: searchfecha.value}, {preserveState: true, preserveScroll: true, only: ['activos']});
                } catch (error) {
                    console.log(error);
                }
 }
   
</script>

<template>
    <Head title="Depreciación" /> 
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
                        Depreciación de activos
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
                <button class="btn btn-success" @click="depreciar()">
                  <i   class="fill-white ti-desktop"></i>
                  Actualizar la depreciación de activos
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
                          <th class="align-middle" style="text-align: center;">Grupo</th>
                          <th class="align-middle" style="text-align: center;">Auxiliar</th>  
                          <th class="align-middle" style="text-align: center;">Unidad Funcional</th>
                          <th class="align-middle" style="text-align: center;">Fecha de Ingreso</th>
                          <th class="align-middle" style="text-align: center;">Valor de compra</th>
                          <th class="align-middle" style="text-align: center;">Vida util</th>
                         
                          <th class="align-middle" style="text-align: center;">Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="activo in activos.data" :key="activo.idactivo">
                            <td class="align-middle" style="text-align: center;"><img :src="activo.imagen" alt="activo" width="75"></td>
                            <td class="align-middle" style="text-align: center;"><b>{{ activo.codactivo}}</b></td> 
                            <td class="align-middle" style="text-align: center;">{{ activo.nomgrupo }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.nomauxiliar }}</td> 
                            <td class="align-middle" style="text-align: center;">{{ activo.nomambiente }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.fechaingreso }}</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.costo }} Bs.</td>
                            <td class="align-middle" style="text-align: center;">{{ activo.vida }} Años</td>
                            
                            <td class="button-group align-middle" style="text-align: center;">   
                                    <button   class="btn btn-success"
                                        @click="openModalAsig(activo)">
                                        <i class="fill-white ti-eye"> Ver estado</i>
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
        
        <!-- ==================================================================================== -->
        <div class="modal fade" id="modalasignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalasignacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
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
                                           <h1 style=" text-align: center;font-weight: bold;margin-bottom: 23px;">{{usuarioprincipal.codactivo}}</h1>
                                        </div>
                                         
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3"> 
                                                    <TextInput class="form-control" id="obs" ref="nameinput" v-model="usuarioprincipal.costo" type="text" >
                                                    </TextInput> 
                                                <label for="obs">Costo</label> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3"> 
                                                    <TextInput class="form-control" id="obs" ref="nameinput" v-model="usuarioprincipal.residual" type="text" >
                                                    </TextInput> 
                                                <label for="obs">Residual</label> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3"> 
                                                    <TextInput class="form-control" id="obs" ref="nameinput" v-model="usuarioprincipal.coeficiente" type="text" > 
                                                    </TextInput> 
                                                <label for="obs">Coeficiente</label> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3"> 
                                                    <TextInput class="form-control" id="obs" ref="nameinput" v-model="usuarioprincipal.vida" type="text" > 
                                                    </TextInput> 
                                                <label for="obs">Vida util</label> 
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                          
                                            <div class="table-responsive">
                                                  <table  class="table table-bordered" style="font-size: 11px;">
                                                <thead class="tcabecera">
                                                    <tr align="center">
                                                        <th>Gestión</th>
                                                        <th>UFV Inicio</th>
                                                        <th>UFV Cierre</th>
                                                        <th>Mes periodo</th>
                                                        <th>Consumido</th>
                                                        <th>Saldo de vida</th>
                                                        <th>Incremento</th>
                                                        <th style="background-color: antiquewhite;">Valor actualizado</th>
                                                        <th>Depreciación acumulada periodo anterior</th>
                                                        <th>Incremento depreciación acumulada</th>
                                                        <th>Depreciación del periodo</th>
                                                        <th>Depreciación acumulada actualizada</th> 
                                                        <th style="background-color: rgb(0 255 17 / 30%);">Valor neto</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="depreciacion in arrayDepreciaciones" :key="depreciacion.iddepre" align="center">
                                                        <td v-text="depreciacion.gestion"></td> 
                                                        <td v-text="depreciacion.ufvi"></td> 
                                                        <td v-text="depreciacion.ufvf"></td>
                                                        <td v-text="depreciacion.vidat"></td>
                                                        <td v-text=" getanios(depreciacion.vidai)"></td>
                                                        <td v-text=" getanios(depreciacion.vidaf)"></td>
                                                        <td v-text="depreciacion.ia"></td>
                                                        <td style="background-color: antiquewhite;" v-text="depreciacion.va"></td>
                                                        <td v-text="depreciacion.daan"></td>
                                                        <td v-text="depreciacion.ida"></td>
                                                        <td v-text="depreciacion.pd"></td>
                                                        <td v-text="depreciacion.acu"></td> 
                                                        <td style="background-color: rgb(0 255 17 / 30%);" v-text="depreciacion.valor>=0?depreciacion.valor:0"></td> 
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
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
