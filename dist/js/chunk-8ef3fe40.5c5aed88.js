(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-8ef3fe40"],{1369:function(t,a,e){"use strict";var o=e("eaab"),s=e.n(o);s.a},"742e":function(t,a,e){"use strict";e.r(a);var o=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"container "},[e("Toasts",{attrs:{rtl:!0,"max-messages":7,"time-out":3e3}}),e("b-card",[e("div",{attrs:{slot:"header"},slot:"header"},[e("strong",[t._v("General Setting")]),e("small",[t._v(" Form")])]),e("b-form",{attrs:{enctype:"multipart/form-data"},on:{submit:t.post}},[e("div",{staticClass:"row p-5"},[e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Company Logo")])]),e("div",{staticClass:"col-md-8 pb-3"},[e("img",{attrs:{src:"http://localhost/hrmsystem/storage/app/public/"+t.data.company_logo,height:"60"}}),e("input",{staticClass:"col-md-5",attrs:{type:"file"},on:{change:t.onImageChange}})]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Company Name "),e("span",{staticClass:"text-danger"},[t._v("*")])])]),e("div",{staticClass:"col-md-5 pb-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.company_name,expression:"data.company_name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Company Name"},domProps:{value:t.data.company_name},on:{input:function(a){a.target.composing||t.$set(t.data,"company_name",a.target.value)}}})]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Company Address")])]),e("div",{staticClass:"col-md-5 pb-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.company_address,expression:"data.company_address"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Company Address"},domProps:{value:t.data.company_address},on:{input:function(a){a.target.composing||t.$set(t.data,"company_address",a.target.value)}}})]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Country")])]),e("div",{staticClass:"col-md-5 pb-3"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.data.country,expression:"data.country"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){var a="_value"in t?t._value:t.value;return a});t.$set(t.data,"country",a.target.multiple?e:e[0])}}},[e("option",{attrs:{selected:"selected"},domProps:{value:t.data.country}},[t._v(t._s(t.data.country))]),e("option",{attrs:{value:"Nepal"}},[t._v("Nepal")]),e("option",{attrs:{value:"Nepal"}},[t._v("India")]),e("option",{attrs:{value:"Nepal"}},[t._v("USA")])])]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Phone")])]),e("div",{staticClass:"col-md-5 pb-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.phone,expression:"data.phone"}],staticClass:"form-control",attrs:{type:"number",placeholder:"Company Phone"},domProps:{value:t.data.phone},on:{input:function(a){a.target.composing||t.$set(t.data,"phone",a.target.value)}}})]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Company Email")])]),e("div",{staticClass:"col-md-5 pb-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.email,expression:"data.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Company Email"},domProps:{value:t.data.email},on:{input:function(a){a.target.composing||t.$set(t.data,"email",a.target.value)}}})]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Contact Person Name")])]),e("div",{staticClass:"col-md-5 pb-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.contact_person,expression:"data.contact_person"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Contact Person Name"},domProps:{value:t.data.contact_person},on:{input:function(a){a.target.composing||t.$set(t.data,"contact_person",a.target.value)}}})]),e("div",{staticClass:"col-md-4 pb-3 text-right"},[e("label",{attrs:{for:""}},[t._v("Currency")])]),e("div",{staticClass:"col-md-5 pb-3"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.data.currency,expression:"data.currency"}],staticClass:"form-control",attrs:{type:"text"},on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){var a="_value"in t?t._value:t.value;return a});t.$set(t.data,"currency",a.target.multiple?e:e[0])}}},[e("option",{attrs:{value:"",disabled:"",selected:"selected"}},[t._v("Select Currency")]),e("option",{attrs:{value:"Rs."}},[t._v("Nepali Currency (Rs)")]),e("option",{attrs:{value:"INR."}},[t._v("Indian Currency (INR)")]),e("option",{attrs:{value:"USD."}},[t._v("American Currency (USD)")])])])]),e("hr"),e("div",{staticClass:"text-center"},[e("b-button",{attrs:{variant:"success",type:"submit"}},[t._v("Update")])],1)])],1)],1)},s=[],n=(e("7f7f"),{data:function(){return{images:this.images,forms:new FormData,name:"",data:"",company_name:"",company_address:"",country:"",phone:"",email:"",contact_person:"",company_logo:"",currency:""}},computed:{},mounted:function(){var t=this;this.axios.get("http://127.0.0.1:8000/api/company/get").then(function(a){t.data=a.data})},methods:{onImageChange:function(t){this.name=t.target.files[0].name;var a=t.target.files[0],e=new FormData;e.append("logo",a),this.file=e,this.read(a)},read:function(t){var a=this,e=new FileReader;e.readAsDataURL(t),e.onload=function(t){a.images=t.target.result}},post:function(t){var a=this;t.preventDefault(),""==this.name&&(this.name=this.data.company_logo),this.axios.patch("http://127.0.0.1:8000/api/company",{company_name:this.data.company_name,company_address:this.data.company_address,country:this.data.country,phone:this.data.phone,email:this.data.email,contact_person:this.data.contact_person,currency:this.data.currency,company_logo:this.name}).then(function(t){a.$toast.success("Company Information Updated!!!"),a.$router.push("/")}),this.axios.post("http://127.0.0.1:8000/api/company/logo",this.file).then(function(t){a.data=t.data,console.log(t.data),a.name=""})}}}),r=n,i=(e("1369"),e("2877")),c=Object(i["a"])(r,o,s,!1,null,null,null);a["default"]=c.exports},"7f7f":function(t,a,e){var o=e("86cc").f,s=Function.prototype,n=/^\s*function ([^ (]*)/,r="name";r in s||e("9e1e")&&o(s,r,{configurable:!0,get:function(){try{return(""+this).match(n)[1]}catch(t){return""}}})},eaab:function(t,a,e){}}]);
//# sourceMappingURL=chunk-8ef3fe40.5c5aed88.js.map