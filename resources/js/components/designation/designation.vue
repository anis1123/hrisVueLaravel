<template>
      <div>

       <Toasts
    :rtl="true"
    :max-messages="7"
    :time-out="3000"
></Toasts>
   <b-col sm="12" class="px-5 mt-5">
        <b-card>
          <div slot="header">
            <strong> Add Designation</strong> <small> Form</small>
          </div>
          <b-row>




            <b-col sm="12">
                   <b-form-group>
                <label for="">Select Department</label>
                   <b-form-select
                    v-model="dep"
                   required
                >

    <option v-for="onlys in only" :value="onlys.id">  {{onlys.title}}</option>

                </b-form-select>
              </b-form-group>
              <b-form-group>
                <label for="ccnumber">Add Designation </label>
                <b-form-input type="text" v-model="designation" placeholder="Enter Your Designation" required></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
                     <b-button block variant="success py-1" @click="post">Add Designation</b-button>
        </b-card>

      </b-col>

</div>
</template>


<script>
 export default {
   data(){
     return{
        only:'',
        dep:'',
        designation:''
     }
   },

   mounted(){
     this.$axios.get(this.$apiUrl+'department/only')
     .then(res =>{
       this.only = res.data
     })

   },
   methods:{
     post(e){
       if(this.designation== '' || this.dep == ''){
         alert('please fill all!!!')
       }

       else{

       e.preventDefault();
       this.$axios.post(this.$apiUrl+'designation/add',{
         department_id : this.dep,
         designation : this.designation
       })
       .then(res =>{

            this.designation='';

           this.$toast.success('Designation Added!!!');
       })
       }
     }
   }
 }
</script>
<style>
.toast-header i{

  display: none
}
</style>
