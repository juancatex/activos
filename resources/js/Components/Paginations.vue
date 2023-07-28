<script setup> 
import { Link } from '@inertiajs/vue3'; 
const props = defineProps({
    links: {
        type: Array 
    } 
}); 
function ver(object){
    if(object.includes('next')){
        object=">>";
    }
    if(object.includes('previous')){
        object="<<";
    }
    return object;
}
</script>

<template>
    
     

      <nav>
          <ul class="pagination">
            <template v-for="(link, k) in links" :key="k">
              <li v-if="link.url === null"  :class="link.active?'page-item active':'page-item'">  
                  <div class="page-link" v-html="ver(link.label)" ></div>
              </li>
              
              <li v-else  :class="link.active?'page-item active':'page-item'"> 
                  <Link   :href="link.url"  class="page-link">{{ ver(link.label)}}</Link>
              </li>
             </template>  
          </ul>
      </nav>
    
  </template>
