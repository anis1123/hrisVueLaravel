<template>
    <div >
      <head>
  <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
</head>


  <b-card header="All Department">

    <b-col sm="12" class="">

      <div v-for="deps in dep" sm="12">

         <div v-for="(d,item) in deps" sm="12">
            <div class="text-left bg-dark "><h4 class="p-2">Department: <span class="text-light">{{d.department}}</span></h4></div>

                  <div class="thead-dark bg-light text-primary pt-0 mt-0 pl-5">
                  <tr width="100">
                  <div class="p-3 px-4"><strong>SN</strong></div>
                  <th width="100" > &nbsp;  &nbsp; Designation</th>
                  </tr>
                  </div>
        <div v-for="(desi,item) in d.designation" sm="12">

              <div class="pl-4 bg-light my-3">
                <tr>
                <div class="px-5 pt-3">&nbsp;{{item}}</div>
            <td width="100" ><p>{{desi.designation_title}}</p></td>
               </tr>
            </div>



        </div>


      </div>

      </div>

    </b-col>
</b-card>
    </div>
</template>


<script>
  export default {
      data(){


        return{

          dep:'',
          hello:''



        }



      },
      mounted(){
          this.$axios.get('http://127.0.0.1:8000/api/department/get')
          .then(res =>{
            this.dep = res.data
            })


      },
      methods:{


      }
  }

</script>

<style>
    ul li{
      list-style: none
    }

</style>
