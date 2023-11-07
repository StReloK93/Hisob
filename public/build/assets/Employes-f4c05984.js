import{_ as w}from"./Icon.vue_vue_type_script_setup_true_lang-e3be8bfc.js";import{d as x,a as s,o as V,c as z,w as m,e as t,g as h,m as f,l as y,n as A,p as I,u as B,r as C,q as j,h as F,b as k,i as $}from"./app-e1f887ff.js";import{r as v}from"./helpers-ca74a7fa.js";const E=x({__name:"FormInputs",props:["formData","pageData"],setup(l){const{formData:d,pageData:r}=l;function c(){d.table_number.length==5&&(r.inputLoading=!0,u())}function u(){f.get(`employe/getdata/${d.table_number}`).then(({data:o})=>{d.name=o.name,d.organization_id=o.organization_id,d.profession=o.profession,d.hiring_date=o.hiring_date,setTimeout(()=>r.inputLoading=!1,1e3)}).catch(()=>{r.inputLoading=!1})}return(o,a)=>{const g=s("v-text-field"),b=s("v-autocomplete"),e=s("v-col"),i=s("v-radio"),p=s("v-radio-group"),D=s("v-row");return V(),z(D,null,{default:m(()=>[t(e,{cols:"12",class:"pt-0"},{default:m(()=>[t(g,{class:"mb-2",onInput:c,loading:l.pageData.inputLoading,rules:h(v),label:"Tabel raqam",modelValue:l.formData.table_number,"onUpdate:modelValue":a[0]||(a[0]=n=>l.formData.table_number=n),type:"number"},null,8,["loading","rules","modelValue"]),t(g,{class:"mb-2",rules:h(v),label:"F.I.SH",modelValue:l.formData.name,"onUpdate:modelValue":a[1]||(a[1]=n=>l.formData.name=n)},null,8,["rules","modelValue"]),t(b,{class:"mb-2",items:l.pageData.organizations,modelValue:l.formData.organization_id,"onUpdate:modelValue":a[2]||(a[2]=n=>l.formData.organization_id=n),label:"Ish joyi","item-title":"short_name","item-value":"id",rules:h(v)},null,8,["items","modelValue","rules"]),t(b,{class:"mb-2",items:l.pageData.positions,modelValue:l.formData.position_id,"onUpdate:modelValue":a[3]||(a[3]=n=>l.formData.position_id=n),label:"Meyoriy hujjatdagi lavozimi (kasbi)","item-title":"name",rules:h(v),"item-value":"id"},null,8,["items","modelValue","rules"]),t(g,{class:"mb-2",label:"Lavozimi (kasbi)",modelValue:l.formData.profession,"onUpdate:modelValue":a[4]||(a[4]=n=>l.formData.profession=n),rules:h(v)},null,8,["modelValue","rules"]),t(g,{class:"mb-2",label:"Ushbu lavozim (kasb)ga tayinlangan kuni",modelValue:l.formData.hiring_date,"onUpdate:modelValue":a[5]||(a[5]=n=>l.formData.hiring_date=n),type:"date",rules:h(v)},null,8,["modelValue","rules"])]),_:1}),t(e,{cols:"6"},{default:m(()=>[t(g,{class:"mb-2",label:"Bo'yi",modelValue:l.formData.heigth,"onUpdate:modelValue":a[6]||(a[6]=n=>l.formData.heigth=n)},null,8,["modelValue"]),t(g,{class:"mb-2",label:"Kiyim o'lchami",modelValue:l.formData.size_cloth,"onUpdate:modelValue":a[7]||(a[7]=n=>l.formData.size_cloth=n)},null,8,["modelValue"])]),_:1}),t(e,{cols:"6"},{default:m(()=>[t(g,{class:"mb-2",label:"Bosh o'lchami",modelValue:l.formData.size_head,"onUpdate:modelValue":a[8]||(a[8]=n=>l.formData.size_head=n)},null,8,["modelValue"]),t(g,{class:"mb-2",label:"Oyoq kiyim o'lchami",modelValue:l.formData.size_shoes,"onUpdate:modelValue":a[9]||(a[9]=n=>l.formData.size_shoes=n)},null,8,["modelValue"])]),_:1}),t(e,{cols:"12"},{default:m(()=>[t(p,{small:"",modelValue:l.formData.gender,"onUpdate:modelValue":a[10]||(a[10]=n=>l.formData.gender=n),rules:h(v)},{default:m(()=>[t(i,{label:"Erkak",value:!0}),t(i,{label:"Ayol",value:!1})]),_:1},8,["modelValue","rules"])]),_:1})]),_:1})}}}),L=x({__name:"AddEmploye",emits:["addEmploye"],setup(l,{emit:d}){const r=y({dialog:!1,organizations:null,positions:null,inputLoading:!1}),c=y({table_number:null,name:null,position_id:null,hiring_date:null,profession:null,gender:!1,heigth:null,size_cloth:null,size_head:null,size_shoes:null,organization_id:null});async function u(){await f.post("employe",c).then(({data:o})=>{r.dialog=!1,d("addEmploye",o)})}return f.all([f.get("accessOrganizations"),f.get("position")]).then(f.spread(({data:o},{data:a})=>{r.organizations=o,r.positions=a})),(o,a)=>{const g=s("v-btn"),b=s("CustomForm"),e=s("v-dialog"),i=s("v-row");return V(),z(i,{justify:"end",class:"flex-0-0 ma-0 pb-2 px-4 overflow-y-auto"},{default:m(()=>[t(e,{modelValue:r.dialog,"onUpdate:modelValue":a[1]||(a[1]=p=>r.dialog=p),persistent:"",width:"768",location:"right"},{activator:m(({props:p})=>[t(g,A({icon:"mdi-plus",color:"teal"},p),null,16)]),default:m(()=>[t(b,{submitMethod:u,onClose:a[0]||(a[0]=p=>r.dialog=!1),title:"Xodim kiritish",height:"700px"},{default:m(()=>[t(E,{formData:c,pageData:r},null,8,["formData","pageData"])]),_:1})]),_:1},8,["modelValue"])]),_:1})}}}),q=x({__name:"EditEmploye",props:["current"],emits:["editEmploye"],setup(l,{expose:d,emit:r}){const{current:c}=l,u=y({dialog:!1,organizations:null,positions:null}),o=y({table_number:null,name:null,position_id:null,hiring_date:null,profession:null,gender:null,heigth:null,size_cloth:null,size_head:null,size_shoes:null,organization_id:null});function a(){f.get(`employe/${c.selected}`).then(({data:e})=>{const i=e.position.at(-1);i&&(o.position_id=i.position.id),o.table_number=e.table_number,o.name=e.name,o.hiring_date=e.hiring_date,o.gender=e.gender,o.heigth=e.heigth,o.profession=e.profession,o.size_cloth=e.size_cloth,o.size_head=e.size_head,o.size_shoes=e.size_shoes,o.organization_id=e.organization_id})}async function g(){await f.patch(`employe/${c.selected}`,o).then(({data:e})=>{u.dialog=!1,r("editEmploye",e)})}return f.all([f.get("accessOrganizations"),f.get("position")]).then(f.spread(({data:e},{data:i})=>{u.organizations=e,u.positions=i})),I(()=>u.dialog,e=>{e&&a()}),d({toggle:()=>u.dialog=!0}),(e,i)=>{const p=s("CustomForm"),D=s("v-dialog");return V(),z(D,{modelValue:u.dialog,"onUpdate:modelValue":i[1]||(i[1]=n=>u.dialog=n),persistent:"",width:"768",location:"right"},{default:m(()=>[t(p,{submitMethod:g,onClose:i[0]||(i[0]=n=>u.dialog=!1),title:"Xodim kiritish",height:"700px"},{default:m(()=>[t(E,{formData:o,pageData:u},null,8,["formData","pageData"])]),_:1})]),_:1},8,["modelValue"])}}});function T(l){return l?"Erkak":"Ayol"}const O={class:"d-flex flex-column"},S={class:"d-flex justify-space-between items-center"},G={class:"px-4 mb-2"},K=x({__name:"Employes",setup(l){const d=B(),r=C(),c=y({gridApi:null,selected:null});function u(e){c.gridApi.applyTransaction({add:[e],addIndex:0})}function o(e){c.gridApi.getRowNode(e.id).setData(e)}const a=j(),g=y([{field:"table_number",headerName:"Tabel №",sortable:!0,width:65,headerClass:["px-2"],cellClass:["px-2"]},{field:"name",headerName:"F.I.SH",sortable:!0,flex:1,minWidth:275},{field:"organization.short_name",headerName:"Ish joyi",sortable:!0},{field:"position",headerName:"Lavozimi",sortable:!0,valueFormatter:e=>e.value.at(-1)?e.value.at(-1).position.name:""},{field:"hiring_date",headerName:"Ishga qabul kuni",sortable:!0,width:160},{field:"gender",headerName:"Jinsi",cellRenderer:e=>T(e.value),sortable:!0,width:60,headerClass:["px-2"],cellClass:["px-2"]},{field:"heigth",headerName:"Bo'yi (sm)",sortable:!0,width:85,headerClass:["px-2"],cellClass:["px-2"]},{field:"size_head",headerName:"Bosh o'lch..",sortable:!0,width:105,headerClass:["px-2"],cellClass:["px-2"]},{field:"size_cloth",headerName:"Kiyim o'lch..",sortable:!0,width:105,headerClass:["px-2"],cellClass:["px-2"]},{field:"size_shoes",headerName:"Oyoq kiyim o'lch..",sortable:!0,width:125,headerClass:["px-2"],cellClass:["px-2"]},{hide:(d.userRoles.includes(4)||d.userRoles.includes(1))==!1,cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],headerName:"",width:60,cellRenderer:w,cellRendererParams:{icon:"mdi-eye-outline"},headerClass:["px-2"],onCellClicked:({data:e})=>a.push({name:"employe",params:{id:e.id}})},{hide:(d.userRoles.includes(4)||d.userRoles.includes(1))==!1,cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],headerName:"",width:60,cellRenderer:w,cellRendererParams:{icon:"mdi-pencil-outline"},headerClass:["px-2"],onCellClicked:({data:e})=>{c.selected=e.id,r.value.toggle()}}]),b=C([]);return f.get("employe").then(({data:e})=>b.value=e),(e,i)=>{const p=s("Breadcrumbs"),D=s("v-text-field"),n=s("v-col"),N=s("v-row"),R=s("AgGridVue"),U=s("v-spacer");return V(),F("main",O,[k("div",S,[t(p),h(d).userRoles.includes(4)||h(d).userRoles.includes(1)?(V(),z(L,{key:0,onAddEmploye:u})):$("",!0),t(q,{onEditEmploye:o,ref_key:"editComponent",ref:r,current:c},null,8,["current"])]),k("div",G,[t(N,{class:"d-flex justify-end"},{default:m(()=>[t(n,{cols:"3"},{default:m(()=>[t(D,{"prepend-inner-icon":"mdi-magnify",onInput:i[0]||(i[0]=_=>c.gridApi.setQuickFilter(_.target.value)),label:"Qidiruv"})]),_:1})]),_:1})]),t(U,{class:"px-4"},{default:m(()=>[t(R,{class:"ag-theme-material h-100",headerHeight:34,getRowId:({data:_})=>_.id,columnDefs:g,rowData:b.value,onGridReady:i[1]||(i[1]=_=>c.gridApi=_.api),onRowDoubleClicked:i[2]||(i[2]=_=>h(a).push({name:"employe",params:{id:_.data.id}})),animateRows:"true"},null,8,["getRowId","columnDefs","rowData"])]),_:1})])}}});export{K as default};
