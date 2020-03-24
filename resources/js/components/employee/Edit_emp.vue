
<template>
  <div class="animated fadeIn">

      <Toasts
    :rtl="true"
    :max-messages="7"
    :time-out="3000"
></Toasts>
     <b-form @submit="post" >
    <b-row>
      <b-col sm="6">
        <b-card>
          <div slot="header">
            <strong>Employee Information</strong> <small> Form</small>
          </div>
            <b-row>
                 <b-col sm="12">
              <b-form-group>
                <label for="name">Employee Id</label>
                               <input class="form-control"  type="text"  v-model="get.employee_id" >
              </b-form-group>
            </b-col>
        </b-row>

          <b-row>
            <b-col sm="3">
                 <b-form-group>
                <label for="Salutation">Salutation</label>
                   <b-form-select
                    v-model="get.salutation"

                  :options="['Mr.','Ms.','Mrs.','Dr.','Prof.','other.']"

                  >
                </b-form-select>
              </b-form-group>

            </b-col>

            <b-col sm="4">
              <b-form-group>
                <label for="name">First Name</label>
                               <b-form-input type="text"  v-model="get.firstname" id="name"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="5">
              <b-form-group>
                <label for="lastname">Last Name</label>
                <b-form-input type="text" id="lastname"  v-model="get.lastname" :placeholder="get.lastname"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>
      </b-col>

        <b-col sm="6">
        <b-card>
          <div slot="header">
            <strong>Personal Detail</strong> <small>Form</small>
          </div>

            <b-form-group>
                <label for="name">Photo</label>
                 <b-form-file  ref="file-input"  v-on:change="onImageChange" ></b-form-file>
              </b-form-group>

          <b-row>

          </b-row>
          <b-row>
            <b-col sm="6">
              <b-form-group >
                <label for="month1">Grade</label>
                <b-form-select id="month1"

                  value="1"
                  v-model="get.grade"
                  :options="[1,2,3,4,5,6,7,8,9,10,11,12]">
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="year1">Maximus allow</label>
                <b-form-select id="year1"
                  :plain="true"
                  :options="[2014,2015,2016,2017,2018,2019,2020,2021,2022,2023,2024,2025]">
                </b-form-select>
              </b-form-group>
            </b-col>

          </b-row>
        </b-card>
      </b-col>
    </b-row>






    <b-row>
      <b-col sm="6">
        <b-card>
          <div slot="header">

            <strong>Permanent Address</strong> <small> Form</small>
          </div>
          <b-row>
            <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Line 1:</label>
                <b-form-input type="text" v-model="get.address_line1" id="name" :placeholder="get.address_line1"></b-form-input>
              </b-form-group>
            </b-col>
                 <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Line 2:</label>
                <b-form-input type="text" v-model="get.address_line2" id="name" :placeholder="get.address_line2"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>

            <b-col sm="4">
              <b-form-group>
                <label for="name">City</label>
                               <b-form-input type="text" v-model="get.city" id="name" :placeholder="get.city"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="4">
              <b-form-group>
                <label for="lastname">State</label>
                <b-form-input type="text" id="lastname" v-model="get.state" :placeholder="get.state"></b-form-input>
              </b-form-group>
            </b-col>
                      <b-col sm="4">
                 <b-form-group>
                <label for="country">Country</label>
                   <b-form-select id="country"
                      v-model="get.country"
                   :alue='get.country'
                  :options="['Nepal','India','USA','Bangladesh','Srilanka']">
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>
      </b-col>

        <b-col sm="6">
        <b-card>
          <div slot="header">

            <strong>Payment Mode</strong> <small> Form</small>
          </div>
          <b-row>
             <b-col sm="6">
              <b-form-group >
                <label for="month1" >Mode of pay</label>
                <b-form-select id=""
                  v-model="get.mode_of_pay"


                  :options="['Bank','Cash','Cheque']">
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="ccnumber">Bank Name</label>
                <b-form-input  type="text" id="ccnumber" v-model="get.bankname" :placeholder="get.bankname"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
          <b-row>

          </b-row>
          <b-row>
               <b-col sm="6">

              <b-form-group>
                <label for="name">Bank Account No</label>
                <b-form-input  type="text" id="name" v-model="get.bankacno" :placeholder="get.bankacno"></b-form-input>
              </b-form-group>
            </b-col>

            <b-col sm="6">
              <b-form-group>
                <label for="cvv">SWIFT Code</label>
                <b-form-input type="text" id="cvv" v-model="get.swiftcode" placeholder="SWIFT Code"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>





        <b-row>
      <b-col sm="6">
        <b-card>
          <div slot="header">
            <strong>Current / temporary Address</strong> <small> Form</small>
          </div>
          <b-row>
            <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Line 1:</label>
                <b-form-input type="text" v-model="get.taddress_line1" id="name" ></b-form-input>
              </b-form-group>
            </b-col>
                 <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Line 2:</label>
                <b-form-input type="text" v-model="get.taddress_line2" id="name" ></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>

            <b-col sm="4">
              <b-form-group>
                <label for="name">City</label>
                               <b-form-input type="text" v-model="get.tcity" id="name" ></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="4">
              <b-form-group>
                <label for="lastname">State</label>
                <b-form-input type="text" id="lastname" v-model="get.tstate" ></b-form-input>
              </b-form-group>
            </b-col>
                      <b-col sm="4">
                 <b-form-group>
                <label for="country">Country</label>
                   <b-form-select id="country"
                   value="Nepal"
                    v-model="get.tcountry"
                  :options="['Nepal','India','USA','Bangladesh','Srilanka']">
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
      <b-col sm="6">
        <b-card>
         <div slot="header">
            <strong>Contact Detail</strong> <small> Form</small>
          </div>
          <b-row>
            <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Home Phone</label>
                <b-form-input type="text" v-model="get.homephone" id="name" placeholder="Home Phone"></b-form-input>
              </b-form-group>
            </b-col>
                 <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Mobile Number</label>
                <b-form-input  type="text" v-model="get.mobilenumber" id="name" placeholder="Mobile Number"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
            <b-row>

            <b-col sm="6">
              <b-form-group>
                <label for="name">Email</label>
                               <b-form-input type="text" v-model="get.email" id="name" placeholder="Email"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="lastname">Date of Birth</label>
                <b-form-input type="date"  id="lastname" v-model="get.birthdate" placeholder="Gender"></b-form-input>
              </b-form-group>
            </b-col>
                      <b-col sm="6">
                 <b-form-group>
                <label for="country">Gender</label>
                   <b-form-select id="country"
                   value="Male"

                  v-model="get.gender"
                  :options="['Male','Female','Other']">
                </b-form-select>
              </b-form-group>
            </b-col>
                <b-col sm="6">
                 <b-form-group>
                <label for="country">Marital Status</label>
                   <b-form-select id="country"
                   value="Single"
                  v-model="get.maritalstatus"
                  :options="['Single','Marrried','Other']">
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>
          </b-card>
      </b-col>


      <b-row>


      </b-row>







    </b-row>


     <b-row>
      <b-col sm="6">

      </b-col>

    </b-row>


         <b-row>
      <b-col sm="6">
        <b-card>
          <div slot="header">
            <strong>Job Details</strong> <small> Form</small>
          </div>
          <b-row>

            <b-col sm="10" md="12">
                    {{get}}
                 <b-form-group>
                <label for="country">Department</label>
                   <b-form-select
                   id="country"
                   value=""
                    :change="event()"
                   v-model="get.title"

                  >
                  <option v-for="deps in dep" :value="deps.id">{{deps.title}}</option>
                </b-form-select>

              </b-form-group>

            </b-col>



            <b-col sm="10" md="6">
               <b-form-group>
                <label for="country">Designation</label>
                   <b-form-select id="country"


                   v-model="get.designation_id"

                   >
                   <option v-for="dess in des" :value="dess.id" >{{dess.designation_title}}</option>
                </b-form-select>
               </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="name">Date of Join</label>
                               <b-form-input type="date"  v-model="get.dateofjoin" id="name" placeholder="Email"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>

            <b-col sm="6">
              <b-form-group>
                <label for="lastname">Employee Type</label>

                   <b-form-select id="country"
                   value="Permanent"
                   v-model="get.emptype"

                  :options="['Permanent','Temporary','Contract']">
                </b-form-select>
                 </b-form-group>

            </b-col>
                      <b-col sm="6">
                 <b-form-group>
                <label for="country">Working Place</label>
                   <b-form-select id="country"
                  v-model="get.working"
                   value="Male"

                  :options="['Male','Female','Other']">
                </b-form-select>
              </b-form-group>
            </b-col>

          </b-row>
        </b-card>
      </b-col>
       <b-col sm="6">
        <b-card>
          <div slot="header">
            <strong>Employee Document</strong> <small> Form</small>
          </div>
          <b-row>

               <b-col sm="12">
              <b-form-group>
                <label for="name">Resume</label>
                 <b-form-file  ref="file-input" class="mb-2" v-model="get.resume"></b-form-file>
              </b-form-group>

            </b-col>
                 <b-col sm="12">
              <b-form-group>
                <label for="name">Offer Letter</label>
                 <b-form-file  ref="file-input" class="mb-2" v-model="get.offer"></b-form-file>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>

             <b-col sm="12">
              <b-form-group>
                <label for="name">Joining letter</label>
                 <b-form-file  ref="file-input" class="mb-2" v-on:change="onImageChangejoining"></b-form-file>
              </b-form-group>
            </b-col>
            <b-col sm="12">
              <b-form-group>
                <label for="name">Contract Paper</label>
                 <b-form-file  ref="file-input" class="mb-2" v-on:change="onImageChangecontract"></b-form-file>
              </b-form-group>
            </b-col>
             <b-col sm="12">
              <b-form-group>
                <label for="name">ID proff</label>
                 <b-form-file  ref="file-input" class="mb-2" v-on:change="onImageChangeid"></b-form-file>
              </b-form-group>
            </b-col>

            <b-col sm="12">
              <b-form-group>
                <label for="name">Other Document</label>
                 <b-form-file  ref="file-input" class="mb-2" v-on:change="onImageChangeother"></b-form-file>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>
      </b-col>


    </b-row>


             <b-button block variant="success py-2" type="submit">Update Employee</b-button>
