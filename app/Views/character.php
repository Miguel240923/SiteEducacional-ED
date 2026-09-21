<?php $appearance=[];foreach(Game::CATEGORIES as $category=>$label)$appearance[$category]=isset($gear[$category])?Game::variant($gear[$category]):'default'; ?>
<div class="character" data-chapeu="<?=$appearance['chapeu']?>" data-rosto="<?=$appearance['rosto']?>" data-roupa="<?=$appearance['roupa']?>" data-character>
<svg viewBox="0 0 320 380" role="img" aria-label="Personagem com chapéu, rosto e roupa selecionados">
<ellipse cx="160" cy="350" rx="92" ry="15" fill="#080f21" opacity=".5"/>
<circle cx="160" cy="183" r="121" fill="none" stroke="#627bae" stroke-opacity=".2" stroke-dasharray="4 12"/>
<circle cx="160" cy="183" r="98" fill="#7897ed" fill-opacity=".06"/>
<g stroke="#17253e" stroke-width="5" stroke-linejoin="round">
<path d="M125 282h32v56h-42v-15zM163 282h32l10 41v15h-42z" fill="#324461"/>
<path d="M113 328h44v17h-49q-6-9 5-17M163 328h44q11 8 5 17h-49z" fill="#bacce8"/>
<path d="M103 219q-17 2-23 23l-9 34q-1 17 14 20t22-14l11-33M217 219q17 2 23 23l9 34q1 17-14 20t-22-14l-11-33" fill="#efbc99"/>
<path class="character-cloth" d="M118 206q42-16 84 0l26 20-14 34-14-7 4 47q-44 15-88 0l4-47-14 7-14-34z" fill="#6989f5"/>
<path d="M142 199v17q18 15 36 0v-17" fill="#efbc99"/>
<g class="cloth-detail cloth-shirt"><rect x="136" y="248" width="48" height="30" rx="8" fill="#263d7a" stroke="none"/><text x="160" y="269" text-anchor="middle" fill="#cbd9ff" stroke="none" font-size="20" font-family="monospace">C#</text></g>
<g class="cloth-detail cloth-hoodie" fill="none" stroke="#b6a5ff" stroke-width="4"><path d="M124 211q4 29 36 28t36-28M149 235v25m22-25v25M139 278h42"/></g>
<g class="cloth-detail cloth-coat"><path d="M136 209l24 24-21 17-12-36M184 209l-24 24 21 17 12-36" fill="#d0e1ec"/><path d="M160 237v66" fill="none"/><rect x="175" y="260" width="17" height="14" rx="3" fill="#7eaec0" stroke="none"/></g>
<circle cx="103" cy="161" r="14" fill="#efbc99"/><circle cx="217" cy="161" r="14" fill="#efbc99"/>
<rect class="character-face" x="105" y="104" width="110" height="103" rx="42" fill="#f4c6a3"/>
<path d="M106 138q-9-38 27-47 17-21 44-8 39-1 40 49-24-2-39-19-19 28-72 25" fill="#28334c"/>
<g class="face-normal"><ellipse cx="139" cy="159" rx="5" ry="7" fill="#17253e" stroke="none"/><ellipse cx="183" cy="159" rx="5" ry="7" fill="#17253e" stroke="none"/><path d="M149 182q12 10 24 0" stroke-width="4" fill="none" stroke-linecap="round"/><ellipse cx="127" cy="177" rx="9" ry="5" fill="#e58e89" opacity=".45" stroke="none"/><ellipse cx="194" cy="177" rx="9" ry="5" fill="#e58e89" opacity=".45" stroke="none"/></g>
<g class="face-detail face-happy"><path d="M143 178h35q-3 20-17 20t-18-20" fill="#fff" stroke-width="3"/></g>
<g class="face-detail face-nerd" fill="none" stroke="#28334c" stroke-width="5"><rect x="119" y="146" width="34" height="27" rx="9"/><rect x="169" y="146" width="34" height="27" rx="9"/><path d="M153 155h16"/></g>
<g class="face-detail face-robot"><rect x="111" y="140" width="98" height="43" rx="15" fill="#163349"/><path d="M131 158h17m25 0h17" stroke="#69ecd6" stroke-width="6" stroke-linecap="round"/><path d="M148 194h25" stroke="#426680" stroke-width="4"/></g>
<g class="hat-detail hat-classic"><path d="M127 100l-7-57q40-14 80 0l-7 57z" fill="#34405b"/><path d="M126 79h68v20h-68" fill="#aa8bee"/><ellipse cx="160" cy="100" rx="62" ry="12" fill="#34405b"/></g>
<g class="hat-detail hat-crown"><path d="M114 97l-8-48 30 20 24-35 24 35 30-20-8 48z" fill="#f5c65c"/><path d="M115 87h90v17h-90z" fill="#de9b40"/><path d="M160 66l10 12-10 12-10-12z" fill="#80ddce" stroke-width="3"/></g>
<g class="hat-detail hat-cap"><path d="M107 108q0-53 53-53t53 53z" fill="#588bf0"/><path d="M108 101q52-12 105 0l25 15q-57 5-80-7l-50 3z" fill="#86adff"/><path d="M160 57v41" stroke="#9bbcff" stroke-width="3"/><rect x="144" y="76" width="31" height="18" rx="5" fill="#b1cdfd" stroke="none"/></g>
</g></svg></div>
