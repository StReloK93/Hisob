<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\ProductType;
use App\Models\Organization;
use App\Models\UserOrganization;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\User;
use App\Models\Position;
use App\Models\Product;
use App\Models\Document;
use App\Models\MainDocument;
use App\Models\MainDocumentFiles;
use App\Models\WorkingCondition;
Use Hash;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $document = MainDocument::create([
            'name' => 'Нормы бесплатной выдачи спецодежды, спецобуви и других средств индивидуальной защиты работникам',
            'confirm_date' => '2014-01-11',
            'description' => '',
        ]);

        MainDocumentFiles::create([
            'main_document_id' => $document->id,
            'src' => '116970243050.pdf',
        ]);


        Role::insert([
            [ 'name' => 'admin' ],
            [ 'name' => 'omborchi' ],
            [ 'name' => 'buxgalter' ],
            [ 'name' => 'tb' ],
        ]);

        $user = User::create([
            'name' => 'Soliyev Aziz',
            'login' => 'admin',
            'password' => Hash::make('zzzz1111*'),
        ]);

        UserRole::insert([
            [ 'user_id' => $user->id, 'role_id' => 1 ],
            [ 'user_id' => $user->id, 'role_id' => 2 ],
            [ 'user_id' => $user->id, 'role_id' => 3 ],
            [ 'user_id' => $user->id, 'role_id' => 4 ],
        ]);

        UserOrganization::insert([
            [ 'user_id' => $user->id, 'organizations_id' => 1],
            [ 'user_id' => $user->id, 'organizations_id' => 2],
            [ 'user_id' => $user->id, 'organizations_id' => 3],
            [ 'user_id' => $user->id, 'organizations_id' => 4],
        ]);

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
            ['name' => 'Uchquduq Axborot kommunikatsiya texnologiyalar markazi' , 'short_name' => 'UAKTM' ,                        'code' =>'16' ], //ЦИКТ
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
        
        Product::factory(17)->state(new Sequence(
            [ 'name' => 'Костюм кислотостойкий','product_type_id' => 1 ],
            [ 'name' => 'Ботинки кожаные с металлическим подноском', 'product_type_id' => 1],
            [ 'name' => "Сапоги резиновые с металлическим подноском", 'product_type_id' => 1 ],
            [ 'name' => 'Фартук из полимерных материалов', 'product_type_id' => 1 ],
            [ 'name' => 'Перчатки кислото-щелочностойкие', 'product_type_id' => 1 ],
            [ 'name' => 'Перчатки диэлектрические', 'product_type_id' => 1 ],
            [ 'name' => 'Галоши диэлектрические', 'product_type_id' => 1 ],
            [ 'name' => 'Очки защитные', 'product_type_id' => 1 ],
            [ 'name' => 'Респиратор (противогазоаэрозольный)', 'product_type_id' => 1 ],
            [ 'name' => 'Нарукавники кислотостойкие', 'product_type_id' => 1 ],
            [ 'name' => 'Портянки или носки хлопчатобумажные', 'product_type_id' => 1 ],
            [ 'name' => 'Бельё нательное', 'product_type_id' => 1 ],
            [ 'name' => 'Куртка на утепляющей прокладке', 'product_type_id' => 1 ],
            [ 'name' => 'Каска защитная с подшлемником', 'product_type_id' => 1 ],
            [ 'name' => 'Самоспасатель', 'product_type_id' => 1 ],
            [ 'name' => 'Лампа шахтёрская', 'product_type_id' => 1 ],
            [ 'name' => 'Портянки суконные', 'product_type_id' => 1 ],
        ))->create();


        Position::factory(5)->state(new Sequence(
            [ 'name' => 'Аккумуляторщик','main_document_id' => 1, 'number_in_document' => 1, 'position_type_id' => 1],
            [ 
                'name' => 'Аппаратчик станции приготовления питьевой воды на опреснительных установках; Аппаратчик химводоочистки; Аппаратчик очистки сточных вод; Аппаратчик гидрохлорирования',
                'main_document_id' => 1, 'number_in_document' => 2, 'position_type_id' => 1
            ],
            [ 'name' => 'Архивариус','main_document_id' => 1, 'number_in_document' => 3, 'position_type_id' => 1],
            [ 'name' => 'Аэродромный рабочий ','main_document_id' => 1, 'number_in_document' => 4, 'position_type_id' => 1],
            [ 'name' => 'Библиотекарь','main_document_id' => 1, 'number_in_document' => 5, 'position_type_id' => 1],
        ))->create();


        WorkingCondition::insert([
            [ 'name' => 'На постоянной основе' ],
            [ 'name' => 'При работе на производственных рабочих местах'],
            [ 'name' => 'При наружных работах зимой или в не отапливаемых помещениях' ],
            [ 'name' => 'При работе во влажных условиях' ],
            [ 'name' => 'При работе с вибратором' ],
            [ 'name' => 'При работе по зачистке снега и канавы'],
            [ 'name' => 'При работах в подземных условиях']
        ]);




    }
}
