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
                <?php echo trans('main.error_404') ?>
        </h1>
        <img src="<?php echo url('assets/images/404.jpg') ?>" alt="404" 
        class="img-fluid d-block mx-auto" style="width: 550px;">
    </div>
    
    
    
    <?php view('layout.footer') ?>
  </body>
</html>


