<template>
<div>

<b-form >
<div>
      <Toasts
    :rtl="true"
    :max-messages="7"
    :time-out="3000"
></Toasts>
     <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
<b-card style="border-radius:1px" class="bg-light">

 <h4> <span class="text-primary">Today is {{day}}</span> , {{ new Date().toLocaleString().slice(0,9)}}</h4>
</b-card>
<v-spacer></v-spacer>

<b-card header="Attendance">

<b-row>
  <b-col sm="4">
    <label for="">Employee By Department</label>
  <b-select v-model="dep">
        <option v-for="onlys in only" :value="onlys.id">  {{onlys.title}}</option>
  </b-select>

</b-col>
<b-col sm="4">
  <label for="">Date</label>
  <b-input type="date" v-model="date" @change="emps"></b-input>
</b-col>

<b-col sm="4" >
<br>

<b-btn @click="post" class="mt-1" variant="primary">Submit</b-btn>

</b-col>
</b-row>



<div class="table mt-1">
  <table class="table mt-5 table-bordered">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Employee Name</th>
      <th scope="col">Status</th>
      <th scope="col">Attendance</th>
      <th scope="col">Reason</th>
      <th>Save</th>
    </tr>
  </thead>


  <tbody v-for="(em,key) in  data">

    <tr>



      <th scope="row">{{key}}</th>
      <td ><input type="hidden" v-model="em.id"> {{em.salutation }}{{ em.firstname}} {{em.lastname}}</td>
      <td><b-form-checkbox  value="present" v-model="status[key]">Present</b-form-checkbox> <b-checkbox v-model="status[key]" value="absent" class="text-danger">Absent</b-checkbox></td>
      <td>
        <div v-if="em.status == 'absent'"><b-button variant="danger">Absent</b-button></div>
        <div v-else-if="em.status == 'present'"><b-button variant="primary">Present</b-button></div></td>
      <td><b-input v-if="status[key] == 'absent'" v-model="reason[key]"  placeholder="Reason of absent"></b-input></td>
      <td><b-button @click =" save($event,em.id,key)" variant="primary">{{submit}}</b-button></td>

    </tr>

  </tbody>
</table>
</div>
</b-card>

</div>
</b-form>

</div>
</template>





<script>
import 'vuetify/dist/vuetify.min.css';
import emp from '../../views/employee/Edit_emp.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
  export default {
    data () {
      return {
        togglePress:false,
        dep:'',
        date:'',
        newemp:'',
        b:'',
        data:'',
        indeterminate:true,
        reason:[],
        status:[],
        saveemp:[],
        submit:'save',
        present:'',
        date : '',
        clockin:'',
        clockout:'',
        half_time:'',
        leave_type:'',
        only:'',
        emp: [],
        get:[],
        output:'',
        att:[],
      }
    },
    computed:{

      posts(){
      let a = this.dep;

        var b = [];
        for(var i=0 ; i < this.saveemp.length;++i){

              if(this.saveemp[i].department == a ){

                      b[i] =  this.saveemp[i].id;

              }
        }

      return b

      },



      datt(){
      for(var i=0; i < this.att.length; i++){
        if( this.att[i].date == this.date){
          return true
        }
      }
      return false
      },

      day(){
        var d = new Date();
  var weekday = new Array(7);
  weekday[0] = "Sunday";
  weekday[1] = "Monday";
  weekday[2] = "Tuesday";
  weekday[3] = "Wednesday";
  weekday[4] = "Thursday";
  weekday[5] = "Friday";
  weekday[6] = "Saturday";

  var n = weekday[d.getDay()];
    return n;
    }
    },

    mounted(){

       this.$axios.get(this.$apiUrl+'employee/get')
      .then(res => {
        this.saveemp = res.data;
      }).catch(err =>{
        this.output = err.data
      })


     this.axios
     .get(this.$apiUrl+'attendance/get-new')
     .then(res => {
       this.newemp = res.data
     })

        this.$axios.get(this.$apiUrl+'department/only')
     .then(res =>{
       this.only = res.data
     })
    this.axios
      .get(this.$apiUrl+'attendance/get')
      .then(res => {
        this.att = res.data;
      });




    },
    created(){
      this.$axios.get(this.$apiUrl+'attendance/get')
      .then(res => {
        this.emp = res.data;
      }).catch(err =>{
        this.output = err.data
      })
    },

    methods:{
       emps(){



        this.axios
        .get(this.$apiUrl+'attendance/check/' + this.dep + '/' + this.date)
        .then(res=>{
          this.data = res.data;
        })
      },

      post(e){
        e.preventDefault();

         let a = this.dep;

        var b = [];
        for(var i=0 ; i < this.saveemp.length;++i){

              if(this.saveemp[i].department == a ){

                      b[i] =  this.saveemp[i].id;


              this.axios.post(this.$apiUrl+'attendance/store',{
                date:this.date,
                emp_id : b[i]
              })
              .then(res => {

              })
        }
          }
      },

      find(){


      },



      save(event,emp,key){
        event.preventDefault();


        if(this.date == ''){
          alert('Please Fill Date')
        }else{
         var b = this.status[key];
         var c = this.reason[key];

        this.axios.post(this.$apiUrl+'date/' + emp,{


          status:b,
          reason:c


        }).then(res =>{
          this.$toast.success('Attendance Updated!!!');

        })

        }
      }
      },


      }

</script>


<style>
.toast-header i{

  display: none
}
 a:hover{
   text-decoration:none!important
 }
 .v-input__slot{
   position:unset;
 }
 .v-menu>.v-menu__content {
 top: 437px!important;
    left: 808px!important;
    transform-origin: center;
    overflow: hidden!important
 }
</style>
