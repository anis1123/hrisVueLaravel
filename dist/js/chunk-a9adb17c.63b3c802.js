(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-a9adb17c"],{"7f7f":function(t,a,s){var i=s("86cc").f,e=Function.prototype,r=/^\s*function ([^ (]*)/,l="name";l in e||s("9e1e")&&i(e,l,{configurable:!0,get:function(){try{return(""+this).match(r)[1]}catch(t){return""}}})},e8c5:function(t,a,s){"use strict";s.r(a);var i=function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"app"},[s("AppHeader",{attrs:{fixed:""}},[s("SidebarToggler",{staticClass:"d-lg-none",attrs:{display:"md",mobile:""}}),s("b-link",{staticClass:"navbar-brand",attrs:{to:"#"}},[s("div",{staticClass:"navbar-brand-full"},[s("img",{attrs:{src:"http://localhost/hrmsystem/storage/app/public/"+t.data.company_logo,height:"10",width:"40",alt:"company Logo"}})]),s("h4",{staticClass:"navbar-brand-minimized"},[s("strong",[t._v("HRM")])])]),s("SidebarToggler",{staticClass:"d-md-down-none",attrs:{display:"lg"}}),s("b-navbar-nav",{staticClass:"d-md-down-none"},[s("b-nav-item",{staticClass:"px-3",attrs:{to:"/dashboard"}},[t._v("Dashboard")])],1),s("b-navbar-nav",{staticClass:"ml-auto"},[s("DefaultHeaderDropdownAccnt")],1),s("AsideToggler",{staticClass:"d-none d-lg-block"})],1),s("div",{staticClass:"app-body"},[s("AppSidebar",{attrs:{fixed:""}},[s("SidebarHeader"),s("SidebarForm"),s("SidebarNav",{attrs:{navItems:t.nav}}),s("SidebarFooter"),s("SidebarMinimizer")],1),s("main",{staticClass:"main"},[s("Breadcrumb",{attrs:{list:t.list}}),s("div",{staticClass:"container-fluid"},[s("router-view")],1)],1),s("AppAside",{attrs:{fixed:""}},[s("DefaultAside")],1)],1),s("TheFooter",[s("div",[s("a",{attrs:{href:""}},[t._v("HRM")]),s("span",{staticClass:"ml-1"},[t._v("© 2018 "+t._s(t.data.company_name))])])])],1)},e=[],r=(s("7f7f"),{item:[{name:"Dashboard",url:"/dashboard/employee",icon:"icon-speedometer",badge:{variant:"primary"}},{title:!0,name:"Self",class:"",wrapper:{element:"",attributes:{}}},{name:"Payroll",url:"/payroll",icon:"icon-credit-card",children:[{name:"Payslip Record",url:"/payroll/emppayslip"}]}],items:[{name:"Dashboard",url:"/dashboard",icon:"icon-speedometer",badge:{variant:"primary"}},{title:!0,name:"People",class:"",wrapper:{element:"",attributes:{}}},{name:"Employees",url:"/employee",icon:"icon-user",children:[{url:"/employee/all",name:" All Employees"},{url:"/employee/add",name:" Add Employee"},{url:"/employee/excel",name:"Excel Import"}]},{name:"Attendance",url:"/attendance",icon:"icon-people",children:[{url:"/attendance/mark",name:"Mark Attendance"},{url:"/attendance/view",name:" View Attendance"}]},{name:"Department",url:"/department",icon:"icon-list",children:[{name:"All Department",url:"/department/all"},{name:"Add Department",url:"/department/add"},{name:"Add Designation",url:"/department/designation-add"}]},{title:!0,name:"HR",class:"",wrapper:{element:"",attributes:{}}},{name:"Payroll",url:"/payroll",icon:"icon-credit-card",children:[{name:"Generate Payslip",url:"/payroll/salary-detail"},{name:"Payroll Record",url:"/payroll/record"},{name:" Payslip",url:"/payroll/payslip"}]},{name:"Report",url:"/report",icon:"icon-credit-card",children:[{name:"Employee Report",url:"/report/employee-report"},{name:"Payroll Record",url:"/payroll/record"},{name:" Payslip",url:"/payroll/payslip"}]},{title:!0,name:"Setting",class:"",wrapper:{element:"",attributes:{}}},{name:"General Setting",url:"/setting/general",icon:"icon-settings"},{title:!0,name:"Theme",class:"",wrapper:{element:"",attributes:{}}},{name:"Colors",url:"/theme/colors",icon:"icon-drop"},{name:"Typography",url:"/theme/typography",icon:"icon-pencil"},{title:!0,name:"Components",class:"",wrapper:{element:"",attributes:{}}},{name:"Base",url:"/base",icon:"icon-puzzle",children:[{name:"Breadcrumbs",url:"/base/breadcrumbs",icon:"icon-puzzle"},{name:"Cards",url:"/base/cards",icon:"icon-puzzle"},{name:"Carousels",url:"/base/carousels",icon:"icon-puzzle"},{name:"Collapses",url:"/base/collapses",icon:"icon-puzzle"},{name:"Forms",url:"/base/forms",icon:"icon-puzzle"},{name:"Jumbotrons",url:"/base/jumbotrons",icon:"icon-puzzle"},{name:"List Groups",url:"/base/list-groups",icon:"icon-puzzle"},{name:"Navs",url:"/base/navs",icon:"icon-puzzle"},{name:"Navbars",url:"/base/navbars",icon:"icon-puzzle"},{name:"Paginations",url:"/base/paginations",icon:"icon-puzzle"},{name:"Popovers",url:"/base/popovers",icon:"icon-puzzle"},{name:"Progress Bars",url:"/base/progress-bars",icon:"icon-puzzle"},{name:"Switches",url:"/base/switches",icon:"icon-puzzle"},{name:"Tables",url:"/base/tables",icon:"icon-puzzle"},{name:"Tabs",url:"/base/tabs",icon:"icon-puzzle"},{name:"Tooltips",url:"/base/tooltips",icon:"icon-puzzle"}]},{name:"Buttons",url:"/buttons",icon:"icon-cursor",children:[{name:"Buttons",url:"/buttons/standard-buttons",icon:"icon-cursor"},{name:"Button Dropdowns",url:"/buttons/dropdowns",icon:"icon-cursor"},{name:"Button Groups",url:"/buttons/button-groups",icon:"icon-cursor"},{name:"Brand Buttons",url:"/buttons/brand-buttons",icon:"icon-cursor"}]},{name:"Charts",url:"/charts",icon:"icon-pie-chart"},{name:"Icons",url:"/icons",icon:"icon-star",children:[{name:"CoreUI Icons",url:"/icons/coreui-icons",icon:"icon-star",badge:{variant:"info",text:"NEW"}},{name:"Flags",url:"/icons/flags",icon:"icon-star"},{name:"Font Awesome",url:"/icons/font-awesome",icon:"icon-star",badge:{variant:"secondary",text:"4.7"}},{name:"Simple Line Icons",url:"/icons/simple-line-icons",icon:"icon-star"}]},{name:"Notifications",url:"/notifications",icon:"icon-bell",children:[{name:"Alerts",url:"/notifications/alerts",icon:"icon-bell"},{name:"Badges",url:"/notifications/badges",icon:"icon-bell"},{name:"Modals",url:"/notifications/modals",icon:"icon-bell"}]},{name:"Widgets",url:"/widgets",icon:"icon-calculator",badge:{variant:"primary",text:"NEW"}},{divider:!0},{title:!0,name:"Extras"},{name:"Login",url:"/login",icon:"icon-star"},{name:"Pages",url:"/pages",icon:"icon-star",children:[{name:"Login",url:"/login",icon:"icon-star"},{name:"Register",url:"/pages/register",icon:"icon-star"},{name:"Verify Email",url:"/pages/verify/email",icon:"icon-star"},{name:"Error 500",url:"/pages/500",icon:"icon-star"}]},{name:"Disabled",url:"/dashboard",icon:"icon-ban",badge:{variant:"secondary",text:"NEW"},attributes:{hidden:!1}}],mounted:function(){this.items=!1}}),l=s("f1fb"),o=function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("b-tabs",[s("b-tab",[s("template",{slot:"title"},[s("i",{staticClass:"icon-list"})]),s("b-list-group",{staticClass:"list-group-accent"},[s("b-list-group-item",{staticClass:"list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small"},[t._v("\n        Today\n      ")]),s("b-list-group-item",{staticClass:"list-group-item-accent-warning list-group-item-divider",attrs:{href:"#"}},[s("div",{staticClass:"avatar float-right"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",[t._v("Meeting with\n          "),s("strong",[t._v("Lucas")])]),s("small",{staticClass:"text-muted mr-3"},[s("i",{staticClass:"icon-calendar"}),t._v("  1 - 3pm\n        ")]),s("small",{staticClass:"text-muted"},[s("i",{staticClass:"icon-location-pin"}),t._v("  Palo Alto, CA\n        ")])]),s("b-list-group-item",{staticClass:"list-group-item-accent-info",attrs:{href:"#"}},[s("div",{staticClass:"avatar float-right"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/4.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",[t._v("Skype with "),s("strong",[t._v("Megan")])]),s("small",{staticClass:"text-muted mr-3"},[s("i",{staticClass:"icon-calendar"}),t._v("  4 - 5pm")]),s("small",{staticClass:"text-muted"},[s("i",{staticClass:"icon-social-skype"}),t._v("  On-line")])]),s("hr",{staticClass:"transparent mx-3 my-0"}),s("b-list-group-item",{staticClass:"list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small"},[t._v("\n        Tomorrow\n      ")]),s("b-list-group-item",{staticClass:"list-group-item-accent-danger list-group-item-divider",attrs:{href:"#"}},[s("div",[t._v("New UI Project - "),s("strong",[t._v("deadline")])]),s("small",{staticClass:"text-muted mr-3"},[s("i",{staticClass:"icon-calendar"}),t._v("  10 - 11pm")]),s("small",{staticClass:"text-muted"},[s("i",{staticClass:"icon-home"}),t._v("  creativeLabs HQ")]),s("div",{staticClass:"avatars-stack mt-2"},[s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/2.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/3.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/4.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/5.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/6.jpg",alt:"admin@bootstrapmaster.com"}})])])]),s("b-list-group-item",{staticClass:"list-group-item-accent-success list-group-item-divider",attrs:{href:"#"}},[s("div",[s("strong",[t._v("#10 Startups.Garden")]),t._v(" Meetup")]),s("small",{staticClass:"text-muted mr-3"},[s("i",{staticClass:"icon-calendar"}),t._v("  1 - 3pm")]),s("small",{staticClass:"text-muted"},[s("i",{staticClass:"icon-location-pin"}),t._v("  Palo Alto, CA")])]),s("b-list-group-item",{staticClass:"list-group-item-accent-primary list-group-item-divider",attrs:{href:"#"}},[s("div",[s("strong",[t._v("Team meeting")])]),s("small",{staticClass:"text-muted mr-3"},[s("i",{staticClass:"icon-calendar"}),t._v("  4 - 6pm")]),s("small",{staticClass:"text-muted"},[s("i",{staticClass:"icon-home"}),t._v("  creativeLabs HQ")]),s("div",{staticClass:"avatars-stack mt-2"},[s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/2.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/3.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/4.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/5.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/6.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}})]),s("div",{staticClass:"avatar avatar-xs"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/8.jpg",alt:"admin@bootstrapmaster.com"}})])])])],1)],2),s("b-tab",[s("template",{slot:"title"},[s("i",{staticClass:"icon-speech"})]),s("div",{staticClass:"p-3"},[s("div",{staticClass:"message"},[s("div",{staticClass:"py-3 pb-5 mr-3 float-left"},[s("div",{staticClass:"avatar"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}}),s("b-badge",{staticClass:"avatar-status",attrs:{variant:"success"}})],1)]),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lukasz Holeczek")]),s("small",{staticClass:"text-muted float-right mt-1"},[t._v("1:52 PM")])]),s("div",{staticClass:"text-truncate font-weight-bold"},[t._v("Lorem ipsum dolor sit amet")]),s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...")])]),s("hr"),s("div",{staticClass:"message"},[s("div",{staticClass:"py-3 pb-5 mr-3 float-left"},[s("div",{staticClass:"avatar"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}}),s("b-badge",{staticClass:"avatar-status",attrs:{variant:"danger"}})],1)]),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lukasz Holeczek")]),s("small",{staticClass:"text-muted float-right mt-1"},[t._v("1:52 PM")])]),s("div",{staticClass:"text-truncate font-weight-bold"},[t._v("Lorem ipsum dolor sit amet")]),s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...")])]),s("hr"),s("div",{staticClass:"message"},[s("div",{staticClass:"py-3 pb-5 mr-3 float-left"},[s("div",{staticClass:"avatar"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}}),s("b-badge",{staticClass:"avatar-status",attrs:{variant:"info"}})],1)]),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lukasz Holeczek")]),s("small",{staticClass:"text-muted float-right mt-1"},[t._v("1:52 PM")])]),s("div",{staticClass:"text-truncate font-weight-bold"},[t._v("Lorem ipsum dolor sit amet")]),s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...")])]),s("hr"),s("div",{staticClass:"message"},[s("div",{staticClass:"py-3 pb-5 mr-3 float-left"},[s("div",{staticClass:"avatar"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}}),s("b-badge",{staticClass:"avatar-status",attrs:{variant:"warning"}})],1)]),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lukasz Holeczek")]),s("small",{staticClass:"text-muted float-right mt-1"},[t._v("1:52 PM")])]),s("div",{staticClass:"text-truncate font-weight-bold"},[t._v("Lorem ipsum dolor sit amet")]),s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...")])]),s("hr"),s("div",{staticClass:"message"},[s("div",{staticClass:"py-3 pb-5 mr-3 float-left"},[s("div",{staticClass:"avatar"},[s("img",{staticClass:"img-avatar",attrs:{src:"img/avatars/7.jpg",alt:"admin@bootstrapmaster.com"}}),s("b-badge",{staticClass:"avatar-status",attrs:{variant:"dark"}})],1)]),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lukasz Holeczek")]),s("small",{staticClass:"text-muted float-right mt-1"},[t._v("1:52 PM")])]),s("div",{staticClass:"text-truncate font-weight-bold"},[t._v("Lorem ipsum dolor sit amet")]),s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...")])])])],2),s("b-tab",[s("template",{slot:"title"},[s("i",{staticClass:"icon-settings"})]),s("div",{staticClass:"p-3"},[s("h6",[t._v("Settings")]),s("div",{staticClass:"aside-options"},[s("div",{staticClass:"clearfix mt-4"},[s("small",[s("b",[t._v("Option 1")])]),s("c-switch",{staticClass:"float-right",attrs:{color:"success",label:"",variant:"pill",size:"sm",checked:""}})],1),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.")])])]),s("div",{staticClass:"aside-options"},[s("div",{staticClass:"clearfix mt-3"},[s("small",[s("b",[t._v("Option 2")])]),s("c-switch",{staticClass:"float-right",attrs:{color:"success",label:"",variant:"pill",size:"sm"}})],1),s("div",[s("small",{staticClass:"text-muted"},[t._v("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.")])])]),s("div",{staticClass:"aside-options"},[s("div",{staticClass:"clearfix mt-3"},[s("small",[s("b",[t._v("Option 3")])]),s("c-switch",{staticClass:"float-right",attrs:{color:"success",label:"",variant:"pill",size:"sm",disabled:"",defaultChecked:""}})],1),s("div",[s("small",{staticClass:"text-muted"},[t._v("Disabled option.")])])]),s("div",{staticClass:"aside-options"},[s("div",{staticClass:"clearfix mt-3"},[s("small",[s("b",[t._v("Option 4")])]),s("c-switch",{staticClass:"float-right",attrs:{color:"success",label:"",variant:"pill",size:"sm",checked:""}})],1)]),s("hr"),s("h6",[t._v("System Utilization")]),s("div",{staticClass:"text-uppercase mb-1 mt-4"},[s("small",[s("b",[t._v("CPU Usage")])])]),s("b-progress",{staticClass:"progress-xs",attrs:{height:"{}",variant:"info",value:25}}),s("small",{staticClass:"text-muted"},[t._v("348 Processes. 1/4 Cores.")]),s("div",{staticClass:"text-uppercase mb-1 mt-2"},[s("small",[s("b",[t._v("Memory Usage")])])]),s("b-progress",{staticClass:"progress-xs",attrs:{height:"{}",variant:"warning",value:70}}),s("small",{staticClass:"text-muted"},[t._v("11444GB/16384MB")]),s("div",{staticClass:"text-uppercase mb-1 mt-2"},[s("small",[s("b",[t._v("SSD 1 Usage")])])]),s("b-progress",{staticClass:"progress-xs",attrs:{height:"{}",variant:"danger",value:95}}),s("small",{staticClass:"text-muted"},[t._v("243GB/256GB")]),s("div",{staticClass:"text-uppercase mb-1 mt-2"},[s("small",[s("b",[t._v("SSD 2 Usage")])])]),s("b-progress",{staticClass:"progress-xs",attrs:{height:"{}",variant:"success",value:10}}),s("small",{staticClass:"text-muted"},[t._v("25GB/256GB")])],1)],2)],1)},n=[],c={name:"DefaultAside",components:{cSwitch:l["o"]}},m=c,d=s("2877"),p=Object(d["a"])(m,o,n,!1,null,null,null),u=p.exports,v=function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("AppHeaderDropdown",{attrs:{right:"","no-caret":""}},[s("template",{slot:"header"},[s("img",{staticClass:"img-avatar",attrs:{src:"https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"}})]),s("template",{slot:"dropdown"},[s("b-dropdown-item",{on:{click:t.logout}},[s("i",{staticClass:"fa fa-lock"}),t._v(" Logout")])],1)],2)},g=[],b={name:"DefaultHeaderDropdownAccnt",components:{AppHeaderDropdown:l["g"]},data:function(){return{itemsCount:42}},mounted:function(){var t=this;this.axios.get("http://127.0.0.1:8000/api/company/get").then(function(a){t.data=a.data})},methods:{logout:function(){this.$auth.destroyToken(),this.$router.push("/login")}}},C=b,h=Object(d["a"])(C,v,g,!1,null,null,null),f=h.exports,x={name:"DefaultContainer",components:{AsideToggler:l["b"],AppHeader:l["f"],AppSidebar:l["h"],AppAside:l["a"],TheFooter:l["e"],Breadcrumb:l["c"],DefaultAside:u,DefaultHeaderDropdownAccnt:f,SidebarForm:l["j"],SidebarFooter:l["i"],SidebarToggler:l["n"],SidebarHeader:l["k"],SidebarNav:l["m"],SidebarMinimizer:l["l"]},data:function(){return{nav:"",data:""}},mounted:function(){var t=this;this.axios.get("http://127.0.0.1:8000/api/company/get").then(function(a){t.data=a.data}),this.nav=r.item},computed:{name:function(){return this.$route.name},list:function(){return this.$route.matched.filter(function(t){return t.name||t.meta.label})}}},_=x,y=Object(d["a"])(_,i,e,!1,null,null,null);a["default"]=y.exports}}]);
//# sourceMappingURL=chunk-a9adb17c.63b3c802.js.map