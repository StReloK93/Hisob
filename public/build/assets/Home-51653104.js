import{d as k,r as N,u as x,a as o,o as r,c as m,w as e,b as j,e as t,f as a,g as _,h as V,i as p,j as q,F as A}from"./app-6bc6ab89.js";import{s as F}from"./swal-2a5433fd.js";const S={key:0},H={class:"pa-2"},M=k({__name:"Navigator",setup(y,{expose:d}){const i=N(!0),l=x();function v(){i.value=!i.value}d({toggle:v});function f(){F.fire({title:"Tizimdan chiqmoqchimisiz?",icon:"warning"}).then(u=>{u.isConfirmed&&l.logout()})}return(u,s)=>{const n=o("v-list-item"),c=o("v-divider"),h=o("v-list-subheader"),b=o("v-tooltip"),w=o("v-list"),B=o("v-btn"),R=o("v-navigation-drawer");return r(),m(R,{modelValue:i.value,"onUpdate:modelValue":s[0]||(s[0]=g=>i.value=g),location:"left"},{append:e(()=>[j("div",H,[t(B,{onClick:f,color:"red-accent-3",block:"","append-icon":"mdi-logout"},{default:e(()=>[a(" Chiqish ")]),_:1})])]),default:e(()=>{var g,C;return[t(n,{class:"bg-teal-lighten-5",lines:"two","prepend-avatar":"/images/profile.png",title:(g=_(l).user)==null?void 0:g.name,subtitle:(C=_(l).user)==null?void 0:C.login},null,8,["title","subtitle"]),t(w,{density:"comfortable"},{default:e(()=>{var z;return[t(n,{"prepend-icon":"mdi-account-group",title:"Xodimlar",to:{name:"employes"}}),t(c),t(h,{title:"Umumiy"}),t(n,{"prepend-icon":"mdi-texture-box",title:"Normaviy hujjatlar",to:{name:"maindocuments"}}),t(n,{"prepend-icon":"mdi-tshirt-crew",title:"Shaxsiy himoya vositalari",to:{name:"products"}},{default:e(()=>[t(b,{activator:"parent",location:"bottom"},{default:e(()=>[a("Shaxsiy himoya vositalari")]),_:1})]),_:1}),t(n,{"prepend-icon":"mdi-weather-hail",title:"Mehnat sharoitlari",to:{name:"workingconditions"}}),t(n,{"prepend-icon":"mdi-account-hard-hat",title:"Lavozimlar",to:{name:"positions"}}),t(c),(z=_(l).userRoles)!=null&&z.includes(1)?(r(),V("div",S,[t(h,{title:"Admin"}),t(n,{"prepend-icon":"mdi-account-network",title:"Foydalanuvchilar",to:{name:"users"}}),t(n,{"prepend-icon":"mdi-texture-box",title:"Bo'linmalar",to:{name:"organizations"}})])):p("",!0)]}),_:1})]}),_:1},8,["modelValue"])}}}),T=k({__name:"Header",setup(y){const d=N(null),i=x();function l(){d.value.toggle()}return(v,f)=>{const u=o("v-app-bar-nav-icon"),s=o("v-icon"),n=o("v-tooltip"),c=o("v-btn"),h=o("v-spacer"),b=o("v-badge"),w=o("v-app-bar");return r(),V(A,null,[t(M,{ref_key:"nav",ref:d},null,512),t(w,{color:"teal-darken-1",prominent:""},{default:e(()=>[t(u,{variant:"text",class:"mr-8",color:"white",onClick:q(l,["stop"])},null,8,["onClick"]),_(i).userRoles.includes(1)?(r(),m(c,{key:0,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(s,null,{default:e(()=>[a("mdi-shield-crown")]),_:1}),t(n,{activator:"parent",location:"bottom"},{default:e(()=>[a("Admin")]),_:1})]),_:1})):p("",!0),_(i).userRoles.includes(2)?(r(),m(c,{key:1,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(s,{text:"white"},{default:e(()=>[a("mdi-clipboard-list")]),_:1}),t(n,{activator:"parent",location:"bottom"},{default:e(()=>[a("Omborchi")]),_:1})]),_:1})):p("",!0),_(i).userRoles.includes(3)?(r(),m(c,{key:2,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(s,null,{default:e(()=>[a("mdi-point-of-sale")]),_:1}),t(n,{activator:"parent",location:"bottom"},{default:e(()=>[a("Buxgalter")]),_:1})]),_:1})):p("",!0),_(i).userRoles.includes(4)?(r(),m(c,{key:3,size:"small",class:"mr-2",color:"white",icon:""},{default:e(()=>[t(s,null,{default:e(()=>[a("mdi-security")]),_:1}),t(n,{activator:"parent",location:"bottom"},{default:e(()=>[a("ММваХТ мухандиси")]),_:1})]),_:1})):p("",!0),t(h),t(c,{color:"white",class:"text-none",stacked:""},{default:e(()=>[t(b,{content:10,color:"error"},{default:e(()=>[t(s,null,{default:e(()=>[a("mdi-bell")]),_:1})]),_:1})]),_:1})]),_:1})],64)}}}),E=k({__name:"Home",setup(y){return x(),(d,i)=>{const l=o("router-view"),v=o("v-container"),f=o("v-main"),u=o("v-app");return r(),m(u,{class:"bg-grey-lighten-5"},{default:e(()=>[t(T),t(f,null,{default:e(()=>[t(v,{class:"h-100"},{default:e(()=>[t(l,{class:"h-100"})]),_:1})]),_:1})]),_:1})}}});export{E as default};
