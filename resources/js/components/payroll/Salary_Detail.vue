<template>
  <div>

    <b-form @submit="post" enctype="multipart/form-data">
    <b-row>
      <b-col sm="12">
        <link
          rel="stylesheet"
          href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons"
        >

        <b-card>
          <div slot="header">
            <strong>Manage Salary Details</strong>
            <small> Form</small>
          </div>

          <b-row>
            <b-col sm="3" class="pl-3" md="3">
              <b-form-group>
                <label for="country">Designation</label>
                {{empp}}
                <md-select
                  v-model="empp"
                  name="movie"
                  :change="desig()"
                  class="form-control"
                  style="overflow:hidden"
                >
                  <div v-for="depp in dep">
                    <md-option  :value="depp.department" disabled>
                      <strong>{{depp.department}}</strong>
                    </md-option>
                    <div v-for="dess in depp.designation">
                      <md-option :value="dess[1]">&nbsp;&nbsp;&nbsp;{{dess[0]}}</md-option>
                    </div>
                  </div>
                </md-select>
              </b-form-group>
            </b-col>

            <b-col sm="3" md="3">
              <b-form-group>
                <label for="country">Employee</label>

                <b-form-select id="country" required v-model="employee">
                  <option
                    v-for="dess in emp"
                    :value="dess.id"
                  >{{dess.salutation}}{{dess.firstname}} {{dess.lastname}} &nbsp;[{{dess.employee_id}}]</option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="3" md="3">
              <b-form-group>
                <label for="country">Month</label>
                <b-form-select id="country" required v-model="month">
                  <option value="Janaury">Janaury</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November">November</option>
                  <option value="December">December</option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="2" md="2">
              <b-form-group>
                <label for="country">Year</label>
                <b-form-select id="country" required v-model="year">
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="1">
              <b-form-group>
                <label for></label>
                <button class="btn btn-success mt-4" @click.stop="check($event)">GO</button>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>

        <template v-if="show==true">
          <b-card>
            <div slot="header">
              <strong>Salary Info</strong>
              <small> Form</small>
            </div>

            <b-row>

              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label for="country">Hourly Rate</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" class="form-control" v-model="hrsrate">
                </b-form-group>
              </b-col>
            </b-row>

            <b-row>
              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label for="country">Hourly Clocked</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" class="form-control" v-model="hrsclocked">
                </b-form-group>
              </b-col>
            </b-row>

            <b-row>
              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label for="country">Total Hours Payment (Rs)</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" disabled class="form-control" v-model="totalhrs">
                </b-form-group>
              </b-col>
            </b-row>

            <b-row>
              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label for="country">Basic Salary (Rs)</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" class="form-control" v-model.number="basic_salary" required>
                </b-form-group>
              </b-col>
            </b-row>
          </b-card>

          <b-row>
            <b-col>
              <b-card>

                <div slot="header">

                  <strong>Allowances</strong>
                  <small> Form</small>
                </div>

                <div class="form-group" v-for="(input,k) in inputs" :key="k">

                  <b-row class="px-4">
                    <b-col>
                      <input
                        type="text"
                        class="form-control"
                        v-model="input.name"
                        placeholder="Allowance"
                      >

                    </b-col>
                    <b-col>
                      <input
                        type="number"
                        class="form-control"
                        v-model.number="input.price"
                        placeholder="Value"
                      >


                    </b-col>
                    <b-col sm="1">
                      <label for class="pt-2">
                        <strong>Rs</strong>
                      </label>
                    </b-col>
                    <b-col sm="1" class="pt-2">
                      <i
                        class="icon-minus text-danger"
                        @click="remove(k)"
                        v-show="k || ( !k && inputs.length > 1)"
                      ></i>
                    </b-col>
                  </b-row>
                  <b-col sm="5" offset="5" class="pt-3">
                    <strong>
                      <i
                        class="icon-plus text-success"
                        @click="add(k)"
                        v-show="k == inputs.length-1"
                      ></i>
                    </strong>
                  </b-col>
                </div>
              </b-card>
            </b-col>

            <b-col>
              <b-card>
                <div slot="header">
                  <strong>Deductions</strong>
                  <small> Form</small>
                </div>

                  <div class="form-group" v-for="(input,k) in deduction" :key="k">
                  <b-row class="px-4">
                    <b-col>
                      <input
                        type="text"
                        class="form-control"
                        v-model="input.ded"
                        placeholder="Deduction"
                      >
                    </b-col>
                    <b-col>
                      <input
                        type="text"
                        class="form-control"
                        v-model="input.deductionprice"
                        placeholder="Value"
                      >
                    </b-col>
                    <b-col sm="1">
                      <label for class="pt-2">
                        <strong>Rs</strong>
                      </label>
                    </b-col>
                    <b-col sm="1" class="pt-2">
                      <i
                        class="icon-minus text-danger"
                        @click="removeded(k)"
                        v-show="k || ( !k && deduction.length > 1)"
                      ></i>
                    </b-col>
                  </b-row>
                  <b-col sm="5" offset="5" class="pt-3">
                    <strong>
                      <i
                        class="icon-plus text-success"
                        @click="addded(k)"
                        v-show="k == deduction.length-1"
                      ></i>
                    </strong>
                  </b-col>
                </div>
              </b-card>


            </b-col>
          </b-row>

          <b-card>


              <div slot="header">
                  <strong>Gross Salary</strong>
                  <small> Form</small>
                </div>
                <b-row>
              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label for="country">Total Allowances (Rs)</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" disabled class="form-control"  v-model.number="totalAllowance">
                </b-form-group>
              </b-col>
            </b-row>
                    <b-row>
              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label >Total Deductions (Rs)</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" disabled class="form-control" v-model.number="totalDeduction">
                </b-form-group>
              </b-col>
            </b-row>
                    <b-row>
              <b-col sm="3" class="text-right" md="3">
                <b-form-group class="pt-2">
                  <label for="country">Net Salary (Rs)</label>
                </b-form-group>
              </b-col>
              <b-col sm="8" class="pl-5" md="8">
                <b-form-group>
                  <input type="number" disabled class="form-control" v-model.number="totalsalary">
                </b-form-group>
              </b-col>
            </b-row>


          </b-card>
 <b-col class="text-center pb-3">
          <button class="btn btn-success px-5" type="submit">Submit</button>
        </b-col>
        </template>

      </b-col>
    </b-row>
    </b-form>
  </div>
