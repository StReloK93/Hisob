<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;
use App\Models\Organization;
use App\Models\UserRole;


class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProductType::insert([
            ['name' => 'Ximoya vositalari'],
            ['name' => 'Asosiy vositalar'],
        ]);


        Organization::insert([
            ['name' => '1 - sonli Avto korxona' ,'short_name' => 'AK' ,                                                  'code' =>'37' ], //Автобаза №1
            ['name' => "Idoraviy harbiylashtirilgan qo'riqlash otryadi" ,'short_name' => 'IHQO' ,                        'code' =>'44' ], //ВВО
            ['name' => '3 - Gidrometalurgiya zavodi' ,                   'short_name' => 'GMZ - 3' ,                     'code' =>'20' ], //ГМЗ -3
            ['name' => "Temir yo'l sexi" ,'short_name' => 'TYS' ,                                                        'code' =>'32' ], //ЖДЦ
            ['name' => 'Alohida harbiylashlashtirilgan kon qutqaruv punkti' ,'short_name' => 'AHKQP' ,                   'code' =>'60' ], //ОВГСП
            ['name' => "Texnik nazorat bo'limi" ,'short_name' => 'TNB' ,                                                 'code' =>'13' ], //ОТК
            ['name' => 'Tamirlash mexanika sexi' ,'short_name' => 'TMS' ,                                                'code' =>'78' ], //РМЦ
            ['name' => 'Tamirlash qurilish uchastkasi' ,'short_name' => 'TQU' ,                                          'code' =>'71' ], //РСУ
            ['name' => 'Sharqiy ochiq usulda qazib olish koni' ,'short_name' => "Sharqiy koni" ,                         'code' =>'02'],  //Рудник Восточный
            ['name' => 'Daugiztau ochiq usulda qazib olish koni' ,'short_name' => 'Daugiztau koni' ,                     'code' =>'03'],  //Рудник Даугизтау
            ['name' => 'Shimoliy kon boshqarmasi' ,'short_name' => 'SHKB' ,                                              'code' =>'07'],  //СевРу
            ['name' => 'Avtomobil transport boshqarmasi' ,                    'short_name' => 'ATB' ,                    'code' =>'25' ], //УАТ
            ['name' => 'Elektr jihozlarini tamirlash uchastkasi' ,'short_name' => 'EJTU' ,                               'code' =>'08'],  //УРЕО
            ['name' => 'Axborot kommunikatsiya texnologiyalar markazi' , 'short_name' => 'AKTM' ,                        'code' =>'35' ], //ЦИКТ
            ['name' => "Nazorat o'lchov asboblari va avtomatika markazi labaratoriyasi" ,'short_name' => "NO'A va AML" , 'code' =>'33' ], //ЦЛКИПИА
            [
                'name' => "Mehnat sharoitlari nazorati , atrof muhit muhofazasi va tabiy resurslardan oqilona foydalanish markaziy labaratoriyasi" , //ЦЛКУТ
                'short_name' => 'MSHN AMM va TROFML' ,                                                                       'code' =>'45' 
            ],
            ['name' => 'Markaziy moddiy texnika bazasi' ,'short_name' => 'MMTB' ,                                        'code' =>'28' ], //ЦМТБ
            ['name' => "To'g kon jihozlarini tamirlash sexi" ,'short_name' => 'TKJTS' ,                                  'code' =>'27' ], //ЦРГО
            ['name' => 'Tarmoqlar va nimstansiyalar sexi' ,'short_name' => 'TNS' ,                                       'code' =>'29' ], //ЦСиП
            ['name' => 'Issiqlik suv gaz taminoti va kanalizatsiyalar sexi' ,'short_name' => 'ISGTVAKS' ,                'code' =>'31' ], //ЦТВГСиК
            ['name' => 'Markaziy fizika kimyoviy labaratoriyasi' ,'short_name' => 'MFKL' ,                               'code' =>'43' ], //ЦФХЛ
        ]);
        
    }
}
