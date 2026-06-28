<!doctype html>
<?php 
 $lang = get_local();
 $dir = $lang == 'ar' ? 'rtl' : 'ltr';
?>

<html lang="<?php echo $lang ?>" dir="<?php echo $dir ?>">
    <?php view('layout.header', ['title' => trans('main.home')]);?>
  <body>
    <?php view('layout.navbar') ?>


    <div class="container align-content-center mt-5">
        <h1 class="text-center">
                <?php echo trans('main.home_page') ?>
        </h1>

       
            <?php if(session_has('success')) : ?>
               <div class="alert alert-success text-center m-4">
                    <?php echo session_delete('success'); ?>
                </div>
            <?php endif; ?>
          
        
        
        <div class="col-md-6 offset-md-3 mt-5">
            <form action="<?php echo url('upload') ?>" method="post" enctype="multipart/form-data">
              <div class="form-group mb-2">
                  <label for="file"><?php echo trans('main.choose_file') ?></label>
                  <input type="file" class="form-control" id="file" name="file">
              </div>
              <div class="form-group mb-2">
                  <label for="email"><?php echo trans('main.email') ?></label>
                  <input type="text" class="form-control " id="email" name="email"
                            value="<?php echo old('email') ?? '' ?>">
                  <?php echo render_validation_errors('email') ?>
              </div>
              <div class="form-group mb-2">
                  <label for="phone"><?php echo trans('main.phone') ?></label>
                  <input type="text" class="form-control" id="phone" name="phone"
                            value="<?php echo old('phone') ?? '' ?>">
                  <?php echo render_validation_errors('phone') ?>
              </div>
              <div class="form-group mb-2">
                  <label for="address"><?php echo trans('main.address') ?></label>
                  <input type="text" class="form-control" id="address" name="address"
                            value="<?php echo old('address') ?? '' ?>">
                  <?php echo render_validation_errors('address') ?>
              </div>
              <button type="submit" class="btn btn-primary mt-2"><?php echo trans('main.save') ?></button>
            </form>
        </div>

        <div class="col-md-6 offset-md-3 mt-3">
            <a class="btn btn-success" href="<?php echo url('storage/users/images/shams.jpeg') ?>"><?php echo trans('main.view_uploaded_file') ?></a>
            <a class="btn btn-danger" href="<?php echo url('delete/file') ?>"><?php echo trans('main.delete_uploaded_file') ?></a>
        </div>
        
    </div>
    

 
    
    
    <?php view('layout.footer') ?>
  </body>
</html>


