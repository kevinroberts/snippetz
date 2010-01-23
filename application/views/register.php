<?php
// New User Registration Form
?>
<style type="text/css">
.errors {
	color:red;
	font-weight:bold;
}
</style>

<div class="box">

<?php echo form::open('home/register', array('class' => 'niceform')) ?>

<?php if ( ! empty($errors)): ?>
<ul class="errors">
<?php foreach ($errors as $error): ?>
<li><?php echo $error; ?></li><br/>
<?php endforeach ?>
</ul>
<?php endif ?>

<fieldset>
	<legend>Sign up:</legend>
    <dl>
    	<dt><label for="email">Email:</label></dt>
        <dd><?php echo form::input('email', $post['email']) ?></dd>
    </dl>
    <dl>
    	<dt><label for="email">Username:</label></dt>
        <dd><?php echo form::input('username', $post['username']) ?></dd>
    </dl>
    <dl>
    	<dt><label for="password">Password:</label></dt>
        <dd><?php echo form::password('password', $post['password']) ?></dd>
    </dl>
    <dl>
    	<dt><label for="password">Confirm Password:</label></dt>
        <dd><?php echo form::password('password_confirm', $post['password_confirm']) ?></dd>
    </dl>
</fieldset>
<fieldset class="action">
	<?php echo form::button('submit', 'Register') ?>
</fieldset>
</form>

</div>