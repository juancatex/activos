 
<script setup> 
import Menu from '@/Layouts/menu.vue';
import { Head } from '@inertiajs/vue3';
import {onMounted} from 'vue'; 
const props =defineProps({ 
    status: {
        type: String,
    },
    menus: {
        type: Object,
    },
    arraybajas: {
        type: Object,
    },
    arrayaltas: {
        type: Object,
    },
    totalasig: {
        type: Number,
    },
    sinasig: {
        type: Number,
    },
    anio: {
        type: Number,
    },
    sumatotal: {
        type: Number,
    },
    totala: {
        type: Number,
    },
    totalb: {
        type: Number,
    },
    totalasigp: {
        type: Number,
    },
    sinasigp: {
        type: Number,
    },
    activosporbaja: {
        type: Number,
    },
    activosporbajap: {
        type: Number,
    },
});

  

onMounted(() => {
  var Revenue_Statistics = {
    series: [
      {
        name: "Altas",
        data: props.arrayaltas,
      },
      {
        name: "Bajas",
        data: props.arraybajas,
      },
    ],
    chart: {
      fontFamily: "Rubik,sans-serif",
      height: 350,
      type: "area",
      toolbar: {
        show: false,
      },
    },
    fill: {
      type: "solid",
      opacity: 0.2,
      colors: ["#009efb", "#39c449"],
    },
    grid: {
      show: true,
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: true,
        },
      },
    },
    colors: ["#009efb", "#39c449"],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
      width: 1,
      colors: ["#009efb", "#39c449"],
    },
    markers: {
      size: 3,
      colors: ["#009efb", "#39c449"],
      strokeColors: "transparent",
    },
    xaxis: {
      axisBorder: {
        show: true,
      },
      axisTicks: {
        show: true,
      },
      categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      labels: {
        style: {
          colors: "#a1aab2",
        },
      },
    },
    yaxis: {
      tickAmount: 9,
      labels: {
        style: {
          colors: "#a1aab2",
        },
      },
    },
    tooltip: {
      x: {
        format: "dd/MM/yy HH:mm",
      },
      theme: "dark",
    },
    legend: {
      show: false,
    },
  };
  var chart_area_spline = new ApexCharts(
    document.querySelector("#revenue-statistics"),
    Revenue_Statistics
  );
  chart_area_spline.render();
        });
</script>
<style> 
.cuerpo{
    height: 16vh;
    vertical-align: middle;
    display: flex;
}
.stage {
      height: 101px;
    width: 100%;
    margin: auto;
    position: relative;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transform-style: preserve-3d;
}

.layer {
  width: 100%;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  animation: ಠ_ಠ 5s infinite alternate ease-in-out -7.5s;
  animation-fill-mode: forwards;
  transform: rotateY(15deg) rotateX(15deg) translateZ(0);
}

.layer:after {
  font: 100px/0.65 'Pacifico', 'Kaushan Script', Futura, 'Roboto', 'Trebuchet MS', Helvetica, sans-serif;
  content: 'Sistema SGAF';
  white-space: pre;
  text-align: center;
  height: 100%;
  width: 100%;
  position: absolute;
   
  color: whitesmoke;
  letter-spacing: -2px;
  text-shadow: 4px 0 10px rgba(0, 0, 0, 0.13);
}

.layer:nth-child(1):after {
  transform: translateZ(0px);
}

.layer:nth-child(2):after {
  transform: translateZ(-1.5px);
}

.layer:nth-child(3):after {
  transform: translateZ(-3px);
}

.layer:nth-child(4):after {
  transform: translateZ(-4.5px);
}

.layer:nth-child(5):after {
  transform: translateZ(-6px);
}

.layer:nth-child(6):after {
  transform: translateZ(-7.5px);
}

.layer:nth-child(7):after {
  transform: translateZ(-9px);
}

.layer:nth-child(8):after {
  transform: translateZ(-10.5px);
}

.layer:nth-child(9):after {
  transform: translateZ(-12px);
}

.layer:nth-child(10):after {
  transform: translateZ(-13.5px);
}

.layer:nth-child(11):after {
  transform: translateZ(-15px);
}

.layer:nth-child(12):after {
  transform: translateZ(-16.5px);
}

.layer:nth-child(13):after {
  transform: translateZ(-18px);
}

.layer:nth-child(14):after {
  transform: translateZ(-19.5px);
}

.layer:nth-child(15):after {
  transform: translateZ(-21px);
}

.layer:nth-child(16):after {
  transform: translateZ(-22.5px);
}

.layer:nth-child(17):after {
  transform: translateZ(-24px);
}

