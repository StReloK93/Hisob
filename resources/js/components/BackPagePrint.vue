<template>
   <section class="printer bg-white pa-7">
      <aside class="pt-4 Heading text-subtitle-1 text-center" style="letter-spacing: 1px!important;">
         Shaxsiy himoya vositalarini oldi berdi varaqasi
      </aside>
      <table class="w-100" style="border-collapse: collapse;">
         <tr class="leading-none">
            <td colspan="2" class="border border-color pa-1">Himoya vositalari turi</td>
            <td colspan="4" class="border border-color pa-1">Berilgan</td>
            <td colspan="4" class="border border-color pa-1">Qaytarilgan</td>
         </tr>
         <tr class="leading-none">
            <td class="border border-color pa-1" style="width: 220px;">Nomi</td>
            <td class="border border-color pa-1 text-center" style="width: 75px;">Nomk №</td>
            <td class="border border-color pa-1 vertical-text">Sana </td>
            <td class="border border-color pa-1 vertical-text" style="width: 13px;">Dona </td>
            <td class="border border-color pa-1 vertical-text" style="width: 90px;">Narxi </td>
            <td class="border border-color pa-1 vertical-text" style="width: 50px;">vaqti <br> RFID </td>
            <td class="border border-color pa-1 vertical-text" style="width: 65px;">Sana </td>
            <td class="border border-color pa-1 vertical-text" style="width: 13px;">Dona </td>
            <td class="border border-color pa-1 vertical-text" style="width: 50px;">vaqti <br> RFID </td>
            <td class="border border-color pa-1 vertical-text" style="width: 50px;">imzosi <br> Omborchi </td>
         </tr>
         <tr class="leading-none text-center">
            <td class="border border-color px-1">1</td>
            <td class="border border-color px-1">2</td>
            <td class="border border-color px-1">3</td>
            <td class="border border-color px-1">4</td>
            <td class="border border-color px-1">5</td>
            <td class="border border-color px-1">6</td>
            <td class="border border-color px-1">7</td>
            <td class="border border-color px-1">8</td>
            <td class="border border-color px-1">9</td>
            <td class="border border-color px-1">10</td>
         </tr>
         <tr v-for="n in 39" class="leading-none text-center">
            <td class="border border-color pa-1"></td>
            <td class="border border-color pa-1"></td>
            <td class="border border-color pa-1"></td>
            <td class="border border-color pa-1"></td>
            <td class="border border-color pa-1"></td>
            <td class="border border-color pa-1"></td>
            <td class="border border-color pa-1" colspan="4">salom</td>
         </tr>
      </table>
   </section>
</template>

<script setup lang="ts">
import { printStore } from '@/store/useAuthStore'

const print = printStore()
const employe = print.employe
</script>
<style scoped>
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
   line-height: 0.9;
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