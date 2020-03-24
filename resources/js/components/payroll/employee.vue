<template>
  <div>



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
            <td class="text-md-12 px-3"><b-btn class="btn-sm text-white "  variant="primary" @click="view([props.item.employee_id,incometax,sst,total])"><i class="fa fa-eye"></i> Payslip</b-btn></td>

        <td>{{ props.item.employee_id }}</td>
        <td class="text-xs-">{{ props.item.salutation }} {{ props.item.firstname }} </td>
        <td>{{ props.item.lastname }}</td>
        <td>{{props.item.maritalstatus}}</td>
         <td>{{props.item.title}}</td>
         <td>{{props.item.designation_title}}</td>
        <td>{{ props.item.basic_salary}}</td>
          <td>{{ props.item.da}}</td>
          <td>{{gratuity}}</td>
          <td>{{ props.item.adjustment}}</td>
           <td>{{pf}}</td>
           <td>{{sumctc}}</td>
            <td>{{ props.item.total_working_days}}</td>

             <td>{{ props.item.attendence}}</td>
             <td>{{net_payable1}}</td>
        <td class="text-xs-">{{ billAmt }}</td>
         <td class="text-xs-">{{ before_sst }}</td>
          <td class="text-xs-">{{ props.item.cit}}</td>
          <td class="text-xs-">{{ yearly_average}}</td>
           <td class="text-xs-">{{ incometax / 12}}</td>
           <td class="text-xs-">{{sst / 12}}</td>
             <td class="text-xs-">{{props.item.net_recived}}</td>
               <td class="text-xs-">{{props.item.kpi}}</td>
                <td class="text-xs-">{{props.item.insentive}}</td>
                <td class="text-xs-">{{total}}</td>


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

