<template>
   <section class="printer bg-white pa-7">
      <aside class="d-flex justify-space-between pt-4">
         <div class="font-italic border-t border-color">
            ( Tashkilot nomi )
         </div>
         <div class="font-italic">
            Maxsus forma № MB-6a
         </div>
      </aside>
      <aside class="text-center text-h5 font-weight-bold d-flex justify-center  leading-none">
         Shaxsiy varaqa № <div class="border-b border-color" style="width: 100px;"></div>
      </aside>
      <aside class="text-center">
         Shaxsiy himoya vositalarini hisobga olish
      </aside>
      <aside class="leading-none">
         <div class="d-flex pt-3">
            <main class="border-b border-color w-75">
               {{ employe.name }}
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25">
               Jinsi
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               <span class="w-50">
                  Familiya
               </span>
               <span class="w-50">
                  Ismi
               </span>
               <span class="w-50">
                  Sharifi
               </span>
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25">
               Buyi
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="w-75 d-flex">
               <span class="w-25 border-b border-color">Tabel. №</span>
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25">
               Kiyim o'lchami
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Sex va uchastka raqami
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25">
               Oyoq o'lchami
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Lavozim
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25">
               Bosh o'lchami
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Ishga kirgan sanasi
            </main>
            <main style="width: 25px;"></main>
            <main class="w-25"></main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Lavozim o'zgartirilgan sanasi
            </main>
            <main style="width: 25px;"></main>
            <main class="w-25"></main>
         </div>
      </aside>
      <aside>
         <h3>Norma bo'yicha biriktirilgan himoya vositalari</h3>
         <table class="w-100 text-caption" style="border-collapse: collapse;">
            <tr>
               <td class="border border-color py-1 px-1 w-50">Maxsus kiyim nomi</td>
               <td class="border border-color py-1 px-1 w-1-8">Paragraf nomi</td>
               <td class="border border-color py-1 px-1 w-1-8">O'lchov birligi</td>
               <td class="border border-color py-1 px-1 w-1-8">Soni</td>
               <td class="border border-color py-1 px-1 w-1-8">Muddati</td>
            </tr>
            <tr v-for="n in 22">
               <td class="border border-color py-1 px-1 w-50">Salom</td>
               <td class="border border-color py-1 px-1 w-1-8"></td>
               <td class="border border-color py-1 px-1 w-1-8"></td>
               <td class="border border-color py-1 px-1 w-1-8"></td>
               <td class="border border-color py-1 px-1 w-1-8"></td>
            </tr>
         </table>
      </aside>
      <aside class="pt-5">
         <div class="d-flex">
            <span class="border-b border-color w-50">MMvaXT boshlig'i</span>
            <span style="width: 50px;"></span>
            <span class="border-b border-color w-50">Buxgalter</span>
         </div>
         <div class="d-flex pt-2">
            <span class="border-b border-color w-50">MMvaXT muhandisi</span>
            <span style="width: 50px;"></span>
            <span class="w-50"></span>
         </div>
      </aside>
   </section>
</template>

<script setup lang="ts">
import { printStore } from '@/store/useAuthStore'

const print = printStore()
const employe = print.employe
</script>
<style scoped>
:root{
   --v-border-opacity: 1;
}
.printer {
   font-family: 'Times New Roman', Times, serif;
   height: 297mm;
   width: 210mm;
   margin: 0 auto;
}

.border-color{
   border-color: black!important;
}

.w-1-8{
   width: 12.5%;
}

.leading-none{
   line-height: 1;
}

@media print {
   .printer {
      transform: scale(1);
      margin: 0;
   }

   .-top-5 {
      top: 0;
   }
}
</style>