(()=>{"use strict";var e={n:t=>{var c=t&&t.__esModule?()=>t.default:()=>t;return e.d(c,{a:c}),c},d:(t,c)=>{for(var a in c)e.o(c,a)&&!e.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:c[a]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.element,c=window.wp.apiFetch;var a=e.n(c);const r=e=>{const{dataAttributes:c}=e,[r,n]=(0,t.useState)({block_id:0,post_id:0,word:"",checked:!1}),[s,l]=(0,t.useState)(!1),[o,d]=(0,t.useState)(null);(0,t.useEffect)((()=>{n({...c})}),[]);const{block_id:i,word:u,checked:m}=r;return(0,t.useEffect)((()=>{if(null===o)return;const e=setTimeout((()=>{d(null)}),250);return()=>clearTimeout(e)}),[o]),(0,t.createElement)(t.Fragment,null,(0,t.createElement)("input",{"data-checked":m,id:i+"-input",name:i+"-input",type:"checkbox",checked:m,onChange:e=>{n({...r,checked:e.target.checked}),(async()=>{l(!0),d(null);const e=await a()({path:`${initDecks.route}/${c.post_id}`,method:"POST",data:{...r,checked:!m}}).then((e=>(c.checked=!m,{type:"success",message:e}))).catch((e=>({type:"error",message:e.message})));l(!1),d(e)})()}}),(0,t.createElement)("label",{className:"form-check-label",htmlFor:i+"-input"},u),null!==o&&(0,t.createElement)("span",{className:`notice ${o.type}`,role:"error"===o.type?"alert":"status"},o.message,(0,t.createElement)("svg",{className:"spinner"},(0,t.createElement)("circle",{cx:"10",cy:"10",r:"7"}))))};document.querySelectorAll(".wp-block-strategydeck-deck-card").forEach((e=>{const c={block_id:e.dataset.id,post_id:parseInt(e.dataset.post_id,10),word:e.firstElementChild.nextElementSibling.innerHTML,checked:e.firstElementChild.checked};(0,t.render)((0,t.createElement)(r,{dataAttributes:c}),e)}))})();