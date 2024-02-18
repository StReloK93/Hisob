import{I as A}from"./IconEdit-437ddc71.js";import{B as O}from"./Button-fe178d08.js";import{d as v,a as i,o as h,c as w,w as u,e as o,g as z,l as f,p as C,n as N,m as _,r as y,h as B,b as $}from"./app-0e96dc03.js";import{r as D}from"./helpers-ca74a7fa.js";const V=v({__name:"FormInputs",props:["formData"],setup(d){return(g,t)=>{const n=i("v-text-field"),s=i("v-switch"),a=i("v-col"),e=i("v-row");return h(),w(e,null,{default:u(()=>[o(a,{cols:"12",class:"pt-0"},{default:u(()=>[o(n,{class:"mb-2",label:"Nomi",modelValue:d.formData.name,"onUpdate:modelValue":t[0]||(t[0]=l=>d.formData.name=l),rules:z(D)},null,8,["modelValue","rules"]),o(n,{class:"mb-2",label:"Qisqa nomi",modelValue:d.formData.short_name,"onUpdate:modelValue":t[1]||(t[1]=l=>d.formData.short_name=l),rules:z(D)},null,8,["modelValue","rules"]),o(s,{class:"mb-2",label:"Faolligi",modelValue:d.formData.isActive,"onUpdate:modelValue":t[2]||(t[2]=l=>d.formData.isActive=l)},null,8,["modelValue"])]),_:1})]),_:1})}}}),k=v({__name:"AddOrganization",emits:["addOrganization"],setup(d,{emit:g}){const t=f({dialog:!1}),n=f({name:null,short_name:[],isActive:!0});function s(){_.post("organization",n).then(({data:a})=>{t.dialog=!1,g("addOrganization",a)})}return C(()=>t.dialog,a=>{a&&(n.name=null,n.short_name=null,n.isActive=!0)}),(a,e)=>{const l=i("v-btn"),p=i("CustomForm"),m=i("v-dialog"),r=i("v-row");return h(),w(r,{justify:"end",class:"flex-0-0 ma-0 pb-2 px-4 overflow-y-auto"},{default:u(()=>[o(m,{modelValue:t.dialog,"onUpdate:modelValue":e[1]||(e[1]=c=>t.dialog=c),persistent:"",width:"512",location:"right"},{activator:u(({props:c})=>[o(l,N({icon:"mdi-plus",color:"teal"},c),null,16)]),default:u(()=>[o(p,{submitMethod:s,onClose:e[0]||(e[0]=c=>t.dialog=!1),title:"Bo'linma kiritish"},{default:u(()=>[o(V,{formData:n},null,8,["formData"])]),_:1})]),_:1},8,["modelValue"])]),_:1})}}}),F=v({__name:"EditOrganization",props:["current"],emits:["editOrganization"],setup(d,{expose:g,emit:t}){const{current:n}=d,s=f({dialog:!1}),a=f({name:null,short_name:null,isActive:!0});async function e(){await _.patch(`organization/${n.selected}`,a).then(({data:m})=>{s.dialog=!1,t("editOrganization",m)})}function l(m){_.get(`organization/${m}`).then(({data:r})=>{a.name=r.name,a.short_name=r.short_name,a.isActive=!!r.isActive})}return C(()=>s.dialog,m=>{m&&l(n.selected)}),g({toggle:()=>s.dialog=!0}),(m,r)=>{const c=i("CustomForm"),b=i("v-dialog");return h(),w(b,{modelValue:s.dialog,"onUpdate:modelValue":r[1]||(r[1]=x=>s.dialog=x),persistent:"",width:"512",location:"right"},{default:u(()=>[o(c,{submitMethod:e,onClose:r[0]||(r[0]=x=>s.dialog=!1),title:"Bo'linma tahrirlash"},{default:u(()=>[o(V,{formData:a},null,8,["formData"])]),_:1})]),_:1},8,["modelValue"])}}}),R={class:"d-flex flex-column"},I={class:"d-flex justify-space-between items-center"},q=v({__name:"Organizations",setup(d){const g=y(),t=f({gridApi:null,organization:[],selected:null});function n(e){t.gridApi.applyTransaction({add:[e]})}function s(e){t.gridApi.getRowNode(e.id).setData(e)}const a=f([{field:"id",headerName:"№",width:65},{field:"name",headerName:"Nomi",flex:1},{field:"short_name",headerName:"Qisqa nomi",flex:1},{cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],field:"isActive",headerName:"Faolligi",cellRenderer:O,width:60,headerClass:["px-2"],onCellClicked:e=>{+_.post(`organization/set_activate/${e.data.id}`,{active:!e.value}).then(()=>{e.node.setDataValue("isActive",!e.value)})}},{cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],headerName:"",width:60,cellRenderer:A,headerClass:["px-2"],onCellClicked:({data:e})=>{t.selected=e.id,g.value.toggle()}}]);return _.get("organization").then(({data:e})=>t.organization=e),(e,l)=>{const p=i("Breadcrumbs"),m=i("AgGridVue"),r=i("v-spacer");return h(),B("section",R,[$("div",I,[o(p),o(k,{onAddOrganization:n}),o(F,{onEditOrganization:s,ref_key:"editComponent",ref:g,current:t},null,8,["current"])]),o(r,{class:"px-4"},{default:u(()=>[o(m,{defaultColDef:{sortable:!0},headerHeight:34,class:"ag-theme-material h-100",getRowId:({data:c})=>c.id,columnDefs:a,rowData:t.organization,onGridReady:l[0]||(l[0]=c=>t.gridApi=c.api),animateRows:"true"},null,8,["getRowId","columnDefs","rowData"])]),_:1})])}}});export{q as default};
