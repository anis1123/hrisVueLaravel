(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-5d0007bb"],{"04cc":function(t,e,n){"use strict";var s=n("84bb"),i=n.n(s);i.a},"28cc":function(t,e,n){"use strict";n.r(e);var s=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("Toasts",{attrs:{rtl:!0,"max-messages":7,"time-out":3e3}}),n("b-col",{staticClass:"px-5 mt-5",attrs:{sm:"12"}},[n("b-card",[n("div",{attrs:{slot:"header"},slot:"header"},[n("strong",[t._v(" Add Designation")]),n("small",[t._v(" Form")])]),n("b-row",[n("b-col",{attrs:{sm:"12"}},[n("b-form-group",[n("label",{attrs:{for:""}},[t._v("Select Department")]),n("b-form-select",{attrs:{required:""},model:{value:t.dep,callback:function(e){t.dep=e},expression:"dep"}},t._l(t.only,function(e){return n("option",{domProps:{value:e.id}},[t._v("  "+t._s(e.title))])}),0)],1),n("b-form-group",[n("label",{attrs:{for:"ccnumber"}},[t._v("Add Designation ")]),n("b-form-input",{attrs:{type:"text",placeholder:"Enter Your Designation",required:""},model:{value:t.designation,callback:function(e){t.designation=e},expression:"designation"}})],1)],1)],1),n("b-button",{attrs:{block:"",variant:"success py-1"},on:{click:t.post}},[t._v("Add Designation")])],1)],1)],1)},i=[],o={data:function(){return{only:"",dep:"",designation:""}},mounted:function(){var t=this;this.$axios.get("http://127.0.0.1:8000/api/department/only").then(function(e){t.only=e.data})},methods:{post:function(t){var e=this;""==this.designation||""==this.dep?alert("please fill all!!!"):(t.preventDefault(),this.$axios.post("http://127.0.0.1:8000/api/designation/add",{department_id:this.dep,designation:this.designation}).then(function(t){e.designation="",e.$toast.success("Designation Added!!!")}))}}},a=o,r=(n("04cc"),n("2877")),d=Object(r["a"])(a,s,i,!1,null,null,null);e["default"]=d.exports},"84bb":function(t,e,n){}}]);
//# sourceMappingURL=chunk-5d0007bb.b9f66271.js.map