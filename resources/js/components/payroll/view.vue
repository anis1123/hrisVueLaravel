<template>
<div class="col-md-12">
  <div class="pb-5">

    <b-dropdown id="print" class=" float-right pb-5" variant="danger" right text="Action">
      <b-dropdown-item @click="print()"><i class="fa fa-print"></i>Print </b-dropdown-item>
      <b-dropdown-item disabled="disabled"><i class="fa fa-edit"></i>Edit</b-dropdown-item>

    </b-dropdown>
</div>
<div class="container-fluid bg-white mb-4">
  <div class="col-md-12 py-5">
    <div class="top text-right">
    <img width="60" class="img-fluid pb-2"  :src="'http://localhost/hrmsystem/storage/app/public/' + company.company_logo" alt="">
    <p class="p-0 m-0"><strong>{{company.company_name}}</strong></p>
    <p class="p-0 m-0">{{company.company_address}}, {{company.country}}</p>
    <p class="p-0 m-0"><strong>Contact: </strong>{{company.phone}}</p>
    </div>
    <hr style="border:1px solid">

    <div class="text-center pt-3">
        <h4><strong>Payslip</strong></h4>
        <h4><Strong>Salary Month: {{show.salary_month}} {{show.salary_year}} </Strong></h4>
    </div>
    <div class="row py-4">
      <div class="col-md-4">
        <strong>Employee ID:</strong> {{show.employee_id}}
      </div>
      <div class="col-md-4 text-center"><strong>Name:</strong> {{show.salutation}}{{show.firstname}} {{show.lastname}}
      </div>
      <div class="col-md-4"></div>
    </div>
     <div class="row">
      <div class="col-md-4">
        <strong>Department:</strong> {{show.title}}
      </div>
      <div class="col-md-4 text-center"><strong>Designation:</strong> {{show.designation_title}}</div>
      <div class="col-md-4 text-right"><strong>Joining Date:</strong>  {{show.dateofjoin}}</div>
    </div>


    <div class="row pt-5">
      <div class="col-md-6">
          <table border="1">
            <tr >
              <th colspan=2 class="p-3 text-center bg-light">  Payment Type</th>
            </tr>
            <tr>
              <th  width="250" class="px-3 py-1">Pay type</th>
              <th width="250" class="px-3 py-1">Amount</th>
            </tr>

            <tr>
              <td>
              <li class="p-1 px-3" style="list-style:none">


                  Salary

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{show.basic_salary}}

              </li>
              </td>


            </tr>
            <tr>
                 <td>
              <li class="p-1 px-3" style="list-style:none">


                  KPI

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{show.kpi}}

              </li>
              </td>
            </tr>
            <tr>
                 <td>
              <li class="p-1 px-3" style="list-style:none">


                  Incentive

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{show.insentive}}

              </li>
              </td>
            </tr>
             <tr>
                 <td>
              <li class="p-1 px-3" style="list-style:none">


                  Allowance

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{show.da}}

              </li>
              </td>
            </tr>

          </table>


      </div>


           <div class="col-md-6">
          <table border="1">
            <tr >
              <th colspan=2 class="p-3 text-center bg-light">  Deductions</th>
            </tr>
            <tr>
              <th  width="250" class="px-3 py-1">Pay type</th>
              <th width="250" class="px-3 py-1">Amount</th>
            </tr>

            <tr>
              <td>
              <li class="p-1 px-3" style="list-style:none">


                PF Employee

              </li>
              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                {{pf}}

              </li>
              </td>

            </tr>
             <tr>
                 <td>
              <li class="p-1 px-3" style="list-style:none">


                  Gratuity

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{gratuity}}

              </li>


              </td>
            </tr>
               <tr>
                 <td>
              <li class="p-1 px-3" style="list-style:none">


                  Income Tax

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{view[1]}}

              </li>


              </td>
            </tr>
               <tr>
                 <td>
              <li class="p-1 px-3" style="list-style:none">


                  SST

              </li>

              </td>
                <td>
              <li class="p-1 px-3" style="list-style:none">

                  {{view[2]}}

              </li>


              </td>
            </tr>
          </table>


      </div>






     <div class="col-md-6 offset-md-6 pt-5">
         <hr class="bg-dark">
       <div class="pt-4">
          <strong>Total</strong>
          <table border="1" class="pt-5">

             <tr>
              <th  width="250" class="px-3 py-1 bg-light">Net Salary</th>
              <th width="250" class="px-3 py-1 bg-light">{{company.currency}}{{view[3]}}</th>
            </tr>
          </table>




  </div>
  </div>
    </div>


    </div>

</div>
</div>

</template>

<script>
import { stringify } from 'querystring';
  export default {
      props:["view"]

  ,

  data:()=>{
      return{
          show:[],
          company:''

      }
  },




  created () {


      this.$axios.get('http://127.0.0.1:8000/api/payslip/get/' + this.view[0])
      .then(res => {
        this.show = res.data;
      }).catch(err =>{
        this.output = err.data
      })
        this.$axios.get('http://127.0.0.1:8000/api/company/get/')
      .then(res => {
        this.company = res.data;
      }).catch(err =>{
        this.output = err.data
      })
  }
,
  computed: {

     gratuity(){


            var a = parseFloat(this.show.basic_salary );
            var b = 8.33
            var c = (a * b) / 100;

                 return c

     },
     pf(){

               var a = parseFloat(this.show.basic_salary )
                var b = 10
                var c = (a * b) /100
                return c

          },
      gets(){
         var a = this.show.payment_id;

            return JSON.parse(a)

      },
        ded(){
         var a = this.show.deduction_id;

            return JSON.parse(a)

      }
   }
   ,
   methods:{
     print(){
       window.print();
     }
   }
  }
</script>

<style>
@media print {

   @page {
      size: A4;


    }


      #Header, #Footer { display: none !important; }
    body{width:100%;
    height:100%;
      scale: 66;
    -moz-transform: scale(66) }
 #print {
    display: none;
  }
  .breadcrumb{
    display:none
  }
  .app-footer{
    display: none
  }

}


</style>
