import{d as D,r as x,l as m,a as t,o as $,c as B,w as o,b as e,p as j,j as M,g as b,f as A,m as h,h as E,e as U}from"./app-4c157124.js";import{I as q}from"./IconEdit-efd56ee7.js";import{A as G}from"./ag-grid.css_vue_type_style_index_0_src_true_lang-2707f2bc.js";const Y=A("span",null,"Mahsulot kiritish formasi",-1),F=D({__name:"AddPositionType",emits:["addPositionType"],setup(w,{emit:p}){const s=x(),d=m({dialog:!1,rules:[l=>l==null||l==""?"toldiring":!0]}),c=m({name:null});async function r(){const{valid:l}=await s.value.validate();l!=!1&&h.post("position_type",c).then(({data:n})=>{d.dialog=!1,p("addPositionType",n)})}return(l,n)=>{const _=t("v-btn"),f=t("v-card-title"),i=t("v-text-field"),a=t("v-col"),v=t("v-row"),T=t("v-container"),V=t("v-card-text"),k=t("v-spacer"),P=t("v-card-actions"),N=t("v-card"),C=t("v-form"),g=t("v-dialog");return $(),B(v,{justify:"end",class:"flex-0-0 ma-0 pb-2 px-4 overflow-y-auto"},{default:o(()=>[e(g,{modelValue:d.dialog,"onUpdate:modelValue":n[3]||(n[3]=u=>d.dialog=u),persistent:"",width:"512",location:"right"},{activator:o(({props:u})=>[e(_,j({icon:"mdi-plus",color:"teal"},u),null,16)]),default:o(()=>[e(C,{onSubmit:M(r,["prevent"]),ref_key:"formTag",ref:s,onVnodeMounted:n[2]||(n[2]=u=>s.value.reset())},{default:o(()=>[e(N,{class:"bg-white"},{default:o(()=>[e(f,{class:"bg-blue-grey-lighten-5"},{default:o(()=>[Y]),_:1}),e(V,{class:"pa-0"},{default:o(()=>[e(T,null,{default:o(()=>[e(v,null,{default:o(()=>[e(a,{cols:"12",class:"pt-0"},{default:o(()=>[e(i,{color:"teal",label:"Nomi",modelValue:c.name,"onUpdate:modelValue":n[0]||(n[0]=u=>c.name=u),variant:"underlined","hide-details":"auto",rules:d.rules},null,8,["modelValue","rules"])]),_:1})]),_:1})]),_:1})]),_:1}),e(P,null,{default:o(()=>[e(k),e(_,{color:"blue-gray-1",variant:"text",type:"button",onClick:n[1]||(n[1]=u=>d.dialog=!1)},{default:o(()=>[b(" Yopish ")]),_:1}),e(_,{color:"blue-darken-1",variant:"text",type:"submit"},{default:o(()=>[b(" Saqlash ")]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1},8,["modelValue"])]),_:1})}}}),H=A("span",null,"Mahsulot kiritish formasi",-1),K=D({__name:"EditPositionType",props:["current"],emits:["editPositionType"],setup(w,{expose:p,emit:s}){const{current:d}=w,c=x(),r=m({dialog:!1,rules:[i=>i==null||i==""?"toldiring":!0]}),l=m({name:null});async function n(){const{valid:i}=await c.value.validate();i!=!1&&h.patch(`position_type/${d.selected}`,l).then(({data:a})=>{r.dialog=!1,s("editPositionType",a)})}async function _(){c.value.reset(),h.get(`position_type/${d.selected}`).then(({data:i})=>{l.name=i.name})}return p({toggle:()=>r.dialog=!0}),(i,a)=>{const v=t("v-card-title"),T=t("v-text-field"),V=t("v-col"),k=t("v-row"),P=t("v-container"),N=t("v-card-text"),C=t("v-spacer"),g=t("v-btn"),u=t("v-card-actions"),R=t("v-card"),S=t("v-form"),I=t("v-dialog");return $(),B(I,{modelValue:r.dialog,"onUpdate:modelValue":a[2]||(a[2]=y=>r.dialog=y),persistent:"",width:"512",location:"right"},{default:o(()=>[e(S,{onSubmit:M(n,["prevent"]),ref_key:"formTag",ref:c,onVnodeMounted:_},{default:o(()=>[e(R,{class:"bg-white"},{default:o(()=>[e(v,{class:"bg-blue-grey-lighten-5"},{default:o(()=>[H]),_:1}),e(N,{class:"pa-0"},{default:o(()=>[e(P,null,{default:o(()=>[e(k,null,{default:o(()=>[e(V,{cols:"12",class:"pt-0"},{default:o(()=>[e(T,{color:"teal",label:"Nomi",modelValue:l.name,"onUpdate:modelValue":a[0]||(a[0]=y=>l.name=y),variant:"underlined","hide-details":"auto",rules:r.rules},null,8,["modelValue","rules"])]),_:1})]),_:1})]),_:1})]),_:1}),e(u,null,{default:o(()=>[e(C),e(g,{color:"blue-gray-1",variant:"text",type:"button",onClick:a[1]||(a[1]=y=>r.dialog=!1)},{default:o(()=>[b(" Yopish ")]),_:1}),e(g,{color:"blue-darken-1",variant:"text",type:"submit"},{default:o(()=>[b(" Saqlash ")]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1},8,["modelValue"])}}}),z={class:"d-flex flex-column"},J={class:"d-flex justify-space-between items-center"},W=D({__name:"PositionType",setup(w){const p=x(),s=m({selected:null,gridApi:null});function d(n){s.gridApi.applyTransaction({add:[n],addIndex:0})}function c(n){s.gridApi.getRowNode(n.id).setData(n)}const r=m([{field:"id",headerName:"Kod",width:80},{field:"name",headerName:"Nomi",flex:1},{cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],headerName:"",width:60,cellRenderer:q,headerClass:["px-2"],onCellClicked:({data:n})=>{s.selected=n.id,p.value.toggle()}}]),l=x([]);return h.get("position_type").then(({data:n})=>l.value=n),(n,_)=>{const f=t("Breadcrumbs"),i=t("v-spacer");return $(),E("section",z,[A("div",J,[e(f),e(F,{onAddPositionType:d}),e(K,{onEditPositionType:c,ref_key:"editComponent",ref:p,current:s},null,8,["current"])]),e(i,{class:"px-4"},{default:o(()=>[e(U(G),{headerHeight:34,class:"ag-theme-material h-100",getRowId:({data:a})=>a.id,columnDefs:r,rowData:l.value,onGridReady:_[0]||(_[0]=a=>s.gridApi=a.api),animateRows:"true"},null,8,["getRowId","columnDefs","rowData"])]),_:1})])}}});export{W as default};