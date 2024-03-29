<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       /* DB::table('rols')->insert(['name'=>'Administrador','descripcionrol'=>'Administrador']);
        DB::table('rols')->insert(['name'=>'Contador','descripcionrol'=>'Contador']);
        DB::table('rols')->insert(['name'=>'Profesional 1','descripcionrol'=>'Profesional 1']);
        DB::table('rols')->insert(['name'=>'Profesional 2','descripcionrol'=>'Profesional 2']);
        DB::table('rols')->insert(['name'=>'Profesional 3','descripcionrol'=>'Profesional 3']);
        DB::table('rols')->insert(['name'=>'Auditor','descripcionrol'=>'Auditor']);*/
        DB::table('rols')->insert(['name'=>'GERENTE GENERAL','descripcionrol'=>'GERENTE GENERAL']);
        DB::table('rols')->insert(['name'=>'ABOGADO','descripcionrol'=>'ABOGADO']);
        DB::table('rols')->insert(['name'=>'ASIST. SECRETARIA, GERENCIA Y MENSAJERIA','descripcionrol'=>'ASIST. SECRETARIA, GERENCIA Y MENSAJERIA']);
        DB::table('rols')->insert(['name'=>'ASISTENTE DE CREDITOS','descripcionrol'=>'ASISTENTE DE CREDITOS']);
        DB::table('rols')->insert(['name'=>'AUDITOR INTERNO','descripcionrol'=>'AUDITOR INTERNO']);
        DB::table('rols')->insert(['name'=>'AUXILIAR DE ARCHIVO Y CATASTRO','descripcionrol'=>'AUXILIAR DE ARCHIVO Y CATASTRO']);
        DB::table('rols')->insert(['name'=>'AUXILIAR DE CONTABILIDAD','descripcionrol'=>'AUXILIAR DE CONTABILIDAD']);
        DB::table('rols')->insert(['name'=>'EJECUTIVO DE CUENTAS','descripcionrol'=>'EJECUTIVO DE CUENTAS']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE ARCHIVO Y CATASTRO','descripcionrol'=>'ENCARGADO DE ARCHIVO Y CATASTRO']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE BASE DE DATOS E INFRAESTRUCTURA','descripcionrol'=>'ENCARGADO DE BASE DE DATOS E INFRAESTRUCTURA']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE MORA EXTRA JUDICIAL','descripcionrol'=>'ENCARGADO DE MORA EXTRA JUDICIAL']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE MORA JUDICIAL','descripcionrol'=>'ENCARGADO DE MORA JUDICIAL']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE SERV.GRALES.ACT.FIJ. Y ALMAC.','descripcionrol'=>'ENCARGADO DE SERV.GRALES.ACT.FIJ. Y ALMAC.']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE SOPORTE TECNICO','descripcionrol'=>'ENCARGADO DE SOPORTE TECNICO']);
        DB::table('rols')->insert(['name'=>'ENCARGADO DE TESORERIA','descripcionrol'=>'ENCARGADO DE TESORERIA']);
        DB::table('rols')->insert(['name'=>'JEFE DE ADMINISTRACIÓN Y FINANZAS','descripcionrol'=>'JEFE DE ADMINISTRACIÓN Y FINANZAS']);
        DB::table('rols')->insert(['name'=>'JEFE DE AUDITORÍA INTERNA','descripcionrol'=>'JEFE DE AUDITORÍA INTERNA']);
        DB::table('rols')->insert(['name'=>'JEFE DE CARTERA','descripcionrol'=>'JEFE DE CARTERA']);
        DB::table('rols')->insert(['name'=>'JEFE DE CREDITOS','descripcionrol'=>'JEFE DE CREDITOS']);
        DB::table('rols')->insert(['name'=>'JEFE DE INFORMATICA Y COMUNICACIONES','descripcionrol'=>'JEFE DE INFORMATICA Y COMUNICACIONES']);
        DB::table('rols')->insert(['name'=>'JEFE DE RIESGOS','descripcionrol'=>'JEFE DE RIESGOS']);
        DB::table('rols')->insert(['name'=>'JEFE LEGAL A.I.','descripcionrol'=>'JEFE LEGAL A.I.']);
        DB::table('rols')->insert(['name'=>'RESPONSABLE DE CARTERA','descripcionrol'=>'RESPONSABLE DE CARTERA']);
        DB::table('rols')->insert(['name'=>'RESPONSABLE DE LIMPIEZA','descripcionrol'=>'RESPONSABLE DE LIMPIEZA']);
        DB::table('rols')->insert(['name'=>'RESPONSABLE DE LIQUIDACIONES','descripcionrol'=>'RESPONSABLE DE LIQUIDACIONES']);
        DB::table('rols')->insert(['name'=>'SECRETARIA DE GERENCIA GENERAL','descripcionrol'=>'SECRETARIA DE GERENCIA GENERAL']);
        DB::table('rols')->insert(['name'=>'SERENO SACABA COCHABAMBA','descripcionrol'=>'SERENO SACABA COCHABAMBA']);
        DB::table('rols')->insert(['name'=>'SUPERVISOR DE CONTABILIDAD','descripcionrol'=>'SUPERVISOR DE CONTABILIDAD']);
        DB::table('rols')->insert(['name'=>'SUPERVISOR DE CONTROL INTERNO Y NORMAS','descripcionrol'=>'SUPERVISOR DE CONTROL INTERNO Y NORMAS']);
        DB::table('rols')->insert(['name'=>'SUPERVISOR DE RECURSOS HUMANOS','descripcionrol'=>'SUPERVISOR DE RECURSOS HUMANOS']);
        DB::table('rols')->insert(['name'=>'SUPERVISOR DE SEGURIDAD DE LA INFORMACION ','descripcionrol'=>'SUPERVISOR DE SEGURIDAD DE LA INFORMACION ']);
        DB::table('rols')->insert(['name'=>'SUPERVISOR DEL DEPARTAMENTO DE SEGUROS','descripcionrol'=>'SUPERVISOR DEL DEPARTAMENTO DE SEGUROS']);



        //INTERNOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        DB::table('grupos')->insert(['nomgrupo'=>'Configuración','descripciongrupo'=>'Configuración']);
        DB::table('grupos')->insert(['nomgrupo'=>'Procesos','descripciongrupo'=>'Procesos']);

        DB::table('menus')->insert(['idm'=>1,'icon'=>'library_add','nommenu'=>'Activos','descripcionmenu'=>'Activos']);  
        DB::table('menus')->insert(['idm'=>2,'icon'=>'check_circle','nommenu'=>'Asignación de Activos','descripcionmenu'=>'Asignación de Activos']);  
        DB::table('menus')->insert(['idm'=>3,'icon'=>'cancel','nommenu'=>'Devolución de Activos','descripcionmenu'=>'Devolución de Activos']);  
        DB::table('menus')->insert(['idm'=>4,'icon'=>'home','nommenu'=>'Empresa','descripcionmenu'=>'Empresa']);  
        DB::table('menus')->insert(['idm'=>5,'icon'=>'disabled_by_default','nommenu'=>'Baja de Activos','descripcionmenu'=>'Baja de Activos']);  
        DB::table('menus')->insert(['idm'=>6,'icon'=>'swap_vert','nommenu'=>'Depreciación de Activos','descripcionmenu'=>'Depreciación de Activos']);  
         
        DB::table('vistas')->insert(['idv'=>1,'nomvista'=>'Información','ruta'=>'empresa.datos']); //Empresa
        DB::table('vistas')->insert(['idv'=>2,'nomvista'=>'Area Funcional','ruta'=>'ambiente.datos']); //Empresa
        DB::table('vistas')->insert(['idv'=>3,'nomvista'=>'Cargos','ruta'=>'rol.datos']); //Empresa
        DB::table('vistas')->insert(['idv'=>4,'nomvista'=>'Personal','ruta'=>'empresa.personal']); //Empresa
        DB::table('vistas')->insert(['idv'=>5,'nomvista'=>'Catalogo','ruta'=>'activo.lista']); 
        DB::table('vistas')->insert(['idv'=>6,'nomvista'=>'Asignación','ruta'=>'activo.asig']); 
        DB::table('vistas')->insert(['idv'=>7,'nomvista'=>'Devolución','ruta'=>'activo.dev']); 
        DB::table('vistas')->insert(['idv'=>8,'nomvista'=>'Bajas de activos','ruta'=>'activo.baja']); 
        DB::table('vistas')->insert(['idv'=>9,'nomvista'=>'Depreciación de activos','ruta'=>'activo.depre']);  
        DB::table('vistas')->insert(['idv'=>10,'nomvista'=>'Grupo','ruta'=>'grupo.datos']);  
        DB::table('vistas')->insert(['idv'=>11,'nomvista'=>'Auxiliar','ruta'=>'aux.datos']);  
        DB::table('vistas')->insert(['idv'=>12,'nomvista'=>'Motivo de baja','ruta'=>'motivo.datos']);  
       // FIN        INTERNOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>1]);
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>2]);
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>3]);
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>4]);  
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>10]);  
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>11]);  
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>1,'idm'=>4,'idv'=>12]);  

        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>2,'idm'=>1,'idv'=>5]); 
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>2,'idm'=>2,'idv'=>6]); 
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>2,'idm'=>3,'idv'=>7]); 
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>2,'idm'=>5,'idv'=>8]); 
        DB::table('rol_vistas')->insert(['idrol'=>1,'idg'=>2,'idm'=>6,'idv'=>9]); 


        // DB::table('unidads')->insert(['idu'=>1,'name'=>'Gerencia','descripcionuni'=>'Gerencia']);  
        // DB::table('unidads')->insert(['idu'=>2,'name'=>'Prestamos','descripcionuni'=>'Prestamos']);  
        // DB::table('unidads')->insert(['idu'=>3,'name'=>'Sistemas','descripcionuni'=>'Sistemas']);  
        // DB::table('unidads')->insert(['idu'=>4,'name'=>'Activos Fijos','descripcionuni'=>'Activos Fijos']);  
