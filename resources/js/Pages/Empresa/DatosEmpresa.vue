<script setup>
import Menu from '@/Layouts/menu.vue'; 
import { Head,Link,useForm } from '@inertiajs/vue3';  
import Swal from 'sweetalert2';
import {ref} from 'vue'; 
  
const operacion=ref(1); 
const props = defineProps({
    menus: {
        type: Object,
    }, 
    datosempresa: {
        type: Object,
    }, 
});

const form = useForm({
    idempresa:props.datosempresa.idempresa,
    nombre:props.datosempresa.nombre,
    direccion: props.datosempresa.direccion,
    nit: props.datosempresa.nit,
    telefono1: props.datosempresa.telefono1,
    telefono2: props.datosempresa.telefono2,
    telefono3: props.datosempresa.telefono3,
    telefono4: props.datosempresa.telefono4, 
    ciudad: props.datosempresa.ciudad,
    web: props.datosempresa.web,
    email: props.datosempresa.email        
}); 
 
 
 
function editar(){
    operacion.value=0;
}
 
const closeModal=()=>{ 
    form.reset();  
    operacion.value=1;
    reset();
};
function reset(){
    form.idempresa=props.datosempresa.idempresa;
    form.nombre=props.datosempresa.nombre;
    form.direccion=props.datosempresa.direccion;
    form.nit=props.datosempresa.nit;
    form.telefono1=props.datosempresa.telefono1;
    form.telefono2= props.datosempresa.telefono2;
    form.telefono3= props.datosempresa.telefono3;
    form.telefono4= props.datosempresa.telefono4;
    form.ciudad= props.datosempresa.ciudad;
    form.web= props.datosempresa.web;
    form.email=props.datosempresa.email;
}

const guardarDatos=()=>{ 
    form.put(route('Empresa.update',form.idempresa),{onSuccess:()=>{ok('Modificado correctamente')}  });
   operacion.value=1;
   
};
 
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
   
</script>

<template>
    <Head title="Datos empresa" /> 
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
                         Datos de la empresa
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
                            <h4 class="card-title mb-0">Datos generales de la empresa</h4>
                        </div>
                        <div class="card-body">
                            <form >
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                            <div  :class="form.errors.nombre?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="text" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Nombre"  v-model="form.nombre" :readonly="operacion==1"/>
                                            <label><i   class="ti-book text-dark fill-white me-2"></i>Nombre</label>
                                            <small v-show="form.errors.nombre" class="form-control-feedback">
                                                    {{form.errors.nombre}}  
                                             </small> 
                                            </div>
                                           
                                        

                                    </div>
                                    <div class="col-md-4">
                                        <div  :class="form.errors.email?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="email" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Correo electronico" v-model="form.email" :readonly="operacion==1"/>
                                            <label><i class="ti-email text-dark fill-white me-2"></i>Correo electronico</label>
                                            <small v-show="form.errors.email" class="form-control-feedback">
                                                    {{form.errors.email}}  
                                             </small> 
                                        </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div  :class="form.errors.web?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="text" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Pagina web" v-model="form.web" :readonly="operacion==1"/>
                                            <label><i class="ti-world text-dark fill-white me-2"></i>Pagina web</label>
                                            <small v-show="form.errors.web" class="form-control-feedback">
                                                    {{form.errors.web}}  
                                             </small> 
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div  :class="form.errors.nit?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="number" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="NIT"  v-model="form.nit" :readonly="operacion==1"/>
                                            <label><i class="ti-key text-dark fill-white me-2"></i>NIT</label>
                                            <small v-show="form.errors.nit" class="form-control-feedback">
                                                    {{form.errors.nit}}  
                                             </small>
                                            </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div  :class="form.errors.direccion?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="text" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Dirección" v-model="form.direccion" :readonly="operacion==1"/>
                                            <label><i class="ti-map-alt text-dark fill-white me-2"></i>Dirección</label>
                                            <small v-show="form.errors.direccion" class="form-control-feedback">
                                                    {{form.errors.direccion}}  
                                             </small>
                                        </div> 
                                    </div> 
                                     
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div  :class="form.errors.ciudad?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="text" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Ciudad"  v-model="form.ciudad" :readonly="operacion==1"/>
                                            <label><i class="ti-pin-alt text-dark fill-white me-2"></i>Ciudad</label>
                                            <small v-show="form.errors.ciudad" class="form-control-feedback">
                                                    {{form.errors.ciudad}}  
                                             </small>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div  :class="form.errors.telefono1?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="number" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Telefono 1" v-model="form.telefono1" :readonly="operacion==1"/>
                                            <label><i class="ti-mobile text-dark fill-white me-2"></i>Telefono 1</label>
                                            <small v-show="form.errors.telefono1" class="form-control-feedback">
                                                    {{form.errors.telefono1}}  
                                             </small>
                                        </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div  :class="form.errors.telefono2?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="number" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Telefono 2" v-model="form.telefono2" :readonly="operacion==1"/>
                                            <label><i class="ti-mobile text-dark fill-white me-2"></i>Telefono 2</label>
                                            <small v-show="form.errors.telefono2" class="form-control-feedback">
                                                    {{form.errors.telefono2}}  
                                             </small>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row">
                                     
                                    <div class="col-md-4">
                                        <div  :class="form.errors.telefono3?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="number" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Telefono 3" v-model="form.telefono3" :readonly="operacion==1"/>
                                            <label><i class="ti-mobile text-dark fill-white me-2"></i>Telefono 3</label>
                                            <small v-show="form.errors.telefono3" class="form-control-feedback">
                                                    {{form.errors.telefono3}}  
                                             </small>
                                        </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div  :class="form.errors.telefono4?'form-floating mb-3 has-danger':'form-floating mb-3'">
                                            <input type="number" :class="operacion==0?'form-control border border-info':'form-control'" placeholder="Telefono 4" v-model="form.telefono4" :readonly="operacion==1"/>
                                            <label><i class="ti-mobile text-dark fill-white me-2"></i>Telefono 4</label>
                                            <small v-show="form.errors.telefono4" class="form-control-feedback">
                                                    {{form.errors.telefono4}}  
                                             </small>
                                        </div> 
                                    </div> 
                                </div>

                                <div class="d-md-flex align-items-center"> 
                                    <div class="mt-3 mt-md-0 ms-auto">
                                          <button v-if="operacion==1" class="btn btn-warning"
                                                @click="editar()">
                                                <i class="ti-book"></i>&nbsp;&nbsp;Editar
                                         </button> 
                                         <button v-else class="btn btn-success"
                                                @click="guardarDatos()">
                                                <i class="ti-plus"></i>&nbsp;&nbsp;Guardar
                                         </button> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </Menu>
</template>
