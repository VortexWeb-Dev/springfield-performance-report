<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
<?php include('data/fetch_deals.php'); ?>
<?php include('data/fetch_users.php'); ?>



<div class="p-10 flex-1">


    <?php
    $user = getCurrentUser();
    echo '<pre>';
    print_r($user);
    echo '</pre>';
    ?>

</div>

<?php include('includes/footer.php'); ?>