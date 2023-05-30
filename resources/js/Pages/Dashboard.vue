 
<script setup> 
import Menu from '@/Layouts/menu.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ 
    status: {
        type: String,
    },
    menus: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Inicio" />
    <Menu :listmenus="menus">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Sistema de Gestion de Activos Fijos</div>
                </div>
            </div>
        </div>
    </Menu>
</template>
