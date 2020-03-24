
<template>
  <div class="animated fadeIn">

      <Toasts
    :rtl="true"
    :max-messages="7"
    :time-out="3000"
></Toasts>

  {{output}}
     <b-form @submit="post" enctype="multipart/form-data">
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
                               <b-form-input type="text" v-model="emp_id" id="name" placeholder="Employee Id" required></b-form-input>
              </b-form-group>
            </b-col>
        </b-row>

          <b-row>
            <b-col sm="3">
                 <b-form-group>
                <label for="Salutation">Salutation</label>
                   <b-form-select
                   v-model="salutation"
                   value="Mr."
                   required
                  :options="['Mr.','Ms.','Mrs.','Dr.','Prof.','other.']" >
                </b-form-select>
              </b-form-group>

            </b-col>

            <b-col sm="4">
              <b-form-group>
                <label for="name">First Name</label>
                               <b-form-input type="text" required v-model="firstname" id="name" placeholder="First Name"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="5">
              <b-form-group>
                <label for="lastname">Last Name</label>
                <b-form-input type="text" id="lastname" required v-model="lastname" placeholder="Last Name"></b-form-input>
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
          <b-row>
            <b-col sm="12">

              <b-form-group>
                <label for="name">Photo</label>
                <img :src="images" alt="" class="pl-5 pt-3" height="60">

                 <b-form-file  ref="file-input"  v-on:change="onImageChange"  class="mb-2"></b-form-file>
              </b-form-group>
            </b-col>
          </b-row>
          <b-row>

          </b-row>
          <b-row>
            <b-col sm="6">
              <b-form-group >
                <label for="month1">Grade</label>
                <b-form-select id="month1"

                  value="1"
                  v-model="grade"
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
                <b-form-input type="text" v-model="line1" id="name" placeholder="Address Line:1"></b-form-input>
              </b-form-group>
            </b-col>
                 <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Line 2:</label>
                <b-form-input type="text" v-model="line2" id="name" placeholder="Address Line:2"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>

            <b-col sm="4">
              <b-form-group>
                <label for="name">City</label>
                               <b-form-input type="text" v-model="city" id="name" placeholder="City"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="4">
              <b-form-group>
                <label for="lastname">State</label>
                <b-form-input type="text" id="lastname" v-model="state" placeholder="State"></b-form-input>
              </b-form-group>
            </b-col>
                      <b-col sm="4">
                 <b-form-group>
                <label for="country">Country</label>
                   <b-form-select id="country"
                      v-model="country"
                   value='Nepal'
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
                  v-model="modeofpay"
                  value='Bank'
                  required
                  :options="['Bank','Cash','Cheque']">
                </b-form-select>
              </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="ccnumber">Bank Name</label>
                <b-form-input required type="text" id="ccnumber" v-model="bankname" placeholder="Bank Name"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
          <b-row>

          </b-row>
          <b-row>
               <b-col sm="6">

              <b-form-group>
                <label for="name">Bank Account No</label>
                <b-form-input required type="text" id="name" v-model="bankacno" placeholder="Bank Account No"></b-form-input>
              </b-form-group>
            </b-col>

            <b-col sm="6">
              <b-form-group>
                <label for="cvv">SWIFT Code</label>
                <b-form-input type="text" id="cvv" v-model="swiftcode" placeholder="SWIFT Code"></b-form-input>
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
                <b-form-input type="text" v-model="tline1" id="name" placeholder="Address Line:1"></b-form-input>
              </b-form-group>
            </b-col>
                 <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Line 2:</label>
                <b-form-input type="text" v-model="tline2" id="name" placeholder="Address Line:1"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>

            <b-col sm="4">
              <b-form-group>
                <label for="name">City</label>
                               <b-form-input type="text" v-model="tcity" id="name" placeholder="City"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="4">
              <b-form-group>
                <label for="lastname">State</label>
                <b-form-input type="text" id="lastname" v-model="tstate" placeholder="State"></b-form-input>
              </b-form-group>
            </b-col>
                      <b-col sm="4">
                 <b-form-group>
                <label for="country">Country</label>
                   <b-form-select id="country"
                   value="Nepal"
                    v-model="tcountry"
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
                <b-form-input type="text" v-model="homephone" id="name" placeholder="Home Phone"></b-form-input>
              </b-form-group>
            </b-col>
                 <b-col sm="10" md="6">
              <b-form-group>
                <label for="name">Mobile Number</label>
                <b-form-input required type="text" v-model="mobilenumber" id="name" placeholder="Mobile Number"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
            <b-row>

            <b-col sm="6">
              <b-form-group>
                <label for="name">Email</label>
                               <b-form-input type="text" v-model="email" id="name" placeholder="Email"></b-form-input>
              </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="lastname">Date of Birth</label>
                <b-form-input type="date" required id="lastname" v-model="birthdate" placeholder="Gender"></b-form-input>
              </b-form-group>
            </b-col>
                      <b-col sm="6">
                 <b-form-group>
                <label for="country">Gender</label>
                   <b-form-select id="country"
                   value="Male"
                   required
                  v-model="gender"
                  :options="['Male','Female','Other']">
                </b-form-select>
              </b-form-group>
            </b-col>
                <b-col sm="6">
                 <b-form-group>
                <label for="country">Marital Status</label>
                   <b-form-select id="country"
                   value="Single"
                  v-model="maritalstatus"
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

                 <b-form-group>
                <label for="country">Department</label>
                   <b-form-select id="country"
                   value=""
                    required
                    :change="event(event)"
                   v-model="department"

                  >
                  <option v-for="deps in dep" :value="deps.id">{{deps.title}}</option>
                </b-form-select>

              </b-form-group>

            </b-col>


            <b-col sm="10" md="6">
               <b-form-group>

                <label for="country">Designation</label>
                   <b-form-select id="country"
                   value="Male"
                   required
                   v-model="designation"

                   >
                   <option v-for="dess in des" :value="dess.designation_id" >{{dess.designation_title}}</option>
                </b-form-select>
               </b-form-group>
            </b-col>
            <b-col sm="6">
              <b-form-group>
                <label for="name">Date of Join</label>
                               <b-form-input type="date" required v-model="dateofjoin" id="name" placeholder="Email"></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>

          <b-row>


            <b-col sm="6">
              <b-form-group>
                <label for="lastname">Employee Type</label>

                   <b-form-select id="country"
                   value="Permanent"
                   v-model="emptype"
                   required
                  :options="['Permanent','Temporary','Contract']">
                </b-form-select>
                 </b-form-group>

            </b-col>
                      <b-col sm="6">
                 <b-form-group>
                <label for="country">Working Place</label>
                   <b-form-select id="country"

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
                 <b-form-file  ref="file-input"  v-on:change="onImageChangeresume"  class="mb-2"></b-form-file>
              </b-form-group>

            </b-col>
                 <b-col sm="12">
              <b-form-group>
                <label for="name">Offer Letter</label>
                 <b-form-file  ref="file-input" class="mb-2" v-on:change="onImageChangeoffer"></b-form-file>
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

             <b-button block variant="success py-2 mb-5" type="submit">Add Employee</b-button>

     </b-form>
    </div>
      </template>






      <script>
          export default {
              data (){
                return{
                    dep:[],
                    des:[],
                    form: new FormData,
                     forms: new FormData,
                      name:[],
                      names:[],
                    emp_id:'',
                    salutation:'',
                    firstname:'',
                    lastname:'',
                     file:null,
                     fileresume:null,
                    line1:'',
                    line2:'',
                    city:'',
                    state:'',
                    country:'',
                     images:this.images,

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
                    resumeimg:'',
                    resume:this.resume,
                    offer:'',
                    offername:'',
                    joining:'',
                    joiningname:'',
                    contract:'',
                    contractname:'',
                    id:'',
                    idname:'',
                    other:'',
                    othername:'',
                    output:''


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
                   
                this.offer = e.target.files[0];
            },
             onImageChangejoining(e){

                 this.joiningname = e.target.files[0].name;
               
                this.joining = e.target.files[0];
            },
             onImageChangecontract(e){

                 this.contractname = e.target.files[0].name;
                  
                this.contract = e.target.files[0];
            },
               onImageChangeid(e){

                 this.idname = e.target.files[0].name;
               
                this.id = e.target.files[0];
            },
               onImageChangeother(e){

                 this.othername = e.target.files[0].name;
                   
                this.other = e.target.files[0];
            },





                   event:function(event){

                           this.$axios.get(this.$apiUrl+'designation/only/' + this.department)
                          .then(res =>{
                            this.des = res.data
                            })
                      }
                    ,



               post(e){


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



                  this.axios
                  .post(this.$apiUrl+'emp/add',{
                      employee_id  : this.emp_id,
                      resume : this.resume,

                      offer:this.offername,
                      joining:this.joiningname,
                      contract:this.contractname,
                      id:this.idname,
                      other:this.othername,
                      salutation : this.salutation,
                      firstname : this.firstname,
                      lastname : this.lastname,
                      address_line1 : this.line1,
                      address_line2 : this.line2,
                      city : this.city,
                      state : this.state,
                      country : this.country,
                      taddress_line1 : this.tline1,
                      taddress_line2 : this.tline2,
                      tcity : this.tcity,
                      tstate : this.tstate,
                      tcountry : this.tcountry,
                      homephone : this.homephone,
                      mobilenumber : this.mobilenumber,
                      email : this.email,
                      birthdate : this.birthdate,
                      gender : this.gender,
                      maritalstatus : this.maritalstatus,
                      department : this.department,
                      departmentgroup : this.departmentgroup,
                      designation : this.designation,
                      dateofjoin : this.dateofjoin,
                      profile : this.name,
                      grade : this.grade,
                      modeofpay : this.modeofpay,
                      bankname : this.bankname,
                      bankacno : this.bankacno,
                      swiftcode : this.swiftcode,




                  }).then(response=>{
                    this.$toast.success('Employee Added!!!');

                     console.log(this.name)
                  })
                  .catch(error =>{
                    this.output = error.output
                  })
             }





          },
          mounted(){
          this.$axios.get(this.$apiUrl+'department/only')
          .then(res =>{
            this.dep = res.data
            })
            .catch(error => {
              this.output = error.data
            })
      },


          }




      </script>


















<style>


.toast-header i{

  display: none
}
</style>
