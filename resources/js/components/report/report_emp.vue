<template>
  <!-- <b-card header="Employee Report"> -->
    <!-- <b-row>
      <b-col sm="6">

        <b-input type="date"></b-input>
        </b-col>
      <b-col>
        <b-input></b-input>
        </b-col>

    </b-row> -->
    <!-- <table class="table mt-5 table-bordered table-responsive">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Work No.</th>
      <th scope="col">First Name</th>
       <th scope="col">Last Name</th>

      <th scope="col">Marital Status</th>
      <th scope="col">Dep</th>
      <th scope="col">Position</th>
      <th scope="col">Basic</th>
      <th scope="col">DA</th>
      <th scope="col">Gratuity</th>

      <th scope="col">Adjustment</th>
      <th scope="col">Gratuity</th>
      <th scope="col">PF Employer</th>
      <th scope="col">GROSS CTC</th>
      <th scope="col">Total Working Days</th>
      <th scope="col">Attendance</th>
      <th scope="col">Net Payabale</th>
      <th scope="col">Billing Amount</th>
      <th scope="col">Payable before SST</th>
      <th scope="col">CIT</th>
       <th scope="col">Yearly Average</th>
      <th scope="col">Income Tax</th>
      <th scope="col">Payable before SST</th>
      <th scope="col">SST</th>
       <th scope="col">Net Payable</th>


    </tr>
  </thead>

  <tbody v-for="(em,key) in emp">

    <tr>
        <td>
            {{key+1}}
        </td>
         <td>
          {{em.employee_id}}
        </td>
        <td>
          {{em.firstname}}
        </td>

        <td>
          {{em.lastname}}
        </td>
         <td>
          {{em.maritalstatus}}
        </td>
          <td>
          {{em.title}}
        </td>
          <td>
          {{em.designation_title}}
        </td>
          <td>
            {{em.basic_salary}}
        </td>
           <td>
            {{em.total_allowances}}
        </td>
        <td>

        </td>
          <td>
            {{em.payslip_adj}}

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>

        </td>
          <td>
            {{em.payslip_cit}}
        </td>
          <td>

        </td>

    </tr>

  </tbody>
</table> -->
<div>

   <v-card class="bg-white p-3 mb-1">

     <h4 class="pt-2">Employee Report</h4>
 </v-card>



 <v-card class="bg-white">


     <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <v-card-title>




       <v-text-field
       type=""
        label="Search"
        single-line
        hide-details
        class="col-md-3"
      ></v-text-field>

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
        <!-- <td>{{ props.item.employee_id }}</td>

        <td class="text-xs-">{{ props.item.salutation }} {{ props.item.firstname }} {{ props.item.lastname }}</td>

        <td class="text-xs-">{{ props.item.title }}</td>
        <td class="text-xs-">{{ props.item.designation_title }}</td>
         <td class="text-xs-">{{ props.item.mobilenumber }}</td>
         <td> <span >{{b = Math.abs(data.myDate.slice(0,4) - props.item.dateofjoin.slice(0,4))}} Y </span> <span >{{c =Math.abs(data.myDate.slice(5,7) - props.item.dateofjoin.slice(5,7) )}} M</span><span else> {{ a = Math.abs(data.myDate.slice(8,10) - props.item.dateofjoin.slice(8,10))}} D</span></td>



          <td class="text-xs-" >{{ props.item.status }}</td>

          <td class="text-xs-"><b-button class="btn-" :id="props.item.id" variant="primary" size="sm" @click="edit($event), largeModal = true"><i class="fa fa-edit"></i> Edit</b-button> &nbsp;<b-button class="btn-" variant="danger" size="sm" :id="props.item.id" @click="delet($event)"><i class="fa fa-trash" ></i> Delete</b-button></td> -->

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




</div>
</template>


<script>
    export default {
      data(){

        return{
          emp:'',
             search: '',
        headers: [
          {
            text: 'SN',
            align: 'left',
            sortable: false,
            value: 'employee_id'
          },

          { text: 'Work No' ,value:"firstname" },


          { text: 'First Name',value:"firstname"},
          { text: 'Last Name',value:"lastname" },
          { text: 'Marital Status',value:"maritalstatus" },
          { text: 'Dep',value:"" },
           { text: 'Position',value:"status"},
            { text: 'Basic',value:"action"},
             { text: 'DA',value:"maritalstatus" },
          { text: 'Gratuity',value:"" },
           { text: 'Adjustment',value:"status"},
            { text: 'PF Employer',value:"action"},
            { text: 'GROSS CTC',value:"" },
           { text: 'Total Working Days',value:"status"},
            { text: 'Attendance',value:"action"},
            { text: 'Net Payable',value:"" },
           { text: 'Billing Amount',value:"status"},
            { text: 'Payable before SST',value:"action"},
              { text: 'CIT',value:"" },
           { text: 'Yearly Average',value:"status"},
            { text: 'Income Tax',value:"action"},
                { text: 'SST',value:"action"},
              { text: 'Net Payable',value:"" },
              { text: 'Action',value:"action"},



        ],
        }

      },
        created(){

      this.$axios.get('http://127.0.0.1:8000/api/employee/get')
      .then(res => {
        this.emp = res.data;
      }).catch(err =>{
        this.output = err.data
      })
    },
    }

</script>



<style scoped>
  th{
    font-size:12px
  }
</style>
