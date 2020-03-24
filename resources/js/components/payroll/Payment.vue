<template>
  <v-card class="bg-white">

     <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <v-card-title>


     <h5> <strong class="pl-2">Payroll Record</strong></h5>
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

        <td class="text-xs-">{{ props.item.salary_month }}</td>
        <td class="text-xs-">{{ props.item.salary_year }}</td>
         <td class="text-xs-">{{ props.item.new_Salary }}</td>
          <td class="text-xs-">{{ props.item.created_at }}</td>
          <td class="text-xs-"><b-btn class="btn-sm text-white" variant="success" @click="view(props.item.id)"><i class="fa fa-eye"></i> View</b-btn>&nbsp; <b-btn class="" :id="props.item.id" variant="primary" size="sm" @click="edit($event), largeModal = true"><i class="fa fa-edit"></i> Edit</b-btn>&nbsp; <b-button class="btn-" variant="danger" size="sm" :id="props.item.id" @click="delet($event)"><i class="fa fa-trash" ></i> Delete</b-button></td>

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
 <view/>


</div>
  </div>
  </v-card>



</template>





<script>
import 'vuetify/dist/vuetify.min.css';
import emp from '../../views/employee/Edit_emp.vue'
import view from '../../views/payroll/view.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
  export default {

    components:{
        emp,
        view

    },

    data () {
      return {
        largeModal : false,

        search: '',
        headers: [
          {
            text: 'Employee ID',
            align: 'left',
            sortable: false,
            value: 'employee_id'
          },
          { text: 'Name' ,value:"firstname" },

          { text: 'Month',value:"department"},
          { text: 'Year',value:"designation" },
          { text: 'Net Salary(Rs)',value:"mobilenumber" },
           { text: 'Created On',value:"status"},
            { text: 'Action',value:"action"},

        ],
        emp: [],
        get:[],
        output:''
      }
    },
    created(){

      this.$axios.get('http://127.0.0.1:8000/api/payslip/get')
      .then(res => {
        this.emp = res.data;
      }).catch(err =>{
        this.output = err.data
      })
    },

    methods:{

      view(e){

        this.$router.push({name:'Payslip-view',params:{view:e}});

      },

      delet(event){


          if(confirm('Do you really want to delete')){

              axios.delete('http://127.0.0.1:8000/api/employee/delete/' + event.target.id)
              .then(res =>{
                let index = this.emp.indexOf(event);
                this.emp.splice(index,1);
              }).catch(err =>{
        this.output = err.data
      })
          }
      },
      edit(event){

          this.$axios.get('http://127.0.0.1:8000/api/emp/get/' + event.target.id)
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
 top: 437px!important;
    left: 808px!important;
    transform-origin: center;
    overflow: hidden!important
 }
</style>
