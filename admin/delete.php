<?php
    if(isset($_POST['delete']))
    {
        $connection=new mysqli("localhost","root","","upahar");
        if($connection->connect_errno!=0)
        {
        echo("Connection Error");
        }
        $hid=$_POST['health_program'];
        $sql="DELETE FROM health_program WHERE hid='$hid'";
        if($result=$connection->query($sql))
        {
        header("location:delete.php");
        }
        else{
        echo("Error");
        }
    }
?>