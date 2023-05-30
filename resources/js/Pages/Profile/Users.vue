 <script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm } from '@inertiajs/vue3'; 
import Pagination from '@/Components/Paginations.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInputUnidad from '@/Components/SelectInputUnidad.vue';
import SelectInputrol from '@/Components/SelectInputrol.vue';
import Swal from 'sweetalert2';
import {ref,nextTick} from 'vue';
const nameinput=ref(null); 
const titulo=ref('');
const operacion=ref(1); 


const form = useForm({
    id: null,
    name: '',
    ap: '',
    am: '',
    email: '',
    ci: null,
    cel: null,
    dir: '',
    fecnac: '',
    fecin: '',
    idrol: null,
    idu: null 
});
const props = defineProps({
    menus: {
        type: Object,
    },
    users: {
        type: Object,
    },
    roles: {
        type: Object,
    },
    unidades: {
        type: Object,
    },
    status: {
        type: String,
    },
});
const openModal=(op,iduser,name,ap,am,email,ci,cel,dir,fecnac,fecin,idrol,idu)=>{ 
    nextTick(()=>nameinput.value.focus());
    operacion.value=op; 
    if(op==1){
        titulo.value='Crear personal';
        form.reset();
    }else{
        titulo.value='Modificar personal';
        form.id=iduser;
        form.name=name;
        form.ap=ap;
        form.am=am;
        form.email=email;
        form.ci=ci;
        form.cel=cel;
        form.dir=dir;
        form.fecnac=fecnac;
        form.fecin=fecin;
        form.idrol=idrol;
        form.idu=idu;

    }
    $('#staticBackdrop').modal('show'); 
};
const closeModal=()=>{ 
    form.reset();
    $('#staticBackdrop').modal('hide'); 
};
const guardarDatos=()=>{
   if(operacion.value==1){
    form.post(route('User.store'),{onSuccess:()=>{ok('Creado correctamente')}  });
   }else{
    form.put(route('User.update',form.id),{onSuccess:()=>{ok('Modificado correctamente')}  });
   }
};

const ok =(msj)=>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
const eliminarUser=(id)=>{
    
const alerta=Swal.mixin({buttonsStyling:true});
alerta.fire({
    title:'¿Esta seguro de eliminar el registro?',
    icon:'question',showCancelButton:true,
    confirmButtonText:'<i class="ti-check"></i> Si',
    cancelButtonText:'<i class="ti-close"></i> Cancelar'
}).then(
    (result)=>{
        if(result.isConfirmed){ 
            form.id=id;
            form.post(route('userdestroy'),{onSuccess:()=>{ok('Eliminado correctamente')}  });
        } 
    }
);
};
</script>

