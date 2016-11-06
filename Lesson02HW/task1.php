<?php
// Малахов Максим
// На примере оператора switch вывести его в функцию, дополнить другими действиями.
// Сделать рабочий пример с использованием вашей функции

 function makeachoice($num) {
     switch ($num) {
         case '3':
             echo "Вы ввели три";
             break;
         case '2':
             echo "Вы ввели два";
             break;
         case '1':
             echo "Вы ввели один";
             break;
         default:
             echo "Не выбран ниодин из вариантов";
             break;
     }
 }

 makeachoice(rand(1,4));
