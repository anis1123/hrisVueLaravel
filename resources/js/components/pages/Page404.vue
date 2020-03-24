<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="12 text-center">
          <div class="clearfix">

            <h4 class="pt-3">Your verification link has been sent to your <a href="https://mail.google.com/mail/"> {{a}} </a></h4>

          </div>

        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Page404',

  data(){
    return{
      a:''
    }
  }
  ,
  mounted(){

    this.a = localStorage.getItem('emp_email')

  }
}
</script>
