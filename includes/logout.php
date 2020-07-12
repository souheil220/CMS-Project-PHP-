<?php session_start()?>

<?php 
   
            $_SESSION['username'] = null;
            $_SESSION['firstName'] = null;
            $_SESSION['lastName'] = null;  
            $_SESSION['role'] = null;  

            header("Location: ../index.php");
      
?>