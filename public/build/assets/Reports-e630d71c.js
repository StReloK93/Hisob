import{d as R,l as v,a as l,o as _,c as b,w as e,e as a,s as A,v as T,f as V,t as C,x as B,g as P,m as y,r as G,y as D,h,b as q,n as F,F as N,k as $,z as I}from"./app-0e96dc03.js";import{r as U}from"./helpers-ca74a7fa.js";import{_ as k}from"./Icon.vue_vue_type_script_setup_true_lang-10597aab.js";import{B as j}from"./Button-fe178d08.js";const E=R({__name:"AddMonthReport",props:["report"],emits:["addReport"],setup(m,{emit:f}){const{report:d}=m,n=v({name:null,report_type_id:d.id});async function r(){await y.post("report",n).then(({data:o})=>{console.log(d.id,o),f("addReport",{report_type_id:d.id,report:o}),t.dialog=!1})}const t=v({dialog:!1,products:null});return(o,s)=>{const p=l("v-list-item"),g=l("v-text-field"),w=l("v-col"),x=l("v-row"),i=l("v-dialog");return _(),b(i,{modelValue:t.dialog,"onUpdate:modelValue":s[2]||(s[2]=u=>t.dialog=u),persistent:"",width:"600",location:"right"},{activator:e(({props:u})=>[a(p,A(T(u)),{default:e(()=>[V(C(m.report.name),1)]),_:2},1040)]),default:e(()=>[a(B,{submitMethod:r,onClose:s[1]||(s[1]=u=>t.dialog=!1),title:m.report.name},{default:e(()=>[a(x,null,{default:e(()=>[a(w,{cols:"12",class:"pt-3"},{default:e(()=>[a(g,{rules:P(U),modelValue:n.name,"onUpdate:modelValue":s[0]||(s[0]=u=>n.name=u),label:"Hisobot nomi"},null,8,["rules","modelValue"])]),_:1})]),_:1})]),_:1},8,["title"])]),_:1},8,["modelValue"])}}}),L=R({__name:"AddMonth",props:["report"],emits:["addProduct"],setup(m,{emit:f}){const d=v({name:null});async function n(){console.log("test")}const r=v({dialog:!1,products:null});return(t,o)=>{const s=l("v-list-item"),p=l("v-text-field"),g=l("v-col"),w=l("v-row"),x=l("v-dialog");return _(),b(x,{modelValue:r.dialog,"onUpdate:modelValue":o[2]||(o[2]=i=>r.dialog=i),persistent:"",width:"600",location:"right"},{activator:e(({props:i})=>[a(s,A(T(i)),{default:e(()=>[V(C(m.report.name),1)]),_:2},1040)]),default:e(()=>[a(B,{submitMethod:n,onClose:o[1]||(o[1]=i=>r.dialog=!1),title:m.report.name},{default:e(()=>[a(w,null,{default:e(()=>[a(g,{cols:"12",class:"pt-3"},{default:e(()=>[a(p,{rules:P(U),modelValue:d.name,"onUpdate:modelValue":o[0]||(o[0]=i=>d.name=i),label:"Hisobot nomi"},null,8,["rules","modelValue"])]),_:1})]),_:1})]),_:1},8,["title"])]),_:1},8,["modelValue"])}}}),S=R({__name:"MonthReportTable",props:["report_id"],setup(m,{expose:f}){const{report_id:d}=m,n=v({gridApi:null,reports:[]}),r=v([{field:"id",headerName:"№",width:65},{field:"name",headerName:"Nomi",width:200},{field:"created_at",headerName:"Vaqti",flex:1},{cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],field:"completed",headerName:"Tasdiqlash",width:90,cellRenderer:j,onCellClicked:({data:t})=>{}},{field:"file_source",headerName:"",width:80,cellRenderer:k,cellRendererParams:{icon:"mdi-microsoft-excel"},onCellClicked:({data:t})=>{window.open(`/storage/${t.file_source}`,"_blank")}},{field:"",headerName:"",width:80,cellRenderer:k,cellRendererParams:{icon:"mdi-delete-empty",color:"red"},onCellClicked:({data:t})=>{y.delete(`report/${t.id}`).then(()=>{n.gridApi.applyTransaction({remove:[t]})})}}]);return y.get(`report_type/${d}`).then(({data:t})=>{n.reports=t}),f({pageData:n}),(t,o)=>{const s=l("AgGridVue");return _(),b(s,{headerHeight:34,defaultColDef:{sortable:!0},class:"ag-theme-material h-100",getRowId:({data:p})=>p.id,columnDefs:r,rowData:n.reports,onGridReady:o[0]||(o[0]=p=>n.gridApi=p.api),animateRows:!0},null,8,["getRowId","columnDefs","rowData"])}}}),J={class:"d-flex flex-column"},X=R({__name:"Reports",setup(m){const f=G();function d(r){r.report_type_id==1&&f.value.pageData.gridApi.applyTransaction({add:[r.report]})}y.get("report_type").then(({data:r})=>{const t=r.map(o=>(o.id==1&&(o.component=D(E)),o.id==2&&(o.component=D(L)),o));n.report_types=t});const n=v({tab:0,report_types:[]});return(r,t)=>{const o=l("v-btn"),s=l("v-list"),p=l("v-menu"),g=l("v-tab"),w=l("v-tabs"),x=l("v-window-item"),i=l("v-window"),u=l("v-card-text"),M=l("v-card"),z=l("v-spacer");return _(),h("section",J,[a(p,null,{activator:e(({props:c})=>[q("div",null,[a(o,F({"prepend-icon":"mdi-microsoft-excel",class:"text-capitalize",color:"blue-grey",variant:"tonal"},c),{default:e(()=>[V(" Hisobotlar ")]),_:2},1040)])]),default:e(()=>[a(s,{class:"py-1"},{default:e(()=>[(_(!0),h(N,null,$(n.report_types,c=>(_(),h("div",null,[(_(),b(I(c.component),{onAddReport:d,report:c},null,40,["report"]))]))),256))]),_:1})]),_:1}),a(z,{class:"mt-4"},{default:e(()=>[a(M,{class:"h-100 d-flex flex-column"},{default:e(()=>[a(w,{modelValue:n.tab,"onUpdate:modelValue":t[0]||(t[0]=c=>n.tab=c)},{default:e(()=>[(_(!0),h(N,null,$(n.report_types,(c,H)=>(_(),b(g,{value:H,class:"text-capitalize"},{default:e(()=>[V(C(c.name),1)]),_:2},1032,["value"]))),256))]),_:1},8,["modelValue"]),a(u,{class:"flex-grow-1"},{default:e(()=>[a(i,{modelValue:n.tab,"onUpdate:modelValue":t[1]||(t[1]=c=>n.tab=c),class:"h-100"},{default:e(()=>[a(x,{value:"one",class:"h-100"},{default:e(()=>[a(S,{ref_key:"monthTable",ref:f,report_id:1},null,512)]),_:1})]),_:1},8,["modelValue"])]),_:1})]),_:1})]),_:1})])}}});export{X as default};
