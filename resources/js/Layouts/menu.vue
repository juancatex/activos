<script setup>
    import { ref,  onMounted, onUnmounted,computed  } from 'vue'; 
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {
    Link,usePage 
} from '@inertiajs/vue3';
const props =defineProps({
    listmenus: {
        type: Object,
    },
});  
 

const page = usePage()
 const handleResize = () => {
     if (window.innerWidth < 766) {
         document.getElementById("main-wrapper").setAttribute("data-sidebartype", "mini-sidebar");
     } else {
         document.getElementById("main-wrapper").setAttribute("data-sidebartype", "full");
     }
 }

 onMounted(() => {
     window.addEventListener('resize', handleResize)
 })

 onUnmounted(() => {
     window.removeEventListener('resize', handleResize)
 })
 const closemenu = () => {

     if (document.getElementById("main-wrapper").getAttribute("data-sidebartype") == 'full') {
         document.getElementById("main-wrapper").setAttribute("data-sidebartype", "mini-sidebar");
     } else {
         document.getElementById("main-wrapper").setAttribute("data-sidebartype", "full");
     }
 };
 
 const clickMenu = (invalue) => {
    const clasedetalle = document.getElementsByClassName("detallemenu"); 
    for (let i = 0; i < clasedetalle.length; i++) {
        if(clasedetalle[i].previousSibling.id!=invalue){
            clasedetalle[i].classList.remove("in");
        }
    } 
    const clasemenus = document.getElementsByClassName("titulomenu"); 
    for (let i = 0; i < clasemenus.length; i++) { 
        if(clasemenus[i].id!=invalue){
            clasemenus[i].classList.remove("active");
        }
    } 
 document.getElementById(invalue).classList.toggle("active");
 document.getElementById(invalue).nextElementSibling.classList.toggle("in");
};

</script>

<template>


    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin1" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="boxed" class="mini-sidebar">
        <header class="topbar" data-navbarbg="skin1">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6" data-navheader="fixed">

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"
                        @click="closemenu"><i class="ti-menu ti-close"></i>
                    </a>
                    <Link :href="route('dashboard')" class="navbar-brand" style="border-bottom: 1px solid #80808082;"> <b class="logo-icon">  <img src="/assets/images/muge-icon.png" alt="Mugebuch" class="dark-logo" style="width: 100%;">  </b> 
                        <span class="logo-text">  <img src="/assets/images/mugetext.png" alt="Mugebuch" class="dark-logo" style="width: 100%;"> </span>
                    </Link> 
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i>
                    </a>
                </div>
              
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin1"> 
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar" @click="closemenu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-left-circle feather-sm">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 8 8 12 12 16"></polyline>
                                    <line x1="16" y1="12" x2="8" y2="12"></line>
                                </svg></a>
                        </li> 
                    </ul>
                 
                    <ul class="navbar-nav"> 
                      <!-- ============================================================== -->
                        <li class="nav-item search-box d-none d-md-flex align-items-center">
                            <div class="nav-link">
                                <form class="app-search">
                                    <input type="text" class="form-control rounded-pill border-0"
                                        placeholder="Buscar por...">
                                    <a class="srh-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search feather-sm fill-white mt-n1">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg></a>
                                </form>
                            </div>
                         </li> 
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/assets/images/users/5.jpg" alt="user" width="30"
                                    class="profile-pic rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                                    <div class="">
                                        <img src="/assets/images/users/5.jpg" alt="user" class="rounded-circle"
                                            width="60">
                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-0 text-white">{{page.props.auth.user.name}}</h4>
                                        <p class="mb-0">{{page.props.auth.user.email}}</p>
                                    </div>
                                </div>  
                                    <DropdownLink :href="route('profile.edit')" class="dropdown-item"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user feather-sm text-info me-1 ms-1">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Mi perfil </DropdownLink>
                                    <div class="dropdown-divider"></div>
                                        <DropdownLink :href="route('logout')" method="post" as="button" class="dropdown-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-log-out feather-sm text-danger me-1 ms-1">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg> Salir
                                        </DropdownLink>
                            </div>
                        </li>
                     
                    </ul>
                </div>
            </nav>
        </header>
      
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6"> 
            <div class="scroll-sidebar ps-container ps-theme-default ps-active-y"
                data-ps-id="329bc848-bcb6-3154-778b-841dab571614"> 
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                        
                        
                       
                        <template v-for="valuegrupo in listmenus" :key="valuegrupo.id">
                            <li class="nav-small-cap">
                                <i class="mdi mdi-dots-horizontal"></i>
                                <span class="hide-menu">{{valuegrupo.grupo}}</span>
                            </li>
                                    <li v-for="valuelista in valuegrupo.lista" :key="valuelista.id" class="sidebar-item" :class="{'selected':valuelista.active}"  @click="clickMenu('menu-'+valuegrupo.id+'-'+valuelista.id)"> 
                                        
                                               <a :id="'menu-'+valuegrupo.id+'-'+valuelista.id" class="sidebar-link titulomenu has-arrow waves-effect waves-dark" :class="{'active':valuelista.active}" href="javascript:void(0)"
                                                aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-home feather-icon">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg><span class="hide-menu">{{valuelista.menu}}
                                                   </span>
                                                </a>
 
                                               
                                                        <ul aria-expanded="false" class="collapse detallemenu first-level"  :class="{'in':valuelista.active}"> 
                                                            <Link v-for="valueroutes in valuelista.routes" :key="valueroutes.id+'lista'" :id="'menu-'+valuegrupo.id+'-'+valuelista.id+'-'+valueroutes.id" 
                                                            :href="route(valueroutes.route,{'touch':valuegrupo.id+'-'+valuelista.id+'-'+valueroutes.id})">
                                                            <li class="sidebar-item" :class="{'active':valueroutes.active}">
                                                                <a class="sidebar-link"  :class="{'active':valueroutes.active}"><i class="mdi mdi-adjust"></i><span class="hide-menu"> {{valueroutes.nombre}} </span></a>
                                                            </li>
                                                            </Link> 
                                                        </ul>
                                         
                                        
                                    </li>
                            <li class="nav-devider"></li>
                        </template> 
                       
                    </ul>
                </nav> 
            </div>
         
            <div class="sidebar-footer" style="    height: 50px;">
                <span class="hide-menu" style="text-align: center;  width: 100%;">Version 1.2.1</span>
            </div>
          
        </aside>
      
        <div class="page-wrapper" style="display: block;">
            <slot />
        </div>
    </div>

</template>
