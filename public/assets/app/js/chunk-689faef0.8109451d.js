(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-689faef0"],{"01c0":function(t,a,e){"use strict";var s=function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{class:["goBack"==t.headerType?"top-back":"header-area"]},[s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-4"},["logo"==t.headerType?s("div",{staticClass:"title"},[t._m(0)]):t._e(),"goBack"==t.headerType?s("div",{staticClass:"back-lead"},[s("router-link",{attrs:{to:{name:"Leads"}}},[s("img",{staticClass:"img-fluid arrow",attrs:{src:e("a912"),alt:""}}),t._v(" Back to Lead")])],1):t._e()]),s("div",{staticClass:"col-lg-8"},[s("div",{staticClass:"notification"},[s("ul",[t._m(1),t._m(2),s("li",[s("a",{staticClass:"bells",attrs:{href:"#"},on:{click:t.toggleNotitab}},[s("img",{staticClass:"img-fluid",attrs:{src:e("27fa"),alt:""}}),t._v(" "),t.count>0?s("span",[t._v(t._s(t.count))]):t._e()]),s("div",{staticClass:"notif-tabs"},[t._m(3),s("div",{staticClass:"tab-content",attrs:{id:"myTabContent"}},[s("div",{staticClass:"tab-pane fade show active",attrs:{id:"home",role:"tabpanel","aria-labelledby":"home-tab"}},t._l(t.notifications,(function(a){return s("div",{key:a.id,staticClass:"notif-irem"},[s("div",{staticClass:"noti-title"},[s("h3",[t._v(t._s(a.data.name))]),s("p",[t._v(t._s(a.data.type))])]),t._m(4,!0)])})),0),t._m(5)])])]),t._m(6)])])])]),s("div",{staticClass:"modal fade",attrs:{id:"addNewLeadModal",tabindex:"-1",role:"dialog","aria-labelledby":"exampleModalLabel","aria-hidden":"true"}},[s("div",{staticClass:"modal-dialog",attrs:{role:"document"}},[s("div",{staticClass:"modal-content"},[t._m(7),s("form",{on:{submit:function(a){return a.preventDefault(),t.addNewLead(a)}}},[s("div",{staticClass:"modal-body"},[t._m(8),s("div",{staticClass:"add-member add-lead"},[s("div",{staticClass:"form-row"},[s("div",{staticClass:"form-group col-md-6"},[s("label",[t._v("First Name")]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.lead_.fname,expression:"lead_.fname"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Jeanne"},domProps:{value:t.lead_.fname},on:{input:function(a){a.target.composing||t.$set(t.lead_,"fname",a.target.value)}}})]),s("div",{staticClass:"form-group col-md-6"},[s("label",[t._v("Last Name")]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.lead_.lname,expression:"lead_.lname"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Acevedo"},domProps:{value:t.lead_.lname},on:{input:function(a){a.target.composing||t.$set(t.lead_,"lname",a.target.value)}}})])]),s("div",{staticClass:"form-group"},[s("label",[t._v("Email Address")]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.lead_.email,expression:"lead_.email"}],staticClass:"form-control",attrs:{type:"email",placeholder:"example@gmail.com"},domProps:{value:t.lead_.email},on:{input:function(a){a.target.composing||t.$set(t.lead_,"email",a.target.value)}}})]),s("div",{staticClass:"form-group"},[s("label",[t._v("Phone number")]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.lead_.phone,expression:"lead_.phone"}],staticClass:"form-control",attrs:{type:"text",placeholder:"+123-22-223-00"},domProps:{value:t.lead_.phone},on:{input:function(a){a.target.composing||t.$set(t.lead_,"phone",a.target.value)}}})]),s("div",{staticClass:"form-group"},[s("label",[t._v("Lead Type")]),s("select",{directives:[{name:"model",rawName:"v-model",value:t.lead_.type,expression:"lead_.type"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var a="_value"in t?t._value:t.value;return a}));t.$set(t.lead_,"type",a.target.multiple?e:e[0])}}},[s("option",{attrs:{value:""}},[t._v("Select type")]),t._l(t.LTypes,(function(a){return s("option",{key:a.lt_id,domProps:{value:a}},[t._v(t._s(a.lt_name))])}))],2)]),s("div",{staticClass:"form-group"},[s("label",[t._v("Lead Source")]),s("select",{directives:[{name:"model",rawName:"v-model",value:t.lead_.source,expression:"lead_.source"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var a="_value"in t?t._value:t.value;return a}));t.$set(t.lead_,"source",a.target.multiple?e:e[0])}}},[s("option",{attrs:{value:""}},[t._v("Select source")]),t._l(t.LSources,(function(a){return s("option",{key:a.ls_id,domProps:{value:a.ls_id}},[t._v(t._s(a.ls_name))])}))],2)]),s("div",{staticClass:"form-group Vehicle"},[s("label",[t._v("Vehicle of Interest")]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.lead_.voi,expression:"lead_.voi"}],staticClass:"form-control",attrs:{type:"search",placeholder:"Type of Interest"},domProps:{value:t.lead_.voi},on:{input:function(a){a.target.composing||t.$set(t.lead_,"voi",a.target.value)}}}),s("img",{staticClass:"img-fluid Vehi-img",attrs:{src:e("6f6b"),alt:""}})]),s("div",{staticClass:"form-group"},[s("label",[t._v("Trad In")]),s("input",{directives:[{name:"model",rawName:"v-model",value:t.lead_.tradeIn,expression:"lead_.tradeIn"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Enter Vin#"},domProps:{value:t.lead_.tradeIn},on:{input:function(a){a.target.composing||t.$set(t.lead_,"tradeIn",a.target.value)}}})])])]),t._m(9)])])])])])},i=[function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("h2",[s("span",{staticClass:"mob"},[s("img",{staticClass:"img-fluid",attrs:{src:e("869f"),alt:""}})]),s("span",{staticClass:"menuwidth"},[s("img",{staticClass:"img-fluid",attrs:{src:e("869f"),alt:""}})]),t._v(" Manager Portal")])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{staticClass:"support",attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("f0c8"),alt:""}})])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{staticClass:"search-box",attrs:{href:"#"}},[s("form",[s("div",{staticClass:"form-group"},[s("input",{staticClass:"form-control",attrs:{type:"search",placeholder:"Search "}}),s("img",{staticClass:"img-fluid sear-icon",attrs:{src:e("6f6b"),alt:""}})])])])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("ul",{staticClass:"nav nav-tabs",attrs:{id:"myTab",role:"tablist"}},[e("li",{staticClass:"nav-item"},[e("a",{staticClass:"nav-link active",attrs:{id:"home-tab","data-toggle":"tab",href:"#home",role:"tab","aria-controls":"home","aria-selected":"true"}},[t._v("Fresh")])]),e("li",{staticClass:"nav-item"},[e("a",{staticClass:"nav-link border-right-0",attrs:{id:"profile-tab","data-toggle":"tab",href:"#profile",role:"tab","aria-controls":"profile","aria-selected":"false"}},[t._v("Merged")])])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"noti-action"},[e("a",{attrs:{href:"#"}},[t._v("untouched")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"tab-pane fade",attrs:{id:"profile",role:"tabpanel","aria-labelledby":"profile-tab"}},[e("div",{staticClass:"notif-irem"},[e("div",{staticClass:"noti-title"},[e("h3",[t._v("javin a. lumpkin")]),e("p",[t._v("internet led")])]),e("div",{staticClass:"noti-action"},[e("a",{attrs:{href:"#"}},[t._v("untouched")])])]),e("div",{staticClass:"notif-irem"},[e("div",{staticClass:"noti-title"},[e("h3",[t._v("javin a. lumpkin")]),e("p",[t._v("internet led")])]),e("div",{staticClass:"noti-action"},[e("a",{attrs:{href:"#"}},[t._v("untouched")])])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{staticClass:"lead-btn",attrs:{href:"#","data-dismiss":"modal","aria-label":"Close","data-toggle":"modal","data-target":"#addNewLeadModal"}},[t._v("Add Lead Sheet "),s("img",{staticClass:"img-fluid",attrs:{src:e("a851"),alt:""}})])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"modal-header"},[s("h5",{staticClass:"modal-title",attrs:{id:"exampleModalLabel"}},[t._v("Add Lead")]),s("a",{staticClass:"close",attrs:{"data-dismiss":"modal","aria-label":"Close"}},[s("span",{attrs:{"aria-hidden":"true"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("17d9"),alt:""}})])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"user-img"},[s("div",{staticClass:"button-wrapper"},[s("span",{staticClass:"label"},[s("img",{staticClass:"img-fluid",attrs:{src:e("2efd"),alt:""}})]),s("input",{staticClass:"upload-box",attrs:{type:"file",name:"upload",id:"upload",placeholder:"Upload File"}})]),s("div",{staticClass:"edit-pro"},[s("img",{staticClass:"img-fluid",attrs:{src:e("66d5"),alt:""}})])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"modal-footer"},[s("a",{staticClass:"add-btn",attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("610c"),alt:""}}),t._v(" Deleted")]),s("button",{staticClass:"rem-btn",attrs:{type:"submit"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("0e94"),alt:""}}),t._v(" Add")])])}],l=e("bc3a"),n=e.n(l),r=e("1157"),o=e.n(r),c={name:"TheHeader",props:["headerType"],data:function(){return{count:0,notifications:{},LSources:{},LTypes:{},lead_:{fname:"",lname:"",email:"",phone:"",source:"",type:"",voi:"",tradeIn:""}}},created:function(){this.getLeadSource(),this.getLeadType()},mounted:function(){var t=this;window.Echo.channel("notiChannel").listen("NotiEvent",(function(a){console.log(a),t.count=a.count,t.notifications=a.text}))},methods:{toggleNotitab:function(){!1===o()(".notif-tabs").hasClass("opens")&&(console.log("Run"),o()(".notif-tabs").toggleClass("opens"))},addNewLead:function(){var t=this;console.log(this.lead_),n.a.post("add_new_lead",this.lead_,{headers:{Authorization:"Bearer "+this.$storage.get("auth").token,"X-Requested-With":"XMLHttpRequest"}}).then((function(a){a.data.success&&(o()("#addNewLeadModal").modal("hide"),t.$router.push("/leads"),t.lead_={fname:"",lname:"",email:"",phone:"",source:"",type:"",voi:"",tradeIn:""})})).catch((function(t){console.log(t)}))},getLeadSource:function(){var t=this;n.a.get("lead_sources").then((function(a){a.data.success&&(t.LSources=a.data.success)})).catch((function(t){console.log(t)}))},getLeadType:function(){var t=this;n.a.get("lead_types").then((function(a){a.data.success&&(t.LTypes=a.data.success)})).catch((function(t){console.log(t)}))},test:function(){n.a.get("like_it").then((function(t){console.log(t.data)})).catch((function(t){console.log(t)}))}}},d=c,m=e("2877"),u=Object(m["a"])(d,s,i,!1,null,null,null);a["a"]=u.exports},"0e94":function(t,a,e){t.exports=e.p+"img/23. Close.bdb0a88d.svg"},1092:function(t,a,e){"use strict";var s=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"modal fade",attrs:{id:"addTeamModal",tabindex:"-1",role:"dialog","aria-labelledby":"addTeamModalLabel","aria-hidden":"true"}},[e("div",{staticClass:"modal-dialog",attrs:{role:"document"}},[e("div",{staticClass:"modal-content"},[t._m(0),e("form",{on:{submit:function(a){return a.preventDefault(),t.addNewTeam(a)}}},[e("div",{staticClass:"modal-body"},[e("div",{staticClass:"add-member"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"teamName"}},[t._v("Team Name")]),e("input",{directives:[{name:"model",rawName:"v-model",value:t.teamName,expression:"teamName"}],staticClass:"form-control",attrs:{type:"text",id:"teamName",placeholder:"Enter team name"},domProps:{value:t.teamName},on:{input:function(a){a.target.composing||(t.teamName=a.target.value)}}})])])]),t._m(1)])])])])},i=[function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"modal-header"},[s("h5",{staticClass:"modal-title",attrs:{id:"addTeamModalLabel"}},[t._v("Add New Team")]),s("a",{staticClass:"close",attrs:{"data-dismiss":"modal","aria-label":"Close"}},[s("span",{attrs:{"aria-hidden":"true"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("17d9"),alt:""}})])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"modal-footer"},[s("button",{staticClass:"rem-btn",attrs:{type:"submit"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("0e94"),alt:""}}),t._v(" Add")])])}],l=e("44e6"),n=e.n(l),r=e("bc3a"),o=e.n(r),c=e("1157"),d=e.n(c),m={name:"AddTeam",mixins:[n.a],data:function(){return{teamName:""}},vdRules:{teamName:{required:!0}},methods:{addNewTeam:function(){var t=this;this.$vd.teamName.$validate().then((function(){o.a.post("addTeam",{name:t.teamName}).then((function(a){a.data.success&&(d()("#addTeamModal").modal("hide"),t.$root.$emit("newTeam",a.data.success),t.teamName="",t.$router.push({name:"Members",params:{slug:a.data.success.tm_slug}}))})).catch((function(t){console.log(t)}))})).catch((function(){}))}}},u=m,f=e("2877"),v=Object(f["a"])(u,s,i,!1,null,null,null);a["a"]=v.exports},"17d9":function(t,a,e){t.exports=e.p+"img/23. Closex.da26e446.svg"},"1ae4":function(t,a,e){t.exports=e.p+"img/logo.95a849c5.svg"},"1e2e":function(t,a,e){t.exports=e.p+"img/logo-g.0e5df152.svg"},"27fa":function(t,a,e){t.exports=e.p+"img/Bell.2ab47b78.svg"},"2efd":function(t,a,e){t.exports=e.p+"img/profile.1a1ce6b3.svg"},"338d":function(t,a,e){t.exports=e.p+"img/friends.ba1c57ed.svg"},"5be0":function(t,a,e){t.exports=e.p+"img/Schedule.63661048.svg"},"5fa4":function(t,a,e){"use strict";e.r(a);var s=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("DashboardContainer",[e("TeamsGrid"),e("AddTeam")],1)},i=[],l=e("a056"),n=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"teams-area row"},[t._l(t.teams,(function(a){return e("div",{key:a.tm_id,staticClass:"col-md-3"},[e("div",{staticClass:"team-card"},[e("div",{staticClass:"title"},[e("h3",[e("i",{staticClass:"fa fa-users"}),t._v(" "+t._s(a.tm_name))])])])])})),t._m(0)],2)},r=[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"col-md-3 "},[e("div",{staticClass:"team-card p-0"},[e("a",{staticClass:"add-team",attrs:{href:"#","data-toggle":"modal","data-target":"#addTeamModal"}},[e("img",{staticClass:"img-fluid",attrs:{src:"/img/23. Close.bdb0a88d.svg",alt:""}}),t._v(" Add new ")])])])}],o=e("bc3a"),c=e.n(o),d={name:"TeamsGrid",data:function(){return{teams:null}},created:function(){this.getTeams()},methods:{getTeams:function(){var t=this;c.a.get("teams").then((function(a){var e=a.data.data;t.teams=e,t.$root.$on("newTeam",(function(t){e.push(t)})),console.log(a)})).catch((function(t){console.log(t)}))}}},m=d,u=(e("cd29"),e("2877")),f=Object(u["a"])(m,n,r,!1,null,"5dbbffca",null),v=f.exports,p=e("1092"),g={name:"Teams",components:{DashboardContainer:l["a"],TeamsGrid:v,AddTeam:p["a"]}},_=g,h=Object(u["a"])(_,s,i,!1,null,null,null);a["default"]=h.exports},"610c":function(t,a,e){t.exports=e.p+"img/22. Delete.3eac7692.svg"},"66d5":function(t,a,e){t.exports=e.p+"img/edit.8e8b8968.svg"},"6f6b":function(t,a,e){t.exports=e.p+"img/search.898ea790.svg"},"869f":function(t,a,e){t.exports=e.p+"img/menu.de7ca278.svg"},"87f0":function(t,a,e){t.exports=e.p+"img/Manger.61410579.svg"},9064:function(t,a,e){},a056:function(t,a,e){"use strict";var s=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("section",{staticClass:"main-area"},[e("div",{staticClass:"container-fluid"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-12"},[e("TheSidebar"),e("div",{staticClass:"audits-completed col-md-12"},[e("TheHeader",{attrs:{headerType:"logo"}}),t._t("default")],2)],1)])])])},i=[],l=function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"menu-area"},[t._m(0),s("div",{staticClass:"logo"},[s("router-link",{attrs:{to:"/dashboard"}},[s("img",{staticClass:"img-fulid small-logo",attrs:{src:e("1e2e"),alt:"logo"}}),s("img",{staticClass:"img-fulid big-logo",attrs:{src:e("1ae4"),alt:"logo"}})])],1),s("ul",[s("li",[t._m(1),s("ul",{staticClass:"sub-menu"},[t._m(2),t._l(t.teams,(function(a){return s("li",{key:a.tm_id},[s("router-link",{attrs:{to:{name:"Members",params:{slug:a.tm_slug}}}},[t._v(t._s(a.tm_name))])],1)})),t._m(3)],2)]),t._m(4),s("li",[s("router-link",{attrs:{to:{name:"Leads"}}},[s("img",{staticClass:"img-fluid",attrs:{src:e("f8ab"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Lead Sheets ")])])],1),t._m(5),t._m(6),t._m(7),t._m(8),t._m(9)]),s("AddTeam")],1)},n=[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"closes"},[e("i",{staticClass:"fa fa-times",attrs:{"aria-hidden":"true"}})])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("a",{staticClass:"active",attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("338d"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Team ")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("li",[e("h4",[t._v("Teams")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("li",[e("a",{attrs:{href:"#","data-toggle":"modal","data-target":"#addTeamModal"}},[t._v("Add team")])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("5be0"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Prospects ")])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("87f0"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Lead Manger ")])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("eab7"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Task Manager ")])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("f96b"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Marketing Settings ")])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("f615"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Email ")])])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("li",[s("a",{attrs:{href:"#"}},[s("img",{staticClass:"img-fluid",attrs:{src:e("e057"),alt:""}}),t._v(" "),s("span",{staticClass:"hide-item"},[t._v("Settings ")])])])}],r=e("bc3a"),o=e.n(r),c=e("1092"),d={name:"TheSidebar",components:{AddTeam:c["a"]},data:function(){return{teams:null}},created:function(){this.getTeams()},methods:{getTeams:function(){var t=this;o.a.get("teams").then((function(a){var e=a.data.data;t.teams=e,t.$root.$on("newTeam",(function(t){e.push(t)})),console.log(a)})).catch((function(t){console.log(t)}))}}},m=d,u=e("2877"),f=Object(u["a"])(m,l,n,!1,null,null,null),v=f.exports,p=e("01c0"),g={name:"TheContainer",components:{TheSidebar:v,TheHeader:p["a"]}},_=g,h=Object(u["a"])(_,s,i,!1,null,null,null);a["a"]=h.exports},a851:function(t,a){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAABZSURBVHgB7ZHBCQAgDANbcS8dxc10FJ2sVvAhfeUhIuhBKIRQSkr0OYKIpCEk6wgjqgISRBfC3L+QrTHLt33FOavxGzOX1dh+IYReXVQZyT74ZQ/mKn2O0QEkUxVIsj/KsAAAAABJRU5ErkJggg=="},a912:function(t,a,e){t.exports=e.p+"img/27. Left.c011dfea.svg"},cd29:function(t,a,e){"use strict";var s=e("9064"),i=e.n(s);i.a},e057:function(t,a,e){t.exports=e.p+"img/Settings.d64cd801.svg"},eab7:function(t,a,e){t.exports=e.p+"img/Taskr.e4447512.svg"},f0c8:function(t,a,e){t.exports=e.p+"img/support.578792a1.svg"},f615:function(t,a,e){t.exports=e.p+"img/Email.85f6f0c0.svg"},f8ab:function(t,a,e){t.exports=e.p+"img/Lead.85392ee9.svg"},f96b:function(t,a,e){t.exports=e.p+"img/Marketing.1aa0e818.svg"}}]);
//# sourceMappingURL=chunk-689faef0.8109451d.js.map