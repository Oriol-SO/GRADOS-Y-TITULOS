<template>
            <v-snackbar
                v-model="visible"
                tile
                :color="color"
                top
                timeout="1500"
            >
            {{ msg }} 

            <template v-slot:action="{ attrs }">
                <v-btn
                color="white"
                text
                v-bind="attrs"
                @click="visible = false"
                >
                Close
                </v-btn>
            </template>
            </v-snackbar>
</template>

<script>
export default {
    name:"snackbar",
    props: {
      msg: String,
      color:String,
      visible: {
        type: Boolean,
        default: false
      },
    }
}
</script>
