{{-- @extends('layouts.app') --}}
<div class="auth">
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                                    @include('layouts.navigation')
                                    @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
            
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
<?php
function otrab($n,$k) {
return (strtotime($k)-strtotime($n))/86400;
 }
function na4isleniya($zp) {
    return array_sum($zp);
}
//    НИЖЕ можно менять
 $n='21-10-2022';   //  начало каденции 
$k='04-11-2022';    //  конец каденции
$salary=70; //зарплата сутки
$ost=403; //остаток с прошлой каденции 
$zp=[
        '20-10'=>300,
        '25-10'=>400,
        '27-10'=>413,
        '03-10'=>324,
        // '14-07'=>300,
        // '14-07/1'=>139,
        // '20-07'=>-30,//дозагрузка'
        // '22-07'=>400,
        // '28-07'=>400,
        // '04-08'=>403,
        // '12-08'=>402,
        // '16-08'=>-30,
        // '19-08'=>350,
        // '26-08'=>350,
        // '01-09'=>-30,//догруз
        // '02-09'=>350,
        // '09-09'=>455,
        // '14-09'=>1200,
    ];
///  ВЫШЕ можно менять
$na4isl=na4isleniya($zp);
$otrab=otrab($n,$k)+1;  //не включает один день.т.к.считает с 0 00 до 0 00
$dolg=($otrab*$salary+$ost)-$na4isl;
echo '<b>na4alo kadencii: </b>'.$n.'<br>'.'<b>konec kadencii: </b>'.$k.'<hr>';
echo 'otrabotano za kadenciu  '.$otrab.'<hr>';
echo 'zarabotano za kadenciu  '.($otrab*$salary).'<hr>';
echo 'ostatok s prowloj kadencii  '.$ost.'<hr>';  
echo 'na4isleno (za minusom pokupok za nali4nye)  '.$na4isl.'<hr>'.'<hr>';
 //echo 'doplata s 01-01-2022==  '.'<b>130</b>'.'<hr>';
echo '<b>ostatok itogo:  '.'<i>'.$dolg.'</i>'.'</b>'.'<hr>'.'<hr>';

echo '<ul>';
foreach ($zp as $key => $value) {
    echo '<li>'.$key.' =>   '.' <b>'.$value.'</b>'.'</li>';
}echo '</ul>';
?>