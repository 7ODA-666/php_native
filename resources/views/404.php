<!doctype html>
<?php 
 $lang = get_local();
 $dir = $lang == 'ar' ? 'rtl' : 'ltr';
?>

<html lang="<?php echo $lang ?>" dir="<?php echo $dir ?>">
    <?php view('layout.header',['title' => 'error page']);
        //  set_local('en'); 
        if(session_has('success'))
        echo session_delete('success');
    ?>
  <body>
    <?php view('layout.navbar') ?>

    <div class="container align-content-center mt-5">
        <h1 class="text-danger text-center">
                The Page is not Fount...
        </h1>
    </div>
    
    
    
    <?php view('layout.footer') ?>
  </body>
</html>


