<?php view('layout.header');

//  set_local('en');

if(session_has('success'))
    echo session_delete('success');
?>


<h1>
    The Home Page
    <form method="post" action="<?php echo url('users') ?>">
        <input type="text" name="name">
        <input type="hidden" name="_method" value="post">
        <input type="submit">
    </form>
</h1>

<?php view('layout.footer') ?>