<template>

  <div class="container ">

      <Toasts
    :rtl="true"
    :max-messages="7"
    :time-out="3000"
></Toasts>

       <b-card>
          <div slot="header">
            <strong>General Setting</strong> <small> Form</small>
          </div>

      <b-form @submit="post" enctype="multipart/form-data">



          <div class="row p-5">


                <div class="col-md-4 pb-3 text-right">
                  <label for="">Company Logo</label>
                </div>
                <div class="col-md-8 pb-3">
                                  <img :src="'http://localhost/hrmsystem/storage/app/public/' + data.company_logo"  height="60">

                 <input type="file" class="col-md-5"  v-on:change="onImageChange"  >
                </div>

                <div class="col-md-4 pb-3 text-right">
                  <label for="">Company Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-5 pb-3">
                    <input type="text" class="form-control" v-model="data.company_name" placeholder="Company Name">
                </div>
                  <div class="col-md-4 pb-3 text-right">
                  <label for="">Company Address</label>
                </div>
                <div class="col-md-5 pb-3">
                    <input type="text" v-model="data.company_address" placeholder="Company Address" class="form-control">
                </div>

                  <div class="col-md-4 pb-3 text-right">
                  <label for="">Country</label>
                </div>
                <div class="col-md-5 pb-3">
                    <select v-model="data.country" class="form-control">
                      <option  selected="selected" :value="data.country" >{{data.country}}</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Nepal">India</option>
                      <option value="Nepal">USA</option>

                    </select>
                </div>
                  <div class="col-md-4 pb-3 text-right">
                  <label for="">Phone</label>
                </div>
                <div class="col-md-5 pb-3">
                    <input type="number" v-model="data.phone" placeholder="Company Phone" class="form-control">
                </div>
                  <div class="col-md-4 pb-3 text-right">
                  <label for="">Company Email</label>
                </div>
                <div class="col-md-5 pb-3">
                    <input type="text" v-model="data.email" placeholder="Company Email" class="form-control">
                </div>
                  <div class="col-md-4 pb-3 text-right">
                  <label for="">Contact Person Name</label>
                </div>
                <div class="col-md-5 pb-3">
                    <input type="text" v-model="data.contact_person" placeholder="Contact Person Name" class="form-control">
                </div>
                  <div class="col-md-4 pb-3 text-right">
                  <label for="">Currency</label>
                </div>
                <div class="col-md-5 pb-3">

                    <select type="text" v-model="data.currency" class="form-control">
                      <option value="" disabled selected="selected">Select Currency</option>
                      <option value="Rs.">Nepali Currency (Rs)</option>
                       <option value="INR.">Indian Currency (INR)</option>
                       <option value="USD.">American Currency (USD)</option>
                    </select>
                </div>







          </div>
            <hr>
            <div class="text-center">
            <b-button variant="success" type="submit">Update</b-button>
            </div>
      </b-form>
      </b-card>
    </div>



</template>


<script>
  export default {

    data(){
        return{
          images:this.images,
          forms: new FormData,
          name:'',
          data:'',
          company_name:'',
          company_address:'',
          country:'',
          phone:'',
          email:'',
          contact_person:'',
          company_logo:'',
          currency:''
        }
    },
    computed:{

    },
    mounted()
    {

        this.axios
        .get('http://127.0.0.1:8000/api/company/get')
        .then(res=>{
          this.data = res.data;
        })
    },

    methods:{

          onImageChange(e) {



                      this.name = e.target.files[0].name;
                     let image = e.target.files[0];
                     let form = new FormData();
                     form.append('logo',image);
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
                     },



                     post(e){


                       e.preventDefault();

                       if(this.name == '' ){
                         this.name=this.data.company_logo
                       }


                  this.axios
                  .patch('http://127.0.0.1:8000/api/company',{

                    company_name :this.data.company_name,
                    company_address:this.data.company_address,
                    country:this.data.country,
                    phone:this.data.phone,
                    email:this.data.email,
                    contact_person:this.data.contact_person,
                    currency:this.data.currency,
                    company_logo:this.name

                  }).then(res=>{
                      this.$toast.success('Company Information Updated!!!');
                      this.$router.push('/')
                  })

                    this.axios
                .post('http://127.0.0.1:8000/api/company/logo',
                  this.file
                  )
                .then(res => {

                    this.data = res.data;
                    console.log(res.data);
                     this.name='';




                })

                 },

    }
  }
</script>

<style>


.toast-header i{

  display: none
}
</style>

