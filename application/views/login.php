<?php
// User Login Form
?>
<?php if (isset($_GET['logout'])):?>	
	<div id="messageBox" class="fbinfobox" style="width: 500px;float:right; margin-right: 370px;">
        <h3>You have successfully logged out.</h3>
		<small>You may now close your browser or login again below:</small>
    </div>
<?php endif; ?>
<?php if (isset($_GET['loginRequired'])):?>
	<div id="messageBox" class="fberrorbox" style="width: 500px;float:right; margin-right: 370px;">
        You must be logged in to view that page. Please login below or <a href="/home/register">register</a> for an account
    </div>
<?php endif; ?>

<div class="box">

<?php echo form::open('home/login', array('class' => 'niceform')) ?>

<?php if ( ! empty($errors)): ?>
<ul class="errors">
<?php foreach ($errors as $error): ?>
<li><?php echo $error; ?></li><br/>
<?php endforeach ?>
</ul>
<?php endif ?>

<fieldset>
	<legend>Please Login:</legend>
    <dl>
    	<dt><label for="email">Username:</label></dt>
        <dd><?php echo form::input('username', $post['username']) ?></dd>
    </dl>
    <dl>
    	<dt><label for="password">Password:</label></dt>
        <dd><?php echo form::password('password', $post['password']) ?></dd>
    </dl>
    <dl>
        <dd><?php echo form::checkbox('remember_check', 'rememberMe', TRUE); ?><label for="rememberMe" class="rememberMe">Remember me</label></dd>
		<?php
		 if (isset($_GET['return_to'])) 
		{
		 echo form::hidden("return_to",$_GET['return_to']);			
		}
		else
		echo form::hidden("return_to","home");	
		 ?>

    </dl>

</fieldset>
<fieldset class="action">
	<?php echo form::button('submit', 'Login') ?>
</fieldset>
</form>

</div>
