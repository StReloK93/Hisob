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
      <aside class="text-center text-h5 font-weight-bold d-flex justify-center leading-none">
         Shaxsiy varaqa № <div class="border-b border-color" style="width: 100px;"></div>
      </aside>
      <aside class="text-center">
         Shaxsiy himoya vositalarini hisobga olish
      </aside>
      <aside class="leading-none">
         <div class="d-flex pt-3">
            <main class="border-b border-color w-75">
               <b>
                  {{ employe.name }}
               </b>
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25 d-flex justify-space-between">
               <span>Jinsi</span>
               <b>{{ employe.gender ? 'Erkak' : 'Ayol' }}</b> 
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
            <main class="border-b border-color w-25  d-flex justify-space-between">
               <span>Buyi</span>
               <b>{{ employe.heigth }}</b> 
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="w-75 d-flex">
               <span class="w-25 border-b border-color d-flex justify-space-between">
                  <span>
                     Tabel. №
                  </span>
                  <b>
                     {{ employe.table_number }}
                  </b>
                  </span>
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25  d-flex justify-space-between">
               <span>Kiyim o'lchami</span>
               <b>{{ employe.size_cloth }}</b> 
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Sex va uchastka raqami
               <b class="ml-4">
                  {{ employe.organization.name }}
               </b>
            </main>
            <main style="width: 25px;"></main>
            <main class="border-b border-color w-25  d-flex justify-space-between">
               <span>Oyoq o'lchami</span>
               <b>{{ employe.size_shoes }}</b> 
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Lavozim <b class="ml-4">{{ employe.position[0]?.position.name }}</b> 
            </main>
            <main style="width: 25px;"></main>

            <main class="border-b border-color w-25 d-flex justify-space-between">
               <span>Bosh o'lchami</span>
               <b>{{ employe.size_head }}</b> 
            </main>
         </div>
         <div class="d-flex pt-2">
            <main class="border-b border-color w-75 d-flex">
               Ishga kirgan sanasi
               <b class="ml-4">{{ employe.hiring_date }}</b> 
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
               <td class="border border-color py-0.5 px-1 w-50">Maxsus kiyim nomi</td>
               <td class="border border-color py-0.5 px-1 w-1-8">Paragraf nomi</td>
               <td class="border border-color py-0.5 px-1 w-1-8">O'lchov birligi</td>
               <td class="border border-color py-0.5 px-1 w-1-8">Soni</td>
               <td class="border border-color py-0.5 px-1 w-1-8">Muddati</td>
            </tr>
            <tr v-for="item in employe.position[0].position.products">
               <td class="border border-color py-0.5 px-1 w-50">{{ item.product.name }}</td>
               <td class="border border-color py-0.5 px-1 w-1-8">
                  {{ employe.position[0].position.position_type_id }}
                  -
                  {{ employe.position[0].position.number_in_document }}</td>
               <td class="border border-color py-0.5 px-1 w-1-8">Dona</td>
               <td class="border border-color py-0.5 px-1 w-1-8">{{ item.count }}</td>
               <td class="border border-color py-0.5 px-1 w-1-8">{{ item.expiration_date }}</td>
            </tr>
            <tr v-for="item in 30 - employe.position[0].position.products.length">
               <td class="border border-color py-0.5 px-1 w-50"> <span class="opacity-0">|</span></td>
               <td class="border border-color py-0.5 px-1 w-1-8"></td>
               <td class="border border-color py-0.5 px-1 w-1-8"></td>
               <td class="border border-color py-0.5 px-1 w-1-8"></td>
               <td class="border border-color py-0.5 px-1 w-1-8"></td>
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
console.log(employe)

</script>
<style scoped>
.opacity-0{
   opacity: 0;
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