<template>
<h1>Hello</h1>
</template>
<script>

export default {
  middleware: ["auth", "role:8"],
  
};
</script>