// -------------------------------------------------------
        DB::table('empresas')->insert(['nombre'=>'Mugebusch','direccion'=>'Av. Arce 2177, Hotel Real Plaza, Business Center Piso 5',
        'nit'=>99999991111,
        'telefono1'=>2444124,'telefono2'=>2444803,'telefono3'=>2441785,'telefono4'=>2444817,
        'ciudad'=>'La paz',
        'web'=>'www.mugebusch.org',]); 

      /*  DB::table('ambientes')->insert(['codambiente'=>'01','nomambiente'=>'GERENCIA']);
        DB::table('ambientes')->insert(['codambiente'=>'02','nomambiente'=>'ARCHIVO GENERAL']);
        DB::table('ambientes')->insert(['codambiente'=>'03','nomambiente'=>'DIRECCIÓN FINANCIERA']);
        DB::table('ambientes')->insert(['codambiente'=>'04','nomambiente'=>'ASESORÍA JURIDICA']);
        DB::table('ambientes')->insert(['codambiente'=>'05','nomambiente'=>'CONTADURÍA GENERAL']);
        DB::table('ambientes')->insert(['codambiente'=>'06','nomambiente'=>'PASILLOS EDIFICIO']);
        DB::table('ambientes')->insert(['codambiente'=>'07','nomambiente'=>'SECCIÓN TESORERIA']);
        DB::table('ambientes')->insert(['codambiente'=>'08','nomambiente'=>'AUXILIAR CONTABLE NRO 2']);
        DB::table('ambientes')->insert(['codambiente'=>'09','nomambiente'=>'AUXILIAR CONTABLE NRO 3']);
        DB::table('ambientes')->insert(['codambiente'=>'10','nomambiente'=>'PORTERÍA']);
        DB::table('ambientes')->insert(['codambiente'=>'11','nomambiente'=>'COBRANZAS']);
        DB::table('ambientes')->insert(['codambiente'=>'12','nomambiente'=>'SERVICIOS']);
        DB::table('ambientes')->insert(['codambiente'=>'13','nomambiente'=>'RECURSOS HUMANOS']);
        DB::table('ambientes')->insert(['codambiente'=>'14','nomambiente'=>'SECCIÓN FILIALES']);
        DB::table('ambientes')->insert(['codambiente'=>'15','nomambiente'=>'RECURSOS HUMANOS NRO 2']);
        DB::table('ambientes')->insert(['codambiente'=>'16','nomambiente'=>'EDUCACIÓN Y CULTURA']);
        DB::table('ambientes')->insert(['codambiente'=>'17','nomambiente'=>'CONSEJO NACIONAL FISCALIZACIÓN Y VIGILANCIA']);
        DB::table('ambientes')->insert(['codambiente'=>'18','nomambiente'=>'ACTIVOS FIJOS NRO 2']);
        DB::table('ambientes')->insert(['codambiente'=>'19','nomambiente'=>'ACTIVOS FIJOS']); 
        DB::table('ambientes')->insert(['codambiente'=>'20','nomambiente'=>'ALMACEN']);
        DB::table('ambientes')->insert(['codambiente'=>'21','nomambiente'=>'CONSULTORÍA EXTERNA']);
        DB::table('ambientes')->insert(['codambiente'=>'22','nomambiente'=>'SECCIÓN FILIACION']);
        DB::table('ambientes')->insert(['codambiente'=>'23','nomambiente'=>'PRÉSTAMOS REGULARES']);
        DB::table('ambientes')->insert(['codambiente'=>'24','nomambiente'=>'AUDITORÍA Y FISCALIZACION']);
        DB::table('ambientes')->insert(['codambiente'=>'25','nomambiente'=>'PRESTACIONES']);
        DB::table('ambientes')->insert(['codambiente'=>'26','nomambiente'=>'SECCIÓN PRESTAMOS DE EMERGENCIA']); 
        DB::table('ambientes')->insert(['codambiente'=>'27','nomambiente'=>'AUXILIAR DE PRESTACIONES']);
        DB::table('ambientes')->insert(['codambiente'=>'28','nomambiente'=>'UNIDAD DE SISTEMAS']);
        DB::table('ambientes')->insert(['codambiente'=>'29','nomambiente'=>'COMITE ELECTORAL']); 
        DB::table('ambientes')->insert(['codambiente'=>'30','nomambiente'=>'DEPOSITO']); */

        DB::table('ambientes')->insert(['codambiente'=>'01','nomambiente'=>'GERENCIA GENERAL ']);
        DB::table('ambientes')->insert(['codambiente'=>'02','nomambiente'=>' ARCHIVO Y CATASTRO']);
        DB::table('ambientes')->insert(['codambiente'=>'03','nomambiente'=>'ARCHIVO JJ PEREZ']);
        DB::table('ambientes')->insert(['codambiente'=>'04','nomambiente'=>'ASISTENTE GERENCIA GENERAL']);
        DB::table('ambientes')->insert(['codambiente'=>'05','nomambiente'=>'AUDITORIA INTERNA']);
        DB::table('ambientes')->insert(['codambiente'=>'06','nomambiente'=>'AUDITORIA INTERNA 502']);
        DB::table('ambientes')->insert(['codambiente'=>'07','nomambiente'=>'COCINA']);
        DB::table('ambientes')->insert(['codambiente'=>'08','nomambiente'=>'COMEDOR HOTEL']);
        DB::table('ambientes')->insert(['codambiente'=>'09','nomambiente'=>'DEPARTAMENTO ADMINISTRATIVO FINANCIERO ']);
        DB::table('ambientes')->insert(['codambiente'=>'10','nomambiente'=>'DEPARTAMENTO DE CARTERA']);
        DB::table('ambientes')->insert(['codambiente'=>'11','nomambiente'=>'DEPARTAMENTO DE CREDITO']);
        DB::table('ambientes')->insert(['codambiente'=>'12','nomambiente'=>'DEPARTAMENTO DE INFORMATICA Y COMUNICACIONES']);
        DB::table('ambientes')->insert(['codambiente'=>'13','nomambiente'=>'DEPARTAMENTO DE MORA Y EXTRAJUDICIAL']);
        DB::table('ambientes')->insert(['codambiente'=>'14','nomambiente'=>'DEPARTAMENTO DE SEGUROS']);
        DB::table('ambientes')->insert(['codambiente'=>'15','nomambiente'=>'DEPARTAMENTO LEGAL']);
        DB::table('ambientes')->insert(['codambiente'=>'16','nomambiente'=>'DEPOSITO DE SISTEMA 501']);
        DB::table('ambientes')->insert(['codambiente'=>'17','nomambiente'=>'DEPOSITO JJ. PÉREZ']);
        DB::table('ambientes')->insert(['codambiente'=>'18','nomambiente'=>'GERENCIA GENERAL ']);
        DB::table('ambientes')->insert(['codambiente'=>'19','nomambiente'=>'HOTEL DEPOSITO DE ACTIVOS FIJOS Y ALMACENES']);
        DB::table('ambientes')->insert(['codambiente'=>'20','nomambiente'=>'J. J PEREZ - AUDITORIA INTERNA']);
        DB::table('ambientes')->insert(['codambiente'=>'21','nomambiente'=>'JJ PEREZ']);
        DB::table('ambientes')->insert(['codambiente'=>'22','nomambiente'=>'JJ. PEREZ CPD']);
        DB::table('ambientes')->insert(['codambiente'=>'23','nomambiente'=>'OFICINA 505 HOTEL']);
        DB::table('ambientes')->insert(['codambiente'=>'24','nomambiente'=>'PRESIDENCIA']);
        DB::table('ambientes')->insert(['codambiente'=>'25','nomambiente'=>'RECURSOS HUMANOS']);
        DB::table('ambientes')->insert(['codambiente'=>'26','nomambiente'=>'REGIONAL COCHABAMBA']);
        DB::table('ambientes')->insert(['codambiente'=>'27','nomambiente'=>'REGIONAL SANTA CRUZ']);
        DB::table('ambientes')->insert(['codambiente'=>'28','nomambiente'=>'SALA DE REUNIONES HOTEL']);
        DB::table('ambientes')->insert(['codambiente'=>'29','nomambiente'=>'SALA DE REUNIONES JJ . PÉREZ']);
        DB::table('ambientes')->insert(['codambiente'=>'30','nomambiente'=>'SECRETARIA DE GERENCIA GENERAL']);
        DB::table('ambientes')->insert(['codambiente'=>'31','nomambiente'=>'SERVIDOR JJPEREZ']);
       

        
        DB::table('activo_grupos')->insert(['codgrupo'=>'01','nomgrupo'=>'Muebles y enseres','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'02','nomgrupo'=>'Equipos de computación','vida'=>4]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'03','nomgrupo'=>'Equipos de oficina','vida'=>8]);

      /*  DB::table('activo_grupos')->insert(['codgrupo'=>'03','nomgrupo'=>'Maquinaria en general','vida'=>8]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'04','nomgrupo'=>'Equipos e instalaciones','vida'=>8]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'05','nomgrupo'=>'Barcos y lanchas en general','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'06','nomgrupo'=>'Vehículos automotores','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'07','nomgrupo'=>'Aviones','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'08','nomgrupo'=>'Maquinaria para la construcción','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'09','nomgrupo'=>'Maquinaria agrícola','vida'=>4]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'10','nomgrupo'=>'Animales de trabajo','vida'=>4]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'11','nomgrupo'=>'Herramientas en general','vida'=>4]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'12','nomgrupo'=>'Reproductores y hembras pedigree puros por cruza','vida'=>8]); 
        DB::table('activo_grupos')->insert(['codgrupo'=>'14','nomgrupo'=>'Canales de regadío y pozos','vida'=>20]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'15','nomgrupo'=>'Estanques, bañaderos y abrevaderos','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'16','nomgrupo'=>'Alambrados, tranqueras y vallas','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'17','nomgrupo'=>'Viviendas para el personal','vida'=>20]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'18','nomgrupo'=>'Muebles y enseres en las viviend para el personal','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'19','nomgrupo'=>'Silos, almacenes y galpones','vida'=>20]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'20','nomgrupo'=>'Tinglados y cobertizos de madera','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'21','nomgrupo'=>'Tinglados y cobertizos de metal','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'22','nomgrupo'=>'Instalaciones de electrificación - Telefonía rural','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'23','nomgrupo'=>'Caminos interiores','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'24','nomgrupo'=>'Caña de azúcar','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'25','nomgrupo'=>'Vides','vida'=>8]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'26','nomgrupo'=>'Frutales','vida'=>10]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'27','nomgrupo'=>'Pozos Petroleros (ver inciso II del Art. 18° de este reglamento)','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'28','nomgrupo'=>'Líneas de Recolección de industria Petrolera.','vida'=>5]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'29','nomgrupo'=>'Equipos de campo de la industria Petrolera','vida'=>8]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'30','nomgrupo'=>'Plantas de Procesamiento de Industria Petrolera','vida'=>8]);
        DB::table('activo_grupos')->insert(['codgrupo'=>'31','nomgrupo'=>'Ductos de la industria petrolera','vida'=>10]);*/
        /*
 
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'01','nomauxiliar'=>'ESCRITORIO DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'02','nomauxiliar'=>'ESTANTE DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'03','nomauxiliar'=>'MÁQUINA CALCULADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'04','nomauxiliar'=>'MÁQUINA DE ESCRIBIR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'05','nomauxiliar'=>'MESA DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'06','nomauxiliar'=>'MESA METÁLICA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'07','nomauxiliar'=>'ROPERO METÁLICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'08','nomauxiliar'=>'SILLA DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'09','nomauxiliar'=>'SILLÓN']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'10','nomauxiliar'=>'JUEGO DE LIVING']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'11','nomauxiliar'=>'COLGADOR DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'12','nomauxiliar'=>'MUEBLE PARA COMPUTADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'13','nomauxiliar'=>'ESCRITORIO METÁLICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'14','nomauxiliar'=>'ESTANTE METÁLICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'15','nomauxiliar'=>'SILLÓN GIRATORIO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'16','nomauxiliar'=>'SILLA METALICA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'17','nomauxiliar'=>'ESTUFA ELÉCTRICA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'18','nomauxiliar'=>'GAVETERO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'19','nomauxiliar'=>'SILLA GIRATORIA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'20','nomauxiliar'=>'ANILLADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'21','nomauxiliar'=>'GUILLOTINA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'22','nomauxiliar'=>'FOTOCOPIADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'23','nomauxiliar'=>'EXTINGUIDOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'24','nomauxiliar'=>'ESTACIÓN DE TRABAJO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'25','nomauxiliar'=>'MODULAR DE MELAMINA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'26','nomauxiliar'=>'CASILLERO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'27','nomauxiliar'=>'ROPERO DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'28','nomauxiliar'=>'no especificado']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'29','nomauxiliar'=>'EXTRACTOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'30','nomauxiliar'=>'TABLERO DE INFORMACIONES /ORDENES']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'31','nomauxiliar'=>'HORNO MICRO ONDAS']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'32','nomauxiliar'=>'RELOJ BIOMÉTRICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'33','nomauxiliar'=>'ROTAFOLIO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'34','nomauxiliar'=>'CAJA FUERTE']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'35','nomauxiliar'=>'TABURETE DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'36','nomauxiliar'=>'MOSTRADOR DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'37','nomauxiliar'=>'VITRINA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'38','nomauxiliar'=>'REFRIGERADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'39','nomauxiliar'=>'SILLA PLÁSTICA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'40','nomauxiliar'=>'MESA PLÁSTICA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'41','nomauxiliar'=>'LAVADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'42','nomauxiliar'=>'CAFETERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'43','nomauxiliar'=>'PORTA ESTANDARTE']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'44','nomauxiliar'=>'ROPA DE CAMA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'45','nomauxiliar'=>'COCINA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'46','nomauxiliar'=>'CATRE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'47','nomauxiliar'=>'ATRIL']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'01','nomauxiliar'=>'APARATO TELEFÓNICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'02','nomauxiliar'=>'TELÉFONO FAX']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'03','nomauxiliar'=>'FILMADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'04','nomauxiliar'=>'CÁMARA FOTOGRÁFICA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'05','nomauxiliar'=>'EQUIPO DE SONIDO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'06','nomauxiliar'=>'TRANSFORMADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'07','nomauxiliar'=>'TELEVISOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'08','nomauxiliar'=>'ESTABILIZADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'09','nomauxiliar'=>'REPRODUCTOR DE DVD']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'10','nomauxiliar'=>'PORTERO ELÉCTRICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'11','nomauxiliar'=>'REPRODUCTOR VHS']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'12','nomauxiliar'=>'CÁMARAS DE VIDEO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'13','nomauxiliar'=>'CELULAR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'14','nomauxiliar'=>'GRABADORA REPORTERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'15','nomauxiliar'=>'CABINAS']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'16','nomauxiliar'=>'TANTEADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'17','nomauxiliar'=>'EQUIPO CONSOLA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'18','nomauxiliar'=>'AMPLIFICADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>5,'codauxiliar'=>'19','nomauxiliar'=>'EQUIPO DE VIGILANCIA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>6,'codauxiliar'=>'01','nomauxiliar'=>'ATRIL DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>6,'codauxiliar'=>'02','nomauxiliar'=>'SABLE METÁLICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>6,'codauxiliar'=>'03','nomauxiliar'=>'PUPITRE']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>6,'codauxiliar'=>'04','nomauxiliar'=>'PIANO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>6,'codauxiliar'=>'05','nomauxiliar'=>'PIZARRA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>6,'codauxiliar'=>'06','nomauxiliar'=>'PANTALLA PROYECTORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'01','nomauxiliar'=>'AMOLADORA ANGLE GRINDEP PT 807']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'02','nomauxiliar'=>'ESCALERA DE FIERRO, 3 METROS COLOR NEGRO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'03','nomauxiliar'=>'AZADON']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'04','nomauxiliar'=>'PUNTA DE FIERRO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'05','nomauxiliar'=>'SOLDADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'06','nomauxiliar'=>'COMBO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'07','nomauxiliar'=>'TIJERA DE PODAR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'08','nomauxiliar'=>'BOMBA DE AGUA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'09','nomauxiliar'=>'DESMALEZADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>13,'codauxiliar'=>'10','nomauxiliar'=>'TALADRO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'01','nomauxiliar'=>'EQUIPO DE COMPUTACION']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'02','nomauxiliar'=>'HUB']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'03','nomauxiliar'=>'COMPUTADORA PORTATIL']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'04','nomauxiliar'=>'IMPRESORA DE TINTA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'05','nomauxiliar'=>'IMPRESORA LASER']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'06','nomauxiliar'=>'IMPRESORA A CINTA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'07','nomauxiliar'=>'PLOTER']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'08','nomauxiliar'=>'SCANER']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'09','nomauxiliar'=>'ROUTER']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'10','nomauxiliar'=>'CASE']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'11','nomauxiliar'=>'MONITOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'12','nomauxiliar'=>'TECLADO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'13','nomauxiliar'=>'MOUSE']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'14','nomauxiliar'=>'PARLANTE DE COMPUTADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'15','nomauxiliar'=>'SERVIDOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'16','nomauxiliar'=>'FUENTE DE PODER']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'17','nomauxiliar'=>'QUEMADOR EXTERNO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'18','nomauxiliar'=>'RACK']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'19','nomauxiliar'=>'MODEM']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'20','nomauxiliar'=>'SOPLADOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'21','nomauxiliar'=>'LECTOR EXTERNO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'22','nomauxiliar'=>'DATA DISPLAY']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'23','nomauxiliar'=>'PROYECTOR']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'24','nomauxiliar'=>'SWITCH']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>15,'codauxiliar'=>'25','nomauxiliar'=>'UPS']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'01','nomauxiliar'=>'SOFA CAMA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'02','nomauxiliar'=>'CATRE DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'03','nomauxiliar'=>'CATRE METÁLICO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'04','nomauxiliar'=>'ROPERO DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'05','nomauxiliar'=>'VELADOR DE MADERA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'06','nomauxiliar'=>'ASPIRADORA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'07','nomauxiliar'=>'CALEFON']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'08','nomauxiliar'=>'ALMOHADA']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'09','nomauxiliar'=>'FRAZADA CON DISEÑO']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'10','nomauxiliar'=>'SÁBANA DE TRES PIEZAS']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>20,'codauxiliar'=>'11','nomauxiliar'=>'COLCHACAMA']);*/
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'01','nomauxiliar'=>'Sofá de Recepción']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'02','nomauxiliar'=>'Mesa de Centro']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'03','nomauxiliar'=>'Sillón de Espera']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'04','nomauxiliar'=>'Banco Decorativo']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'05','nomauxiliar'=>'Taburetes Altos']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'06','nomauxiliar'=>'Cómoda de Almacenamiento']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'07','nomauxiliar'=>'Espejo de Pared']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'08','nomauxiliar'=>'Lámpara de Pie']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'09','nomauxiliar'=>'Mesita Auxiliar']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'10','nomauxiliar'=>'Estante Flotante']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'11','nomauxiliar'=>'Vitrina de Exhibición']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'12','nomauxiliar'=>'Mueble de TV']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'13','nomauxiliar'=>'Carro de Servicio']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'14','nomauxiliar'=>'Separador de Ambientes']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'15','nomauxiliar'=>'Tocador con Espejo']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'16','nomauxiliar'=>'Perchero de Pared']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'17','nomauxiliar'=>'Camarera de Bar']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'18','nomauxiliar'=>'Mesas Laterales']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'19','nomauxiliar'=>'Mueble Organizador']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'20','nomauxiliar'=>'Escritorio de Esquina']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'21','nomauxiliar'=>'Biblioteca de Madera']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'22','nomauxiliar'=>'Sillas de Comedor']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'23','nomauxiliar'=>'Baúl de Almacenamiento']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'24','nomauxiliar'=>'Mesas de Noche']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'25','nomauxiliar'=>'Cama con Cabecera']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'26','nomauxiliar'=>'Sillones Reclinables']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'27','nomauxiliar'=>'Escritorio Ejecutivo']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'28','nomauxiliar'=>'Mesa de Conferencia']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'29','nomauxiliar'=>'Silla Ergonómica']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>1,'codauxiliar'=>'30','nomauxiliar'=>'Mesas de Trabajo']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'01','nomauxiliar'=>'Cable HDMI']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'02','nomauxiliar'=>'Adaptador USB-C']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'03','nomauxiliar'=>'Mousepad Ergonómico']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'04','nomauxiliar'=>'Funda para Laptop']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'05','nomauxiliar'=>'Protector de Pantalla']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'06','nomauxiliar'=>'Hub USB']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'07','nomauxiliar'=>'Auriculares con Micrófono']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'08','nomauxiliar'=>'Base para Laptop']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'09','nomauxiliar'=>'Paquete de Baterías Externas']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'10','nomauxiliar'=>'Maletín para Laptop']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'11','nomauxiliar'=>'Kit de Limpieza de Pantalla']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'12','nomauxiliar'=>'Protector de Teclado']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'13','nomauxiliar'=>'Docking Station']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'14','nomauxiliar'=>'Antena WiFi']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'15','nomauxiliar'=>'Tarjeta SD de 128 GB']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'16','nomauxiliar'=>'Funda para Tablet']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'17','nomauxiliar'=>'Almohadilla para Muñeca']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'18','nomauxiliar'=>'Candado de Seguridad']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'19','nomauxiliar'=>'Soporte para Teléfono']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'20','nomauxiliar'=>'Filtro de Privacidad']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'21','nomauxiliar'=>'Kit de Cables de Conexión']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'22','nomauxiliar'=>'Adaptador de Corriente Universal']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'23','nomauxiliar'=>'Lápiz Óptico']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'24','nomauxiliar'=>'Extensor de Alcance WiFi']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'25','nomauxiliar'=>'Almohadilla de Enfriamiento']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'26','nomauxiliar'=>'Funda de Cámara Web']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'27','nomauxiliar'=>'Maletín de Cables']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'28','nomauxiliar'=>'Protector de Teclado Numérico']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'29','nomauxiliar'=>'Soporte para Monitor']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>2,'codauxiliar'=>'30','nomauxiliar'=>'Cable de Carga Magnético']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'01','nomauxiliar'=>'Escritorio Ejecutivo']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'02','nomauxiliar'=>'Silla Ergonómica']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'03','nomauxiliar'=>'Archivador Metálico']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'04','nomauxiliar'=>'Teléfono VoIP']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'05','nomauxiliar'=>'Calculadora Científica']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'06','nomauxiliar'=>'Proyector Portátil']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'07','nomauxiliar'=>'Pizarra Interactiva']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'08','nomauxiliar'=>'Máquina de Café']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'09','nomauxiliar'=>'Lámpara de Escritorio']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'10','nomauxiliar'=>'Teléfono Inalámbrico']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'11','nomauxiliar'=>'Fax Multifuncional']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'12','nomauxiliar'=>'Destructor de Documentos']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'13','nomauxiliar'=>'Escáner de Documentos']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'14','nomauxiliar'=>'Rotuladora Electrónica']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'15','nomauxiliar'=>'Gabinete para Archivos']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'16','nomauxiliar'=>'Almohadilla para Mouse']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'17','nomauxiliar'=>'Carpeta Expandible']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'18','nomauxiliar'=>'Dispensador de Agua']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'19','nomauxiliar'=>'Portapapeles']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'20','nomauxiliar'=>'Papelería y Suministros']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'21','nomauxiliar'=>'Reloj de Pared']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'22','nomauxiliar'=>'Organizador de Escritorio']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'23','nomauxiliar'=>'Engrapadora de Oficina']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'24','nomauxiliar'=>'Filtro de Pantalla']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'25','nomauxiliar'=>'Silla para Visitantes']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'26','nomauxiliar'=>'Caja Fuerte']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'27','nomauxiliar'=>'Estantería de Oficina']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'28','nomauxiliar'=>'Ventilador de Escritorio']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'29','nomauxiliar'=>'Planta Decorativa']);
        DB::table('activo_auxiliars')->insert(['idgrupo'=>3,'codauxiliar'=>'30','nomauxiliar'=>'Teléfono de Conferencia']);
                     



        DB::table('activo_motivos')->insert(['nommotivo'=>'Disposición definitiva de bienes']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Hurto, robo o pérdida']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Mermas y daño físico']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Vencimiento, alteraciones y deterioros']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Inutilización']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Obsolescencia']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Desmantelamiento de edificaciones']);
        DB::table('activo_motivos')->insert(['nommotivo'=>'Siniestros fortuitos']);
 
        $user = new User();
        $user->idrol = 1;
        $user->idu = 3; 
        $user->name = 'Juan';
        $user->ap = 'Perito'; 
        $user->am = 'Perez';  
        $user->ci = 8301456;   
        $user->dir = 'por ahi';    
        $user->cel = 77549539;   
        $user->fecnac = '1989-01-29';   
        $user->fecin = '2023-02-08';    
        $user->email = 'ddd@hotmail.com';
        $user->password = bcrypt('ddd');
        $user->save();
 
        $path =Storage::disk('public')->path('ufv.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
       
/*
        $procedureDepreciar = "CREATE OR REPLACE PROCEDURE depreciar (in idactivoin int)
              BEGIN
              
              DECLARE punteroanioreg BIGINT DEFAULT 0;
              SET @residual = 0;
              SET @costo = 0;
              SET @vida = 0;
              SET @fechaingreso='';
              SET @fechames=0; 
             SELECT activos.costo into @costo FROM activos join activo_grupos on activos.idgrupo=activo_grupos.idag where  activos.idactivo=idactivoin;
            SELECT activos.fechaingreso into @fechaingreso FROM activos join activo_grupos on activos.idgrupo=activo_grupos.idag where  activos.idactivo=idactivoin;
            SELECT activos.residual into @residual FROM activos join activo_grupos on activos.idgrupo=activo_grupos.idag where  activos.idactivo=idactivoin;
            SELECT activo_grupos.vida into @vida FROM activos join activo_grupos on activos.idgrupo=activo_grupos.idag where  activos.idactivo=idactivoin;
               set @anioactual=(select YEAR(CURDATE()));
               SET punteroanioreg=YEAR(@fechaingreso); 

               SET @coeficiente =round((100/@vida)/100,2);
                aloop: LOOP
               
                    IF punteroanioreg<@anioactual THEN
                        set @vc=0; 
                        set @suma_vc=0; 
                        set @ufv_ini=0;
                        set @ufv_fin=0;
                        set @sum_ida=0;
                        set @sum_dp=0;
                        set @daan=0;
                        set @ia=0;
                        set @va=0;
                        set @dp=0;
                         
                        set @valorneto=0;
                        SELECT  COALESCE(SUM(ia),0) into @vc FROM depres where gestion<punteroanioreg;
                        set @suma_vc=round(@vc+@costo,2);  
                        SELECT  COALESCE(SUM(ida),0) into @sum_ida FROM depres where gestion<punteroanioreg; 
                        SELECT  COALESCE(SUM(pd),0) into @sum_dp FROM depres where gestion<punteroanioreg;
                        set @daan=round(@sum_ida+@sum_dp,2);
                                if @vc=0 then
                                    select valor into @ufv_ini from ufvs where fecha = CONCAT( @fechaingreso) limit 1; 
                                    select valor into @ufv_fin from ufvs where fecha = CONCAT(punteroanioreg , '-12-31') limit 1; 
                                else
                                    select valor into @ufv_ini from ufvs where fecha = CONCAT(punteroanioreg , '-01-01') limit 1;
                                    select valor into @ufv_fin from ufvs where fecha = CONCAT(punteroanioreg , '-12-31') limit 1;
                                end if;
                         
                        set @ia=round(((@ufv_fin/@ufv_ini)-1)*@suma_vc,2);
                        set @va=round(@ia+@suma_vc,2); 
                        set @dp=round(@va*@coeficiente,2);
                       
                        set @ida=0;
                                   IF @daan=0 THEN
                                        set @ida=0; 
                                   ELSE
                                        set @ida=round(((@ufv_fin/@ufv_ini)-1)*@daan,2); 
                                   END IF;   

                        set @valorneto=round(@va-(@daan+@ida+@dp),2);
                               IF @valorneto>0 THEN
                                  INSERT INTO depres (idactivo,gestion, periodo, vc, va, ia, daan, ida, pd)  VALUES(idactivoin,punteroanioreg, 12,@suma_vc, @va, @ia, @daan, @ida, @dp); 
                               ELSE
                                    IF @valorneto<=0 THEN
                                        INSERT INTO depres (idactivo,gestion, periodo, vc, va, ia, daan, ida, pd)  VALUES(idactivoin,punteroanioreg, 12,@suma_vc, @va, @ia, @daan, @ida, @dp); 
                                        LEAVE aloop; 
                                    END IF; 
                               END IF; 
                    ELSE
                     LEAVE aloop;
                    END IF;  
                     SET punteroanioreg=punteroanioreg+1; 
                END LOOP aloop;
             
              END;"; 
              DB::unprepared($procedureDepreciar);

              $funciondepre="CREATE OR REPLACE FUNCTION getPrestamosmora (id int) 
              RETURNS text
              DETERMINISTIC
              BEGIN  
              SET @moras = '';
               CALL getidsprestamosMora(@moras,id); 
                         if(CHAR_LENGTH(@moras)=0) then
                         SET @moras = '0|0';
                         end if;
                RETURN @moras;
              END";
               DB::unprepared($funciondepre);*/
    }
}
