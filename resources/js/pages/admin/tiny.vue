<template>
  <div id="app" class="ml-8 mt-5">
    <editor
      api-key="6vefcj88h6ftn2k2ufpk40lzcu144x88jsfaag217nydfbtr"
      :init="{
        plugins: 'lists link image table code help wordcount'
      }"
    />
  </div>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue';
    export default {
        name: 'app',
        components: {
          'editor': Editor
        },
        data: () => ({
        colors: ['green', 'purple', 'orange', 'indigo', 'red'],
        rating: 4.5,
        }),
        methods: {
        genColor (i) {
            return this.colors[i]
        },
        },
    }
</script>
