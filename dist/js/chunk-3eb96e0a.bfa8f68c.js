(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-3eb96e0a"],{"7f7f":function(t,e,n){var a=n("86cc").f,o=Function.prototype,c=/^\s*function ([^ (]*)/,r="name";r in o||n("9e1e")&&a(o,r,{configurable:!0,get:function(){try{return(""+this).match(c)[1]}catch(t){return""}}})},ec87:function(t,e,n){"use strict";n.r(e);var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-card",{attrs:{header:"Excel Import"}},[t._v("\n    "+t._s(t.output)+"\n    "),n("b-form",{attrs:{enctype:"multipart/form-data"},on:{submit:t.post}},[n("b-row",[n("b-col",{attrs:{sm:"6"}},[n("b-form-file",{ref:"file-input",staticClass:"mb-2",on:{change:t.onImageChangeexcel}})],1),n("b-col",[n("b-btn",{attrs:{type:"submit",variant:"primary"}},[t._v("Import")])],1)],1)],1)],1)},o=[],c=(n("7f7f"),{data:function(){return{excel:"",output:"",success:""}},mounted:function(){},methods:{onImageChangeexcel:function(t){this.excelname=t.target.files[0].name,console.log(this.excel),this.excel=t.target.files[0]},post:function(t){var e={headers:{"content-type":"multipart/form-data"}};t.preventDefault();var n=new FormData;n.append("excel",this.excel),this.axios.post("http://127.0.0.1:8000/api/excel",n,e).then(function(t){console.log(res.data)})}}}),r=c,s=n("2877"),i=Object(s["a"])(r,a,o,!1,null,null,null);e["default"]=i.exports}}]);
//# sourceMappingURL=chunk-3eb96e0a.bfa8f68c.js.map