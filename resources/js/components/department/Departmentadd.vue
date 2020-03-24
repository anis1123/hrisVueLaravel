<template>

     <b-form @submit="post" >
       <Toasts
    :rtl="true"
    :max-messages="7"
    :time-out="3000"
></Toasts>
   <b-col sm="12" class="px-5 mt-5">
        <b-card>
          <div slot="header">
            <strong> Add Department</strong> <small>Form</small>
          </div>
          <b-row>
            <b-col sm="12">
              <b-form-group>
                <label for="ccnumber">Add Department </label>
                <b-form-input type="text" v-model="department" placeholder="Enter Your Department" required></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
                     <b-button block variant="success py-1" type="submit">Add Department</b-button>
        </b-card>

      </b-col>
     </b-form>
</template>


<script>
  export default {
    data(){
      return{

          department:'',

      }
    },

  methods: {

    post(e){
    e.preventDefault();

      this.$axios.post(this.$apiUrl+'department/add',{
        department :this.department
      })
      .then(res => {
          this.dep = res.data;
           this.$toast.success('Department Added!!!');
           this.department =''
      })
    },
  },

  }

</script>


<style>
.toast-header i{

  display: none
}
</style>
