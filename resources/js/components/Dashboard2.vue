<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col sm="6" lg="3">
        <b-card no-body class="bg-primary">
          <b-card-body class="pb-0">
            <b-dropdown class="float-right" variant="transparent p-0" right>
              <template slot="button-content">
                <i class="icon-settings"></i>
              </template>
              <b-dropdown-item>Action</b-dropdown-item>
              <b-dropdown-item>Another action</b-dropdown-item>
              <b-dropdown-item>Something else here...</b-dropdown-item>
              <b-dropdown-item disabled>Disabled action</b-dropdown-item>
            </b-dropdown>
            <h4 class="mb-0">{{emp_info.attendence}} / 31</h4>
            <p>Total Attendance</p>
          </b-card-body>
          <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
        </b-card>
      </b-col>
      <b-col sm="6" lg="3">
        <b-card no-body class="bg-info">
          <b-card-body class="pb-0">
            <b-dropdown class="float-right" variant="transparent p-0" right no-caret>
              <template slot="button-content">
                <i class="icon-location-pin"></i>
              </template>
              <b-dropdown-item>Action</b-dropdown-item>
              <b-dropdown-item>Another action</b-dropdown-item>
              <b-dropdown-item>Something else here...</b-dropdown-item>
              <b-dropdown-item disabled>Disabled action</b-dropdown-item>
            </b-dropdown>
            <h4 class="mb-0">/ 10</h4>
            <p>Total leave</p>
          </b-card-body>
          <card-line2-chart-example chartId="card-chart-02" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
        </b-card>
      </b-col>
      <b-col sm="6" lg="3">
        <b-card no-body class="bg-warning">
          <b-card-body class="pb-0">
            <b-dropdown class="float-right" variant="transparent p-0" right>
              <template slot="button-content">
                <i class="icon-settings"></i>
              </template>
              <b-dropdown-item>Action</b-dropdown-item>
              <b-dropdown-item>Another action</b-dropdown-item>
              <b-dropdown-item>Something else here...</b-dropdown-item>
              <b-dropdown-item disabled>Disabled action</b-dropdown-item>
            </b-dropdown>
            <h4 class="mb-0">...</h4>
            <p>Total Income</p>
          </b-card-body>
          <card-line3-chart-example chartId="card-chart-03" class="chart-wrapper" style="height:70px;" height="70"/>
        </b-card>
      </b-col>
      <b-col sm="6" lg="3">
        <b-card no-body class="bg-danger">
          <b-card-body class="pb-0">
            <b-dropdown class="float-right" variant="transparent p-0" right>
              <template slot="button-content">
                <i class="icon-settings"></i>
              </template>
              <b-dropdown-item>Action</b-dropdown-item>
              <b-dropdown-item>Another action</b-dropdown-item>
              <b-dropdown-item>Something else here...</b-dropdown-item>
              <b-dropdown-item disabled>Disabled action</b-dropdown-item>
            </b-dropdown>
            <h4 class="mb-0">0</h4>
            <p>Award</p>
          </b-card-body>
          <card-bar-chart-example chartId="card-chart-04" class="chart-wrapper px-3" style="height:70px;" height="70"/>
        </b-card>
      </b-col>
    </b-row>

    <b-card>
      <b-row>
        <b-col sm="5">
          <h4 id="traffic" class="card-title mb-0">Profile</h4>
          <div class="small text-muted">{{a = new Date().toISOString().slice(0,10)}}</div>
        </b-col>


      </b-row>

          <b-row class="py-3">
            <b-col sm="4" class="text-center">
              <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" width="200" alt="">
              <h3 class="pt-3">{{emp_info.firstname}} {{emp_info.lastname}}</h3>
              <h5>{{emp_info.designation_title}}</h5>
                      <!-- <p class="bg-dark py-1">At work for: {{Math.abs(data.myDate.slice(0,4) - emp_info.dateofjoin.slice(0,4))}} {{Math.abs(data.myDate.slice(5,7) - emp_info.dateofjoin.slice(5,7) )}}  {{Math.abs(data.myDate.slice(8,10) - emp_info.dateofjoin.slice(8,10))}} </p> -->
                <hr>

                <!-- <div class="bg-dark bottom p-1">
                    <b-row>
                      <b-col sm="6">Attendance</b-col>
                      <b-col sm="6">Leaves</b-col>
                      <b-col sm="6">{{emp_info.attendence}} / 30</b-col>
                      <b-col sm="6">{{null}} / 10</b-col>
                    </b-row>
                </div> -->
            </b-col>

            <b-col sm="4">
              <b-card header="Personal Details" class="p-0 m-0">
                  <b-row class="p-0 m-0">
                    <b-col sm="6" class="personal">
                        <span class="text-info"> Name </span>
                    </b-col>
                    <b-col sm="6" class="personal">
                        {{emp_info.firstname}} {{emp_info.lastname}}
                    </b-col>
                    <b-col sm="6" class="personal">
                        <span class="text-info"> Date of Birth </span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.birthdate}}
                    </b-col>
                       <b-col sm="6" class="personal">
                        <span class="text-info"> Gender</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.gender}}
                    </b-col>


                        <b-col sm="6" class="personal">
                        <span class="text-info"> Marital Status</span>
                   </b-col>
                   <b-col sm="6" class="personal">

                        <span v-if="emp_info.maritalstatus == 'M'">Married</span>
                                                <span v-else>UnMarried</span>
                    </b-col>


                     <b-col sm="6" class="personal">
                        <span class="text-info">Email</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.email}}
                    </b-col>


                       <b-col sm="6" class="personal">
                        <span class="text-info">Local Address</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.addressline1}}
                    </b-col>


                     <b-col sm="6" class="personal">
                        <span class="text-info"> Permanent Address</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.taddressline1}}
                    </b-col>

            </b-row>





              </b-card>

            </b-col>

            <b-col sm="4">
              <b-card header="Company Details">
                      <b-row class="p-0 m-0">
                    <b-col sm="6" class="personal">
                        <span class="text-info"> Employee ID </span>
                    </b-col>
                    <b-col sm="6" class="personal">
                        {{emp_info.employee_id}}
                    </b-col>
                    <b-col sm="6" class="personal">
                        <span class="text-info">Department</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.title}}
                    </b-col>
                       <b-col sm="6" class="personal">
                        <span class="text-info"> Designation</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        {{emp_info.designation_title}}
                    </b-col>


                        <b-col sm="6" class="personal">
                        <span class="text-info">Date Of Join</span>
                   </b-col>
                   <b-col sm="6" class="personal">

                        {{emp_info.dateofjoin}}
                    </b-col>


                     <b-col sm="6" class="personal">
                        <span class="text-info">Basic Salary</span>
                   </b-col>
                   <b-col sm="6" class="personal">
                        Rs. {{emp_info.basic_salary}}
                    </b-col>






                      </b-row>
              </b-card>

            </b-col>


          </b-row>
    </b-card>


  </div>
