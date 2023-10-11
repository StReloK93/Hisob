import{I as z}from"./IconEdit-efd56ee7.js";import{d as N,a as l,o as g,h as F,F as H,k as M,c as I,l as b,r as E,w as t,b as e,p as G,j as S,g as D,f as R,m as y,n as Y,e as L}from"./app-4c157124.js";import{A as P}from"./ag-grid.css_vue_type_style_index_0_src_true_lang-2707f2bc.js";const J={class:"d-flex item-center"},K=N({__name:"FileIcons",props:["params"],setup(h){return(f,d)=>{const a=l("v-btn");return g(),F("div",J,[(g(!0),F(H,null,M(h.params.value,r=>(g(),I(a,{tag:"a",href:`/files/${r.src}`,target:"_blank",color:"teal",icon:"mdi-file-pdf-box",class:"mr-1",size:"small"},null,8,["href"]))),256))])}}}),O=R("span",null,"Normaviy hujjat kiritish formasi",-1),Q=N({__name:"AddDocument",emits:["addDocument"],setup(h,{emit:f}){const d=b({dialog:!1,rules:[i=>[null,""].includes(i)?"toldiring":!0]}),a=b({name:null,confirm_date:null,description:null,files:[]}),r=E();async function s(){const{valid:i}=await r.value.validate();if(i==!1)return;const n=new FormData;n.append("name",a.name),n.append("confirm_date",a.confirm_date),n.append("description",a.description==null?"":a.description),a.files.forEach(p=>n.append("files[]",p)),console.log(n),y.post("document",n).then(({data:p})=>{d.dialog=!1,f("addDocument",p)})}return(i,n)=>{const p=l("v-btn"),x=l("v-card-title"),c=l("v-textarea"),o=l("v-col"),m=l("v-text-field"),V=l("v-file-input"),v=l("v-row"),j=l("v-container"),k=l("v-card-text"),C=l("v-spacer"),$=l("v-card-actions"),U=l("v-card"),A=l("v-form"),w=l("v-dialog");return g(),I(v,{justify:"end",class:"flex-0-0 ma-0 pb-2 px-4 overflow-y-auto"},{default:t(()=>[e(w,{modelValue:d.dialog,"onUpdate:modelValue":n[6]||(n[6]=u=>d.dialog=u),persistent:"",width:"512",location:"right"},{activator:t(({props:u})=>[e(p,G({icon:"mdi-plus",color:"teal"},u),null,16)]),default:t(()=>[e(A,{ref_key:"formTag",ref:r,onSubmit:S(s,["prevent"]),onVnodeMounted:n[5]||(n[5]=u=>r.value.reset())},{default:t(()=>[e(U,{class:"bg-white"},{default:t(()=>[e(x,{class:"bg-blue-grey-lighten-5"},{default:t(()=>[O]),_:1}),e(k,{class:"pa-0"},{default:t(()=>[e(j,null,{default:t(()=>[e(v,null,{default:t(()=>[e(o,{cols:"12",class:"pt-0"},{default:t(()=>[e(c,{color:"teal",label:"Nomi",variant:"underlined","hide-details":"auto",modelValue:a.name,"onUpdate:modelValue":n[0]||(n[0]=u=>a.name=u),rules:d.rules},null,8,["modelValue","rules"])]),_:1}),e(o,{cols:"12",class:"pt-0"},{default:t(()=>[e(m,{color:"teal",label:"Hujjat tasdiqlangan sana",variant:"underlined","hide-details":"auto",modelValue:a.confirm_date,"onUpdate:modelValue":n[1]||(n[1]=u=>a.confirm_date=u),type:"date",rules:d.rules},null,8,["modelValue","rules"])]),_:1}),e(o,{cols:"12",class:"pt-0"},{default:t(()=>[e(V,{chips:"",variant:"underlined",modelValue:a.files,"onUpdate:modelValue":n[2]||(n[2]=u=>a.files=u),"hide-details":"auto",multiple:"",label:"Normaviy hujjatlar",rules:d.rules},null,8,["modelValue","rules"])]),_:1}),e(o,{cols:"12",class:"pt-0"},{default:t(()=>[e(c,{color:"teal",label:"Izoh",variant:"underlined","hide-details":"auto",modelValue:a.description,"onUpdate:modelValue":n[3]||(n[3]=u=>a.description=u)},null,8,["modelValue"])]),_:1})]),_:1})]),_:1})]),_:1}),e($,null,{default:t(()=>[e(C),e(p,{color:"blue-gray-1",variant:"text",type:"button",onClick:n[4]||(n[4]=u=>d.dialog=!1)},{default:t(()=>[D(" Yopish ")]),_:1}),e(p,{color:"blue-darken-1",variant:"text",type:"submit"},{default:t(()=>[D(" Saqlash ")]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1},8,["modelValue"])]),_:1})}}}),W=R("span",null,"Normaviy hujjat tahrirlash formasi",-1),X=N({__name:"EditDocument",props:["current"],emits:["editDocument"],setup(h,{expose:f,emit:d}){const{current:a}=h,r=b({dialog:!1,rules:[c=>[null,""].includes(c)?"toldiring":!0]}),s=b({name:null,confirm_date:null,description:null,files:[]}),i=E();async function n(){const{valid:c}=await i.value.validate();if(c==!1)return;const o=new FormData;o.append("name",s.name),o.append("confirm_date",s.confirm_date),o.append("description",s.description==null?"":s.description),s.files.forEach(m=>{m.type?o.append("files[]",m):o.append("files[]",m.id)}),console.log(a),y.post(`document/${a.selected}`,o).then(({data:m})=>{r.dialog=!1,d("editDocument",m)})}function p(c){y.get(`/document/${c}`).then(({data:o})=>{s.name=o.name,s.confirm_date=o.confirm_date,s.description=o.description,o.files.forEach(m=>m.name=m.src),s.files=o.files})}return Y(()=>r.dialog,c=>{c?p(a.selected):i.value.reset()}),f({toggle:()=>r.dialog=!0}),(c,o)=>{const m=l("v-card-title"),V=l("v-textarea"),v=l("v-col"),j=l("v-text-field"),k=l("v-file-input"),C=l("v-row"),$=l("v-container"),U=l("v-card-text"),A=l("v-spacer"),w=l("v-btn"),u=l("v-card-actions"),T=l("v-card"),B=l("v-form"),q=l("v-dialog");return g(),I(q,{modelValue:r.dialog,"onUpdate:modelValue":o[5]||(o[5]=_=>r.dialog=_),persistent:"",width:"512",location:"right"},{default:t(()=>[e(B,{ref_key:"formTag",ref:i,onSubmit:S(n,["prevent"])},{default:t(()=>[e(T,{class:"bg-white"},{default:t(()=>[e(m,{class:"bg-blue-grey-lighten-5"},{default:t(()=>[W]),_:1}),e(U,{class:"pa-0"},{default:t(()=>[e($,null,{default:t(()=>[e(C,null,{default:t(()=>[e(v,{cols:"12",class:"pt-0"},{default:t(()=>[e(V,{color:"teal",label:"Nomi",variant:"underlined","hide-details":"auto",modelValue:s.name,"onUpdate:modelValue":o[0]||(o[0]=_=>s.name=_),rules:r.rules},null,8,["modelValue","rules"])]),_:1}),e(v,{cols:"12",class:"pt-0"},{default:t(()=>[e(j,{color:"teal",label:"Hujjat tasdiqlangan sana",variant:"underlined","hide-details":"auto",modelValue:s.confirm_date,"onUpdate:modelValue":o[1]||(o[1]=_=>s.confirm_date=_),type:"date",rules:r.rules},null,8,["modelValue","rules"])]),_:1}),e(v,{cols:"12",class:"pt-0"},{default:t(()=>[e(k,{chips:"",variant:"underlined",modelValue:s.files,"onUpdate:modelValue":o[2]||(o[2]=_=>s.files=_),"hide-details":"auto","item-value":"src",multiple:"",label:"Normaviy hujjatlar"},null,8,["modelValue"])]),_:1}),e(v,{cols:"12",class:"pt-0"},{default:t(()=>[e(V,{color:"teal",label:"Izoh",variant:"underlined","hide-details":"auto",modelValue:s.description,"onUpdate:modelValue":o[3]||(o[3]=_=>s.description=_)},null,8,["modelValue"])]),_:1})]),_:1})]),_:1})]),_:1}),e(u,null,{default:t(()=>[e(A),e(w,{color:"blue-gray-1",variant:"text",type:"button",onClick:o[4]||(o[4]=_=>r.dialog=!1)},{default:t(()=>[D(" Yopish ")]),_:1}),e(w,{color:"blue-darken-1",variant:"text",type:"submit"},{default:t(()=>[D(" Saqlash ")]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"])]),_:1},8,["modelValue"])}}}),Z={class:"d-flex flex-column"},ee={class:"d-flex justify-space-between items-center"},ne=N({__name:"MainDocuments",setup(h){const f=E(),d=b({gridApi:null,Document:[],selected:null});function a(i){d.gridApi.applyTransaction({add:[i]})}function r(i){d.gridApi.getRowNode(i.id).setData(i)}const s=b([{field:"id",headerName:"№",width:65},{field:"name",headerName:"Nomi",flex:1},{field:"files",headerName:"Hujjatlar",cellRenderer:K,valueFormatter:null,cellClass:["d-flex","align-center"]},{field:"confirm_date",headerName:"Tasdiqdan o'tgan sana"},{field:"description",headerName:"Izoh"},{cellClass:["d-flex","justify-center","align-center","px-2","bg-gray-100"],headerName:"",width:60,cellRenderer:z,headerClass:["px-2"],onCellClicked:({data:i})=>{d.selected=i.id,f.value.toggle()}}]);return y.get("document").then(({data:i})=>d.Document=i),(i,n)=>{const p=l("Breadcrumbs"),x=l("v-spacer");return g(),F("section",Z,[R("div",ee,[e(p),e(Q,{onAddDocument:a}),e(X,{onEditDocument:r,ref_key:"editComponent",ref:f,current:d},null,8,["current"])]),e(x,{class:"px-4"},{default:t(()=>[e(L(P),{headerHeight:34,class:"ag-theme-material h-100",getRowId:({data:c})=>c.id,columnDefs:s,rowData:d.Document,onGridReady:n[0]||(n[0]=c=>d.gridApi=c.api),animateRows:"true"},null,8,["getRowId","columnDefs","rowData"])]),_:1})])}}});export{ne as default};
