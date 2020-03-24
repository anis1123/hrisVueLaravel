<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card no-body class="p-4">
              <b-card-body>
                <b-form @submit="login">
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                   <b-input-group class="mb-3">
                    <b-input-group-prepend><b-input-group-text><i class="icon-user"></i></b-input-group-text></b-input-group-prepend>
                    <b-form-input type="text" class="form-control" placeholder="Employee ID" autocomplete="username email" v-model="emp_id" />

                  </b-input-group>
                 <b-input-group class="" v-if="status1 == true">
                    <b-input-group-prepend><b-input-group-text><i class="icon-lock"></i></b-input-group-text></b-input-group-prepend>
                    <b-form-input type="password" class="form-control" placeholder="Password" autocomplete="current-password" v-model="password"  />
                  </b-input-group>
                    <p class="text-danger">{{output}}</p>


                  <b-row>
                    <b-col cols="6">

                      <b-button variant="primary" class="px-4 mt-2" @click="login" v-if="userExists==false">Login</b-button>
                      <b-button variant="primary" class="px-4 mt-2" @click="loginuser" v-if="userexi==false">Login</b-button>
                    </b-col>
                    <b-col cols="6" class="text-right">
                      <!-- <b-button variant="link" to="/employeelogin" class="px-0">Login As Employee?</b-button> -->
                    </b-col>
                  </b-row>
                </b-form>
              </b-card-body>
            </b-card>
            <b-card no-body class="text-white bg-primary d-md-down-none" style="width:44%">
              <b-card-body class="text-center">
                <div>
                  <h2> <img :src="'http://localhost/hrmsystem/storage/app/public/' + data.company_logo"  height="60"></h2>
                  <p>{{data.company_name}}</p>
                  <p>{{data.company_address}}, {{data.country}}</p>

                  <!-- <b-button variant="primary" class="active mt-3">Register Now!</b-button> -->
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data(){
    return{
      userExists:false,
      userexi:true,
      emp_id:'',
       status1:false,
      email:'',
      password:'',
      data:'',
      output:'',
      datas:'',
      status:'',
      g:''

    }
  },

  mounted(){

    this.$axios.get('http://127.0.0.1:8000/api/employee/get')
      .then(res => {
        this.emp = res.data;
      }).catch(err =>{
        this.output = err.data
      }),

    this.g = localStorage.getItem('emp_id')
    this.axios
        .get('http://127.0.0.1:8000/api/company/get')
        .then(res=>{
          this.data = res.data;
        })
           this.email = localStorage.setItem('email')
  },

  watch:{
      emp_id(emp_id){
        localStorage.emp_id = (emp_id)
      }
  },

  methods:{

    loginuser(){

        this.axios


          this.axios.post('http://127.0.0.1:8000/oauth/token',{
                grant_type:"password",
                client_id:4,
                client_secret:"A1WoeU67u3dFF4ZeEkJPhG1aBRvMysLFrHjGq7ro",
                username :this.emp_id,
                password:this.password,


              })
              .then(response => {
                this.$auth.setToken(response.data.access_token,response.data.expires_in + Date.now());

                this.$router.push("/dashboard/employee")




              }).catch(err => {
                this.output = "Login Failed"
              })




    },

     login (e){
       e.preventDefault();

          this.axios
       .get('http://127.0.0.1:8000/api/usersID/' + this.emp_id)
       .then(res => {
          this.id = res.data;
          this.process()
       })



     },

     process(){

  this.axios
        .post('http://127.0.0.1:8000/api/emp_id/check/'+ this.emp_id)
        .then(res =>{

            if(res.data == 200)
            {
              if(this.id){
                this.status1 = true;
                this.userExists = true;
                this.userexi = false
              }else{
                this.$router.push("/register")
              }


              // this.emp_id = localStorage.setItem('emp_id');
            }else{
              this.output = "Your EmployeeID does not Exists"
            }
        })


     },




},

}

</script>
