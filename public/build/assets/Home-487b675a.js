import{d as z,r as R,a as C,u as $,b as o,o as _,c as h,w as e,e as q,f as t,g as n,h as i,i as j,j as b,k as F,F as H}from"./app-1e917984.js";import{s as L}from"./swal-e9f38135.js";const S={key:0},A={class:"pa-2"},M=z({__name:"Navigator",setup(N,{expose:w}){const l=R(!0),c=C();function r(){l.value=!l.value}w({toggle:r});function g(){L.fire({title:"Tizimdan chiqmoqchimisiz?",icon:"warning"}).then(v=>{v.isConfirmed&&c.logout()})}const{t:p}=$();return(v,m)=>{const a=o("v-list-item"),u=o("v-divider"),d=o("v-list-subheader"),s=o("v-tooltip"),k=o("v-list"),x=o("v-btn"),y=o("v-navigation-drawer");return _(),h(y,{modelValue:l.value,"onUpdate:modelValue":m[0]||(m[0]=f=>l.value=f),location:"left"},{append:e(()=>[q("div",A,[t(x,{onClick:g,color:"red-accent-3",block:"","append-icon":"mdi-logout"},{default:e(()=>[n(" Chiqish ")]),_:1})])]),default:e(()=>{var f,V;return[t(a,{class:"bg-teal-lighten-5",lines:"two","prepend-avatar":"/images/profile.png",title:(f=i(c).user)==null?void 0:f.name,subtitle:(V=i(c).user)==null?void 0:V.login},null,8,["title","subtitle"]),t(k,{density:"comfortable"},{default:e(()=>{var B;return[t(a,{"prepend-icon":"mdi-account-group",title:i(p)("employe"),to:{name:"employes"}},null,8,["title"]),t(u),t(d,{title:"Umumiy"}),t(a,{"prepend-icon":"mdi-texture-box",title:"Normaviy hujjatlar",to:{name:"maindocuments"}}),t(a,{"prepend-icon":"mdi-tshirt-crew",title:"Shaxsiy himoya vositalari",to:{name:"products"}},{default:e(()=>[t(s,{activator:"parent",location:"bottom"},{default:e(()=>[n("Shaxsiy himoya vositalari")]),_:1})]),_:1}),t(a,{"prepend-icon":"mdi-weather-hail",title:"Mehnat sharoitlari",to:{name:"workingconditions"}}),t(a,{"prepend-icon":"mdi-account-hard-hat",title:"Lavozimlar",to:{name:"positions"}}),t(a,{"prepend-icon":"mdi-microsoft-excel",title:"Hisobotlar",to:{name:"report"}}),t(u),(B=i(c).userRoles)!=null&&B.includes(1)?(_(),j("div",S,[t(d,{title:"Admin"}),t(a,{"prepend-icon":"mdi-account-network",title:"Foydalanuvchilar",to:{name:"users"}}),t(a,{"prepend-icon":"mdi-texture-box",title:"Bo'linmalar",to:{name:"organizations"}})])):b("",!0)]}),_:1})]}),_:1},8,["modelValue"])}}}),T=z({__name:"Header",setup(N){const{t:w,current:l}=$(),c=R(null),r=C();function g(){c.value.toggle()}function p(v){localStorage.setItem("locale",v),l.value=v}return(v,m)=>{const a=o("v-app-bar-nav-icon"),u=o("v-icon"),d=o("v-tooltip"),s=o("v-btn"),k=o("v-spacer"),x=o("v-badge"),y=o("v-app-bar");return _(),j(H,null,[t(M,{ref_key:"nav",ref:c},null,512),t(y,{color:"teal-darken-1",prominent:""},{default:e(()=>[t(a,{variant:"text",class:"mr-8",color:"white",onClick:F(g,["stop"])},null,8,["onClick"]),i(r).userRoles.includes(1)?(_(),h(s,{key:0,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(u,null,{default:e(()=>[n("mdi-shield-crown")]),_:1}),t(d,{activator:"parent",location:"bottom"},{default:e(()=>[n("Admin")]),_:1})]),_:1})):b("",!0),i(r).userRoles.includes(2)?(_(),h(s,{key:1,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(u,{text:"white"},{default:e(()=>[n("mdi-clipboard-list")]),_:1}),t(d,{activator:"parent",location:"bottom"},{default:e(()=>[n("Omborchi")]),_:1})]),_:1})):b("",!0),i(r).userRoles.includes(3)?(_(),h(s,{key:2,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(u,null,{default:e(()=>[n("mdi-point-of-sale")]),_:1}),t(d,{activator:"parent",location:"bottom"},{default:e(()=>[n("Buxgalter")]),_:1})]),_:1})):b("",!0),i(r).userRoles.includes(4)?(_(),h(s,{key:3,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(u,null,{default:e(()=>[n("mdi-security")]),_:1}),t(d,{activator:"parent",location:"bottom"},{default:e(()=>[n("ММваХТ muxandis")]),_:1})]),_:1})):b("",!0),t(k),t(s,{active:i(l)=="uz",color:"white",stacked:"",onClick:m[0]||(m[0]=f=>p("uz"))},{default:e(()=>[n(" uz ")]),_:1},8,["active"]),t(s,{active:i(l)=="ru",color:"white",stacked:"",onClick:m[1]||(m[1]=f=>p("ru"))},{default:e(()=>[n(" ru ")]),_:1},8,["active"]),t(s,{color:"white",class:"text-none",stacked:""},{default:e(()=>[t(x,{content:10,color:"error"},{default:e(()=>[t(u,null,{default:e(()=>[n("mdi-bell")]),_:1})]),_:1})]),_:1})]),_:1})],64)}}}),I=z({__name:"Home",setup(N){return C(),(w,l)=>{const c=o("router-view"),r=o("v-container"),g=o("v-main"),p=o("v-app");return _(),h(p,{class:"bg-grey-lighten-5"},{default:e(()=>[t(T),t(g,null,{default:e(()=>[t(r,{class:"h-100"},{default:e(()=>[t(c,{class:"h-100"})]),_:1})]),_:1})]),_:1})}}});export{I as default};
