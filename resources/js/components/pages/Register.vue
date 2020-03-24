<template>
  <div class="app flex-row align-items-center">

    <div class="container">

      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form @submit="post">
                <h1>Register</h1>
                <p class="text-muted">Create your account</p>

               <p class="text-danger">{{output}}</p>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-user"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="text" class="form-control" placeholder="Username" autocomplete="username" v-model="username" disabled/>
                </b-input-group>

                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>@</b-input-group-text>
                  </b-input-group-prepend>

                  <b-form-input type="text" class="form-control" placeholder="Email" autocomplete="email" v-model="emp_email"/>
                </b-input-group>
                   <input type="hidden" name="_token" :value="csrf">
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="password" class="form-control" placeholder="Password" autocomplete="new-password" v-model="password"/>
                </b-input-group>

                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input type="password" class="form-control" placeholder="Repeat password" autocomplete="new-password" v-model="confirmPassword"/>
                </b-input-group>

                <b-button variant="success" type="submit" block>Register</b-button>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </div>


  </div>
</template>

<script>


export default {


  name: 'Register',

  data(){
    return{
      username:'',
      email:'',
      password:'',
      confirmPassword:'',
      output:'',
      csrf: "",
      emp_id:'',
      emp_email:''
    }
  },
  mounted(){

  this.username = localStorage.getItem('emp_id')



  this.axios
  .get('http://127.0.0.1:8000/api/employee/emp_id/' + this.emp_id)
  .then(res =>{
    this.emp_email = res.data;
  })


  },
  watch:{
    emp_email(email){
    localStorage.emp_email = (email)
    }
  }
  ,

  methods:{
    post(e){

      e.preventDefault();

      if(this.password == this.confirmPassword){
        this.axios
        .post('http://127.0.0.1:8000/register',{
            name:this.username,
            email:this.emp_email,
            password:this.password,

            password_confirmation:this.confirmPassword
        })
        .then(res => {
          this.$router.push('login')


        })

      }
    }
  }
}
</script>
