<?php
include 'C:/Users/User/PhpstormProjects/Forms/Cards/Controller/functions.php';
if(isset($_POST["submit"]))
{
    WorkWithCards($_POST, "", "AddToSQLBase"); //Action for File - AddToFile, for SQL - AddToSQLBase
}
else if(isset($_POST["DeleteCard"]))
{
    WorkWithCards($_POST, $_POST["ID"], "DeleteFromSQLBase");   //Action for File - DeleteFromFile, for SQL - DeleteFromSQLBase
}
else if(isset($_POST["CorrectCard"]))
{
    WorkWithCards($_POST, $_POST["ID"], "UpdateSQLBase");
}
else
{
    ViewCardsBootstrap(WorkWithSQLBase("", "selectAll"), false);
}