</template>

<style>
i {
  font-size: 20px;
}
[type="number"] {
  width: -webkit-fill-available;
}
</style>

<script>
import VueMaterial from "vue-material";
import "vue-material/dist/vue-material.min.css";
export default {
  data() {
    return {
      show : false,

      month:'',
      year:'',
      inputs: [
        {
          name: "Allowance 1",
          price: '0'
        }
      ],

      deduction:[{
        deductionprice:"0",
        ded:"Deduction 1"
      }],

      hrsrate:'0',
      hrsclocked:'0',
      hrspayment:'0',


      dep: [],
      empp: "",
      empall:"",
      basic_salary:'',

      output: "",
      employee: "",
      emp: []
    };
  },

  methods: {
    check(event){
        event.preventDefault();
        if(this.empp!=''||this.employee!=''||this.month!=''||this.year!=''){
          this.show=true
        }else{
          alert('Please fill all !!!')
        }
    },
    aas(){
          alert(this.inputs.price);
    },
    add(index) {
      this.inputs.push({ name: "",price:"" });
    },
    remove(index) {
      this.inputs.splice(index, 1);
    },

     addded(index) {
      this.deduction.push({ deduction: "" });
    },
    removeded(index) {
      this.deduction.splice(index, 1);
    },

    desig() {
        this.$axios.get('http://127.0.0.1:8000/api/employee/get')
      .then(res => {
        this.empall = res.data;
      }).catch(err =>{
        this.output = err.data
      })





      this.axios
        .get("/emp/" + this.empp)
        .then(res => {
          this.emp = res.data;
        })
        .catch(err => {
          this.output = err.data;
        });
    },


    post(e){

      var b = JSON.stringify(this.inputs);
      var c =JSON.stringify(this.deduction);
      e.preventDefault();

       var a = 1;
        a= a+1;
      this.axios.post('http://127.0.0.1:8000/api/payslip/store',{


           salary_month : this.month,
           salary_year:this.year,
        employee_id : this.employee,
        payslip_no :  a,
        hrs_payment:this.hrspayment,
         hrs_rate:this.hrsrate,
         hrs_clocked :this.hrsclocked,
         payment_id : b,
          deduction_id :c,
         total_allowances : this.totalAllowance,
         total_deduction :this.totalDeduction,
        new_Salary : this.totalsalary

      }).then(res => {
        console.log(res.data);

        this.$router.push('/payroll/record')
      })



    }
  },

  computed: {


      totalAllowance() {
        return this.inputs.reduce((total, item) => {
          return total + Number(item.price);

        }, 0);
      }
  ,
       totalDeduction() {
        return this.deduction.reduce((total, item) => {
          return total + Number(item.deductionprice);

        }, 0);
      },

      totalsalary(){

          return ( parseInt(this.basic_salary)+ this.totalAllowance +this.totalhrs ) - this.totalDeduction


      }

      ,
      totalhrs(){
        return this.hrsrate * this.hrsclocked;
      }


  },

  created() {






    this.axios
      .get("http://127.0.0.1:8000/api/designation")
      .then(res => {
        this.dep = res.data;
      })
      .catch(err => {
        this.output = err.data;
      });
  }
};
</script>

<style>
.md-menu-content-container {
  background: #fff;
}
.md-icon-image svg {
    height: 81%;
}



.md-menu-content.md-select-menu {
    z-index: 12;
    width: 190px;
    border-radius: 10px;
     position: absolute;
    top: 239px;
    left: 51px;
    will-change: top, left;

}

</style>
