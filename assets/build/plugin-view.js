(()=>{"use strict";const e=window.wp.element,t=t=>{const{dataAttributes:l}=t,[o,r]=(0,e.useState)({block_id:0,style:"",word:""}),[c,n]=(0,e.useState)(!1),[s,d]=(0,e.useState)(null);return(0,e.useEffect)((()=>{r({...l})}),[]),(0,e.useEffect)((()=>{if(null===s)return;const e=setTimeout((()=>{d(null)}),6e4);return()=>clearTimeout(e)}),[s]),(0,e.createElement)("div",{id:o.block_id,style:{color:o.style.color,backgroundColor:o.style.backgroundColor}},(0,e.createElement)("label",{className:"form-check-label",htmlFor:o.block_id+"-input"},o.word),(0,e.createElement)("input",{id:o.block_id+"-input",name:o.block_id+"-input",type:"checkbox"}))};document.querySelectorAll(".wp-block-strategydeck-deck-card").forEach((l=>{const o={block_id:l.dataset.id,post_id:parseInt(l.dataset.post_id,10),style:l.style,word:l.firstElementChild.innerHTML};(0,e.render)((0,e.createElement)(t,{dataAttributes:o}),l)}))})();