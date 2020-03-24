<template>

  <b-card header="Excel Import">
    {{output}}
    <b-form @submit="post" enctype="multipart/form-data">
      <b-row>
    <b-col sm="6">
      <b-form-file  ref="file-input" class="mb-2" v-on:change="onImageChangeexcel"></b-form-file>
    </b-col>
    <b-col>
    <b-btn type="submit" variant="primary">Import</b-btn>
    </b-col>
    </b-row>
</b-form>
  </b-card>

</template>
<script>
  export default {
    data(){
      return{
        excel:'',
        output:'',
        success:''
      }
    },

    mounted(){

    },
    methods:{
        onImageChangeexcel(e){

                 this.excelname = e.target.files[0].name;
                   console.log(this.excel);
                this.excel = e.target.files[0];
            },
            post(e){

                 const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                e.preventDefault();

                 let excelImp = new FormData();
                excelImp.append('excel', this.excel);

                  this.axios.post(this.$apiUrl+'excel', excelImp, config)
                .then(function (response) {
                   console.log(res.data)
                })

            }
    }
  }
</script>
