<?php view('layout.header') ?>

<h1>
    The Home Page
    <form method="post" action="<?php echo url('users') ?>">
        <input type="text" name="name">
        <input type="hidden" name="_method" value="post">
        <input type="submit">
    </form>
</h1>

<?php view('layout.footer') ?>