.layer:nth-child(18):after {
  transform: translateZ(-25.5px);
}

.layer:nth-child(19):after {
  transform: translateZ(-27px);
}

.layer:nth-child(20):after {
  transform: translateZ(-28.5px);
}

.layer:nth-child(n+10):after {
  -webkit-text-stroke: 3px rgba(0, 0, 0, 0.25);
}

 

.layer:nth-child(n+12):after {
  -webkit-text-stroke: 6px #0062ea;
}

.layer:last-child:after {
  -webkit-text-stroke: 10px rgba(0, 0, 0, 0.1);
}

.layer:first-child:after {
  color: #fff;
  text-shadow: none;
}

@keyframes ಠ_ಠ {
  100% {
    transform: rotateY(-25deg) rotateX(-20deg);
  }
}
@media (max-width: 768px) {
  .layer:after {
  font-size: 40px;
}
}
@media (min-width: 768px) {
  .layer:after {
  font-size: 50px;
}
}

@media (min-width: 992px) {
  .layer:after {
  font-size: 70px;
}
}

@media (min-width: 1200px) {
  .layer:after {
  font-size: 103px;
}
}
</style>
<template>
    <Head title="Inicio" />
    <Menu :listmenus="menus">
        <div class="py-12"  >
            <div class="mx-auto" >
                <div>
                    <div class="container-fluid cuerpo" >
                        <div class="stage">
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                          <div class="layer"></div>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
       
          <div class="container-fluid">
             <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Activos asignados</h4>
                  <div class="text-end">
                    <h2 class="fw-light mb-0">
                      <i class="ti-arrow-up text-success"></i> {{totalasig}}
                    </h2>
                    <span class="text-muted">Vigentes</span>
                  </div>
                  <span class="text-success">{{totalasigp}}%</span>
                  <div class="progress">
                    <div
                      class="progress-bar bg-success"
                      role="progressbar"
                      :style="'width:'+totalasigp+'%; height: 6px'"
                      aria-valuenow="25"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column -->
       
            <!-- Column -->
            <div class="col-lg-4 col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Activos sin asignacion</h4>
                  <div class="text-end">
                    <h2 class="fw-light mb-0">
                      <i class="ti-arrow-up text-info"></i> {{sinasig}}
                    </h2>
                    <span class="text-muted">Vigentes</span>
                  </div>
                  <span class="text-info">{{sinasigp}}%</span>
                  <div class="progress">
                    <div
                      class="progress-bar bg-info"
                      role="progressbar"
                      :style="'width:'+sinasigp+'%; height: 6px'"
                      aria-valuenow="25"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column --> 
                 <!-- Column -->
                 <div class="col-lg-4 col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Activos proximos a dar de baja </h4>
                  <div class="text-end">
                    <h2 class="fw-light mb-0">
                      <i class="ti-arrow-down text-danger"></i>
                      {{ activosporbaja }}
                    </h2>
                    <span class="text-muted">con valor 0</span>
                  </div>
                  <span class="text-danger">{{activosporbajap}}%</span>
                  <div class="progress">
                    <div
                      class="progress-bar bg-danger"
                      role="progressbar"
                      :style="'width:'+activosporbajap+'%; height: 6px'"
                      aria-valuenow="25"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column -->
          </div>
          <!-- --------------------- -->
          <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex flex-wrap">
                        <div>
                          <h4 class="card-title">Estadisticas de activos fijos</h4>
                          <h6 class="card-subtitle">Gestión {{anio}}</h6>
                        </div>
                        <div class="ms-auto">
                          <ul class="list-inline">
                            <li class="list-inline-item">
                              <h6 class="text-muted">
                                <i class="fa fa-circle me-1 text-success"></i
                                >Altas
                              </h6>
                            </li>
                            <li class="list-inline-item">
                              <h6 class="text-muted">
                                <i class="fa fa-circle me-1 text-info"></i
                                >Bajas
                              </h6>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div id="revenue-statistics"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mt-3 text-center">
                      <h1 class="mb-0 fw-light">{{sumatotal}} Bs.</h1>
                      <h6 class="text-muted">Total Activos</h6>
                    </div> 
                    <div class="col-lg-4 col-md-6 mb-4 mt-3 text-center">
                      <h1 class="mb-0 fw-light">{{totala}}</h1>
                      <h6 class="text-muted">Activos dados de Alta</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mt-3 text-center">
                      <h1 class="mb-0 fw-light">{{totalb}}</h1>
                      <h6 class="text-muted">Activos dados de Baja</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
    </Menu>
</template>