<template>
    <Head title="Personal" /> 
    <Menu :listmenus="menus">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-md-5 align-self-center">
              <h3 class="page-title">Personal</h3>
              <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a>
                        <Link   :href="route('dashboard')"> 
                         </Link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Personal
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
                  Registrar nuevo personal
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
                  <h4 class="card-title mb-0">Listado general del personal</h4>
                </div>
                <div class="card-body"> 
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>Nombre completo</th>
                          <th>C.I.</th>
                          <th>Correo Electronico</th>
                          <th>Fecha de Ingreso</th>
                          <th>Celular</th>
                          <th>Cargo</th>
                          <th>Unidad</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td>{{ user.full_name}}</td>
                            <td>{{ user.ci }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.fecin }}</td>
                            <td>{{ user.cel }}</td>
                            <td>{{ user.nomrol }}</td>
                            <td>{{ user.nomuni }}</td> 
                            <td class="button-group">  
                                   <button class="btn btn-warning"
                                        @click="openModal(2,user.id,user.name,user.ap,user.am,user.email,user.ci,user.cel,user.dir,user.fecnac,user.fecin,user.idrol,user.idu)">
                                        <i class="ti-book"></i>
                                    </button> 
                                
                                    <button class="btn btn-danger" @click="eliminarUser(user.id)">
                                        <i class="ti-close"></i>
                                    </button>
                                
                            </td> 
                        </tr>
                      </tbody>
                     
                    </table>
                    <pagination class="mt-6" :links="users.links" />
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
                                        <div class="col-md-3">
                                            <div :class="form.errors.name?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="name" ref="nameinput" v-model="form.name" type="text"  >
                                                    </TextInput> 
                                                <label for="name">Nombre</label>
                                                <small v-show="form.errors.name" class="form-control-feedback">
                                                    {{form.errors.name}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div :class="form.errors.ap?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="ap" ref="nameinput" v-model="form.ap" type="text" >
                                                    </TextInput> 
                                                <label for="ap">Apellido Paterno</label>
                                                <small v-show="form.errors.ap" class="form-control-feedback">
                                                    {{form.errors.ap}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div :class="form.errors.am?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="am" ref="nameinput" v-model="form.am" type="text" >
                                                    </TextInput> 
                                                <label for="am">Apellido Materno</label>
                                                <small v-show="form.errors.am" class="form-control-feedback">
                                                    {{form.errors.am}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div :class="form.errors.ci?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="ci" ref="nameinput" v-model="form.ci" type="number" >
                                                    </TextInput> 
                                                <label for="ci">C.I.</label>
                                                <small v-show="form.errors.ci" class="form-control-feedback">
                                                    {{form.errors.ci}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div :class="form.errors.dir?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="dir" ref="nameinput" v-model="form.dir" type="text" >
                                                    </TextInput> 
                                                <label for="dir">Dirección</label>
                                                <small v-show="form.errors.dir" class="form-control-feedback">
                                                    {{form.errors.dir}}
                                                    </small> 
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div :class="form.errors.cel?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="cel" ref="nameinput" v-model="form.cel" type="number" >
                                                    </TextInput> 
                                                <label for="cel">Celular</label>
                                                <small v-show="form.errors.cel" class="form-control-feedback">
                                                    {{form.errors.cel}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div :class="form.errors.email?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="email" ref="nameinput" v-model="form.email" type="email" >
                                                    </TextInput> 
                                                <label for="email">Correo</label>
                                                <small v-show="form.errors.email" class="form-control-feedback">
                                                    {{form.errors.email}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div :class="form.errors.fecnac?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fecnac" ref="nameinput" v-model="form.fecnac" type="date" >
                                                    </TextInput> 
                                                <label for="fecnac">Fecha de Nacimiento</label>
                                                <small v-show="form.errors.fecnac" class="form-control-feedback">
                                                    {{form.errors.fecnac}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div :class="form.errors.fecin?'form-floating mb-3 has-danger':'form-floating mb-3'"> 
                                                    <TextInput class="form-control" id="fecin" ref="nameinput" v-model="form.fecin" type="date" >
                                                    </TextInput> 
                                                <label for="fecin">Fecha de Incorporación</label> 
                                                <small v-show="form.errors.fecin" class="form-control-feedback">
                                                    {{form.errors.fecin}}
                                                    </small> 
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div :class="form.errors.idrol?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idrol">Cargo</label> 
                                                    <SelectInputrol class="form-select form-select-lg mb-3" id="idrol" ref="nameinput" v-model="form.idrol"
                                                    type="text" :options="roles">
                                                    </SelectInputrol>  
                                                <small v-show="form.errors.idrol" class="form-control-feedback">
                                                    {{form.errors.idrol}}
                                                    </small> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div :class="form.errors.idu?'  mb-3 has-danger':'  mb-3'"> 
                                                <label for="idu">Unidad</label> 
                                                    <SelectInputUnidad class="form-select form-select-lg mb-3" id="idu" v-model="form.idu" type="text" :options="unidades">
                                                    </SelectInputUnidad>  
                                                <small v-show="form.errors.idu" class="form-control-feedback">
                                                    {{form.errors.idu}}
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