<b-row class="resume" sm="6">


</b-row>
     </b-form>
    </div>
      </template>






      <script>
      import axios from 'axios'
import VueAxios from 'vue-axios'



          export default {
            props:['get'],

              data (){
                return{

                    dep:[],
                    des:[],
                    employee_id:'',
                   salutation:'',
                    firstname:'',
                    lastname:'',
                    line1:'',
                    line2:'',
                    city:'',
                    state:'',
                    country:'',
                    tline1:'',
                    tline2:'',
                    tcity:'',
                    tstate:'',
                    tcountry:'',
                    homephone:'',
                    email:'',
                    mobilenumber:'',
                    birthdate:'',
                    gender:'',
                    maritalstatus:'',
                    department:'',
                    departmentgroup:'',
                    designation:'',
                    dateofjoin:'',
                    emptype:'',
                    grade:'',
                    modeofpay:'',
                    bankname:'',
                    bankacno:'',
                    swiftcode:'',

                }
              },

             methods:{

                 onImageChange(e) {

                     this.name = e.target.files[0].name;
                     let image = e.target.files[0];
                     let form = new FormData();
                     form.append('image',image);
                        this.file=form;
                        this.read(image)
                     }

                     ,
                     read(image){
                         let reader = new FileReader();
                         reader.readAsDataURL(image);
                         reader.onload = e => {
                             this.images = e.target.result
                         }
                     }
                      ,

              onImageChangeresume(e){

                 this.resume = e.target.files[0].name;
                   console.log(this.resume);
                this.resumeimg = e.target.files[0];
            },
                onImageChangeoffer(e){

                 this.offername = e.target.files[0].name;
                   console.log(this.resume);
                this.offer = e.target.files[0];
            },
             onImageChangejoining(e){

                 this.joiningname = e.target.files[0].name;
                   console.log(this.resume);
                this.joining = e.target.files[0];
            },
             onImageChangecontract(e){

                 this.contractname = e.target.files[0].name;
                   console.log(this.resume);
                this.contract = e.target.files[0];
            },
               onImageChangeid(e){

                 this.idname = e.target.files[0].name;
                   console.log(this.resume);
                this.id = e.target.files[0];
            },
               onImageChangeother(e){

                 this.othername = e.target.files[0].name;
                   console.log(this.resume);
                this.other = e.target.files[0];
            },







                   event:function(){

                     console.log(this.department)

                           this.$axios.get(this.$apiUrl+'designation/only/' + this.get.department.id)
                          .then(res =>{
                            this.des = res.data
                            })

                      }
                    ,



               post(e){
                  e.preventDefault();
const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                  e.preventDefault();

   let formData = new FormData();
                formData.append('resume', this.resumeimg);

 this.axios.post(this.$apiUrl+'formSubmit', formData, config)
                .then(function (response) {
                    this.success = response.data.success;
                })
                .catch(function (error) {
                    this.output = error;
                });






   let offerle = new FormData();
                offerle.append('offer', this.offer);

 this.axios.post(this.$apiUrl+'offer', offerle, config)
                .then(function (response) {
                    this.success = response.data.success;
                })
                .catch(function (error) {
                    this.output = error;
                });


                   let joininglet = new FormData();
                joininglet.append('joining', this.joining);

 this.axios.post(this.$apiUrl+'joining', joininglet, config)
                .then(function (response) {
                    this.success = response.data.success;
                })
                .catch(function (error) {
                    this.output = error;
                });

   let contractlet = new FormData();
                contractlet.append('contract', this.contract);

 this.axios.post(this.$apiUrl+'contract', contractlet, config)
                .then(function (response) {
                    this.success = response.data.success;
                })
                .catch(function (error) {
                    this.output = error;
                });


                let idlet = new FormData();
                idlet.append('id', this.id);

 this.axios.post(this.$apiUrl+'id', idlet, config)
                .then(function (response) {
                    this.success = response.data.success;
                })
                .catch(function (error) {
                    this.output = error;
                });

                   let otherlet = new FormData();
                otherlet.append('other', this.other);

 this.axios.post(this.$apiUrl+'other', otherlet, config)
                .then(function (response) {
                    this.success = response.data.success;
                })
                .catch(function (error) {
                    this.output = error;
                });



                    this.axios
                .post(this.$apiUrl+'employee/add/photo',
                  this.file
                  )
                .then(res => {

                    this.data = res.data;
                    console.log(res.data);
                     this.name='';




                })



                      if(this.name==''){
                        this.name = this.get.profile
                      }
                        if( this.resume == ''){
                          this.resume = this.get.resume
                        }
                     if(this.offer == ''){
                     this.offer= this.get.offer
                     }

                     if(this.contract == ''){
                        this.contract =this.get.contract
                     }
                      if(this.joining == ''){
                        this.joining = this.get.joining
                      }

                      if(this.other == ''){
                        this.joining = this.get.other;
                      }
                     if(this.id == ''){
                         this.id = this.get.id

                     }




                  this.axios
                  .patch(this.$apiUrl+'employee/update/' + this.get.id,{


                       employee_id  : this.get.employee_id,
                      salutation : this.get.salutation,
                      firstname : this.get.firstname,
                      lastname : this.get.lastname,
                      address_line1 : this.get.address_line1,
                      address_line2 : this.get.address_line2,
                      city : this.get.city,
                      state : this.get.state,
                      country : this.get.country,
                      taddress_line1 : this.get.tline1,
                      taddress_line2 : this.get.tline2,
                      tcity : this.get.tcity,
                      tstate : this.get.tstate,
                      tcountry : this.get.tcountry,
                      homephone : this.get.homephone,
                      mobilenumber : this.get.mobilenumber,
                      email : this.get.email,
                      birthdate : this.get.birthdate,
                      gender : this.get.gender,
                      maritalstatus : this.get.maritalstatus,
                      department : this.get.department,
                      departmentgroup : this.get.departmentgroup,
                      designation : this.get.designation,
                      dateofjoin : this.get.dateofjoin,
                      profile : this.get.profile,
                      grade : this.get.grade,
                      modeofpay : this.get.modeofpay,
                      bankname : this.get.bankname,
                      bankacno : this.get.bankacno,
                      swiftcode : this.get.swiftcode,

                      profile : this.name,
                      resume : this.resume,
                      offer : this.offer,
                      contract : this.contract,
                      joining : this.joining,
                      other : this.joining,
                      id : this.id


                  }).then(response=>{
                      this.$toast.success('Employee Updated!!!');

                  }).catch(err => {
                    self.fetchError = err
                  })

             }





          },
          mounted(){
          this.$axios.get(this.$apiUrl+'department/only')
          .then(res =>{
            this.dep = res.data
            })
      },



          }




      </script>


















<style>


.toast-header i{

  display: none
}
</style>
