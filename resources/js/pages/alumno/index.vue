<template>
   <div>   
     <div class="ml-3">
       <router-view></router-view>
     </div>     
   </div>  
</template> 

<script>

export default {
middleware: "auth",
};
</script>

