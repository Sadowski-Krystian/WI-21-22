<?php


require '../libs/Smarty.class.php';
$smarty = new Smarty;
$smarty->assign("Name", "Krystian", true);
$smarty->assign("Surname", "Sadowski", true);
$smarty->assign("Class", "3PT4", true);
$smarty->assign("Group", "Second", true);

$smarty->assign("StudentsName", array("Radosław", "Oleksandr", "Kamil"));
$smarty->assign("StudentsSurname", array("Rogalski", "Melnichuk", "Mechring"));



$smarty->display('mypage.tpl');

?>