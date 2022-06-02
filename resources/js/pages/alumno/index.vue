<template>
   <div>   
     <div>
       <router-view></router-view>
     </div>     
   </div>  
</template> 

<script>

export default {
middleware: ["auth", "role:10"],
};
</script>
