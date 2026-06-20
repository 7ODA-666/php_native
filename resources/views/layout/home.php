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
              <div class="form-group">
                  <label for="file">Choose File</label>
                  <input type="file" class="form-control" id="file" name="file" required>
              </div>
              <button type="submit" class="btn btn-primary mt-2">Upload</button>
            </form>
        </div>

        <div class="col-md-6 offset-md-3 mt-3">
            <a class="btn btn-success" href="<?php echo url('storage/users/images/shams.jpeg') ?>">View Uploaded Files</a>
            <a class="btn btn-danger" href="<?php echo url('delete/file') ?>">Delete Uploaded Files</a>
        </div>
        
    </div>
    

 
    
    
    <?php view('layout.footer') ?>
  </body>
</html>


