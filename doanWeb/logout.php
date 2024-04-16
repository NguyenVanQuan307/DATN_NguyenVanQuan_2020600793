        <?php
        include './connect_db.php';
        session_start();
        unset($_SESSION['user']);
        header('location: index.php');
        session_destroy();
        die();
        
        ?>
