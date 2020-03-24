<template>
  <v-card class="bg-white">

     <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <v-card-title>


     <h5> <strong class="pl-2">Employees List</strong></h5>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
        class="col-md-3"
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="emp"
      :search="search"
    >
      <template v-slot:items="props">
        <td>{{ props.item.employee_id }}</td>

        <td class="text-xs-">{{ props.item.salutation }} {{ props.item.firstname }} {{ props.item.lastname }}</td>

        <td class="text-xs-">{{ props.item.title }}</td>
        <td class="text-xs-">{{ props.item.designation_title }}</td>
         <td class="text-xs-">{{ props.item.mobilenumber }}</td>
         <td> <span>{{b = Math.abs(data.myDate.slice(0,4) - props.item.dateofjoin.slice(0,4))}} Y </span> <span >{{c =Math.abs(data.myDate.slice(5,7) - props.item.dateofjoin.slice(5,7) )}} M</span><span else> {{ a = Math.abs(data.myDate.slice(8,10) - props.item.dateofjoin.slice(8,10))}} D</span></td>



          <td class="text-xs-" >{{ props.item.status }}</td>

          <td class="text-xs-"><b-button class="btn-" :id="props.item.id" variant="primary" size="sm" @click="edit($event), largeModal = true"><i class="fa fa-edit"></i> Edit</b-button> &nbsp;<b-button class="btn-" variant="danger" size="sm" :id="props.item.id" @click="delet($event)"><i class="fa fa-trash" ></i> Delete</b-button></td>

      </template>
      <template>
        <v-alert  v-slot:no-results :value="true" color="error" icon="warning">
          Your search for "{{ search }}" found no results.
        </v-alert>
      </template>
    </v-data-table>
     <div>


<div>



  <b-modal title="Modal title" size="lg" v-model="largeModal" @ok="largeModal = false">





        <emp :get ="get"/>




    </b-modal>



</div>
  </div>
  </v-card>



</template>





<script>
import 'vuetify/dist/vuetify.min.css';
import emp from '../../views/employee/Edit_emp.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
  export default {

    components:{
        emp
    },

    data () {
      return {
                 data : { myDate : new Date().toISOString() },

        largeModal : false,


        search: '',
        headers: [
          {
            text: 'Employee ID',
            align: 'left',
            sortable: false,
            value: 'employee_id'
          },

          { text: 'Employee Name' ,value:"firstname" },


          { text: 'Department',value:"department"},
          { text: 'Designation',value:"designation" },
          { text: 'Mobile Number',value:"mobilenumber" },
          { text: 'At Work',value:"atwork" },
           { text: 'Status',value:"status"},
            { text: 'Action',value:"action"},

        ],
        emp: [],
        get:[],
        output:''
      }
    },
    computed:{
      date(){
        return this.dateofjoin;
      }
    },
    created(){

      this.$axios.get(this.$apiUrl+'employee/get')
      .then(res => {
        this.emp = res.data;
      }).catch(err =>{
        this.output = err.data
      })
    },

    methods:{
      delet(event){


          if(confirm('Do you really want to delete')){

              axios.delete(this.$apiUrl+'employee/delete/' + event.target.id)
              .then(res =>{
                let index = this.emp.indexOf(event);
                this.emp.splice(index,1);
              }).catch(err =>{
        this.output = err.data
      })
          }
      },
      edit(event){

          this.$axios.get(this.$apiUrl+'emp/get/' + event.target.id)
          .then(res => {
            this.get = res.data
          }).catch(err =>{
        this.output = err.data
      })
      }
    }
  }
</script>


<style>
 a:hover{
   text-decoration:none!important
 }
 .v-input__slot{
   position:unset;
 }
 .v-menu>.v-menu__content {
 top: auto!important;
    left: 808px!important;
    transform-origin: center;
    overflow: hidden!important
 }
</style>