</div>

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
      computed:{

        sumctc(){

          for(var i = 0 ; i < this.emp.length ; i++ ){

            var a = parseFloat(this.emp[i].basic_salary );
            var b =parseFloat(this.emp[i].pf);
            var c =parseFloat(this.emp[i].da)
            var d =parseFloat(this.emp[i].gratuity)
             var e =parseFloat(this.emp[i].adjustment)
            var f = a + b + c + d + e

                 return f
          }
        }
                  ,
          gratuity(){
               for(var i = 0 ; i < this.emp.length ; i++ ){

            var a = parseFloat(this.emp[i].basic_salary );
            var b = 8.33
            var c = (a * b) / 100;

                 return c
          }
          }
          ,
          pf(){
              for(var i = 0 ; i < this.emp.length ; i++ ){
               var a = parseFloat(this.emp[i].basic_salary )
                var b = 10
                var c = (a * b) /100
                return c
              }
          }
          ,
          net_payable1(){
              for(var i = 0 ; i < this.emp.length ; i++ ){
              var a = parseFloat(this.emp[i].basic_salary)
              var b =  parseFloat(this.emp[i].da)
              if(parseFloat(this.emp[i].total_working_days) == ''){
                  var d = 0;
              }else {
                var d = parseFloat(this.emp[i].total_working_days)
              }
               if( parseFloat(this.emp[i].adjustment) == null){
                 var e = 0
              }else {
                var e =  parseFloat(this.emp[i].adjustment)
              }
              var c = (a + b) / d * parseFloat(this.emp[i].attendence) + e

              return c

              }
          }
          ,
          billAmt(){
            for(var i = 0 ; i < this.emp.length ; i++ ){
              var a = parseFloat(this.emp[i].pf)
              var b =  parseFloat(this.emp[i].gratuity)
              var c =  this.net_payable1
              var d = a + b + c
              return d


            }
          },
          before_sst(){

             for(var i = 0 ; i < this.emp.length ; i++ ){
              var a = parseFloat(this.emp[i].pf)
              var b =  parseFloat(this.emp[i].gratuity)
              var c =  this.net_payable1
              var d = b + c - a
              return d


            }
          },
            yearly_average(){

              for(var i = 0 ; i < this.emp.length ; i++ ){
              var a = parseFloat(this.emp[i].cit)
              var b =  this.before_sst

              var d = (b - a) * 12
              return d


            }

            },

            incometax(){

              for(var i = 0 ; i < this.emp.length ; i++ ){

                  if(this.emp[i].maritalstatus == 'UM' ){
                    if(this.yearly_average <= 350000){
                       return 0

                    }
                    else if(this.yearly_average<=450000){
                     return parseFloat(((this.yearly_average - 350000) * 10) / 100)
                    }
                      else if(this.yearly_average<=650000){
                     return parseFloat((((this.yearly_average - 450000) * 20) / 100) + 10000)
                    }
                    else if(this.yearly_average<=2000000){
                     return parseFloat((((this.yearly_average - 650000) * 30) / 100) + 50000)
                    }
                    else{
                      return parseFloat((((this.yearly_average - 2000000) * 36) / 100) + 445000)
                    }

                  }else{
                     if(this.yearly_average <= 400000){
                       return 0

                    }
                      else if(this.yearly_average<=500000){
                     return parseFloat(((this.yearly_average - 400000) * 10) / 100)
                    }
                      else if(this.yearly_average<=700000){
                     return parseFloat((((this.yearly_average - 500000) * 20) / 100) + 10000)
                    }
                    else if(this.yearly_average<=2000000){
                     return parseFloat((((this.yearly_average - 700000) * 30) / 100) + 50000)
                    }
                    else{
                      return parseFloat((((this.yearly_average - 2000000) * 36) / 100) + 440000)
                    }


                  }





            }


            },


            sst(){
               for(var i = 0 ; i < this.emp.length ; i++ ){
              if(this.emp[i].maritalstatus == 'M'){
                if(this.yearly_average > 400000){
                    return 4000
                }else{
                   return parseFloat((this.yearly_average * 1) /100)
                }
              }else if(this.yearly_average > 350000){
                return 3500
              }else{
                return parseFloat((this.yearly_average * 1) / 100)
              }
            }
            },

            total(){
              for(var i = 0 ; i < this.emp.length ; i++ ){
              var a = parseFloat(this.emp[i].net_recived);
              var b = parseFloat(this.emp[i].insentive);
              var c = parseFloat(this.emp[i].kpi)
              var d = a + b + c
                  return d
              }
            }







      },
    data () {
      return {
        largeModal : false,

        search: '',
        headers: [

          {text : 'Action'},
          { text: 'Work No' ,value:"firstname" },


          { text: 'First Name',value:"firstname"},
          { text: 'Last Name',value:"lastname" },
          { text: 'Marital Status',value:"maritalstatus" },
          { text: 'Dep',value:"title" },
           { text: 'Position',value:"designation_title"},
            { text: 'Basic',value:"basic_salary"},
             { text: 'DA',value:"da" },
          { text: 'Gratuity',value:"gratuity" },
           { text: 'Adjustment',value:"adjustment"},
            { text: 'PF Employer',value:"pf"},
            { text: 'GROSS CTC',value:"ctc" },
           { text: 'Total Working Days',value:"total_working_days"},
            { text: 'Attendance',value:"attendance"},
            { text: 'Net Payable',value:"" },
           { text: 'Billing Amount',value:"status"},
            { text: 'Payable before SST',value:"action"},
              { text: 'CIT',value:"" },
           { text: 'Yearly Average',value:"status"},
            { text: 'Income Tax',value:"action"},
                { text: 'SST',value:"action"},
              { text: 'Net Payment',value:"" },
              { text: 'KPI',value:"" },
              { text: 'Incentive',value:"" },
              { text: 'Total',value:"" },




        ],



        emp: [],
        get:[],
        output:'',
        empl_id:''
      }
    },
    created(){

      this.emp_id=localStorage.getItem('emp_id')

      this.$axios.get(this.$apiUrl+'payslip/employee/' + this.emp_id)
      .then(res => {
        this.emp = res.data;
      }).catch(err =>{
        this.output = err.data
      })
    },

    methods:{

      view(e,f,g,h){

        this.$router.push({name:'Payslip-view',params:{view:e,f,g,h}});

      },

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
 top: 437px!important;
    left: 808px!important;
    transform-origin: center;
    overflow: hidden!important
 }
 tr td{
   font-weight: 600
 }
</style>

