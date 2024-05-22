<?php
if(isset($_SESSION['tkc'])){
    session_destroy();
   echo '<script>window.location.href = "index.php";</script>';
}

?>