</template>

<script>
import CardLine1ChartExample from './dashboard/CardLine1ChartExample'
import CardLine2ChartExample from './dashboard/CardLine2ChartExample'
import CardLine3ChartExample from './dashboard/CardLine3ChartExample'
import CardBarChartExample from './dashboard/CardBarChartExample'
import MainChartExample from './dashboard/MainChartExample'
import SocialBoxChartExample from './dashboard/SocialBoxChartExample'
import CalloutChartExample from './dashboard/CalloutChartExample'
import { Callout } from '@coreui/vue'

export default {



  name: 'dashboard',
  components: {
    Callout,
    CardLine1ChartExample,
    CardLine2ChartExample,
    CardLine3ChartExample,
    CardBarChartExample,
    MainChartExample,
    SocialBoxChartExample,
    CalloutChartExample
  },

  data: function () {
    return {
      emp_info:'',
   data : { myDate : new Date().toISOString() },
    a:'',
    b:'',
    c:'',
      selected: 'Month',
      tableItems: [
        {
          avatar: { url: 'img/avatars/1.jpg', status: 'success' },
          user: { name: 'Yiorgos Avraamu', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'USA', flag: 'us' },
          usage: { value: 50, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Mastercard', icon: 'fa fa-cc-mastercard' },
          activity: '10 sec ago'
        },
        {
          avatar: { url: 'img/avatars/2.jpg', status: 'danger' },
          user: { name: 'Avram Tarasios', new: false, registered: 'Jan 1, 2015' },
          country: { name: 'Brazil', flag: 'br' },
          usage: { value: 22, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Visa', icon: 'fa fa-cc-visa' },
          activity: '5 minutes ago'
        },
        {
          avatar: { url: 'img/avatars/3.jpg', status: 'warning' },
          user: { name: 'Quintin Ed', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'India', flag: 'in' },
          usage: { value: 74, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Stripe', icon: 'fa fa-cc-stripe' },
          activity: '1 hour ago'
        },
        {
          avatar: { url: 'img/avatars/4.jpg', status: '' },
          user: { name: 'Enéas Kwadwo', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'France', flag: 'fr' },
          usage: { value: 98, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'PayPal', icon: 'fa fa-paypal' },
          activity: 'Last month'
        },
        {
          avatar: { url: 'img/avatars/5.jpg', status: 'success' },
          user: { name: 'Agapetus Tadeáš', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Spain', flag: 'es' },
          usage: { value: 22, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Google Wallet', icon: 'fa fa-google-wallet' },
          activity: 'Last week'
        },
        {
          avatar: { url: 'img/avatars/6.jpg', status: 'danger' },
          user: { name: 'Friderik Dávid', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Poland', flag: 'pl' },
          usage: { value: 43, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Amex', icon: 'fa fa-cc-amex' },
          activity: 'Last week'
        }
      ],
      tableFields: {
        avatar: {
          label: '<i class="icon-people"></i>',
          class: 'text-center'
        },
        user: {
          label: 'User'
        },
        country: {
          label: 'Country',
          class: 'text-center'
        },
        usage: {
          label: 'Usage'
        },
        payment: {
          label: 'Payment method',
          class: 'text-center'
        },
        activity: {
          label: 'Activity'
        }
      }
    }
  },

  created(){

    var emp_id = localStorage.getItem('emp_id');

    this.axios
    .get('http://127.0.0.1:8000/api/employee/email/' + emp_id)
    .then(res => {
      this.emp_info = res.data;
    })
  },
  methods: {
    variant (value) {
      let $variant
      if (value <= 25) {
        $variant = 'info'
      } else if (value > 25 && value <= 50) {
        $variant = 'success'
      } else if (value > 50 && value <= 75) {
        $variant = 'warning'
      } else if (value > 75 && value <= 100) {
        $variant = 'danger'
      }
      return $variant
    },
    flag (value) {
      return 'flag-icon flag-icon-' + value
    }
  }
}
</script>

<style>
  /* IE fix */
  #card-chart-01, #card-chart-02 {
    width: 100% !important;
  }
  .bottom{
    font-size: 15px
  }

  .personal{
    background:#f4f4f4;
    padding: 10px 15px;
      margin: 5px auto
  }
</style>
