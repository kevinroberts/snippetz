<div class="box">

<p class="intro">You may login to an account here.</p>

<p>If you do not already have an account, <?php echo html::anchor('auth/create', 'create one') ?> first.</p>

<?php echo form::open('auth/login', array('style' => 'width:50%;margin:0 auto')) ?>

<?php if ( ! empty($errors)): ?>
<ul class="errors">
<?php foreach ($errors as $error): ?>
<li><?php echo $error ?></li><br/>
<?php endforeach ?>
</ul>
<?php endif ?>

<fieldset>
<label><span>Username</span><?php echo form::input('username', $post['username']) ?></label>
<p><small>Email addresses can also be used to login.</small></p>
<label><span>Password</span><?php echo form::password('password', $post['password']) ?></label>
</fieldset>

<fieldset class="submit"><?php echo form::button(NULL, 'Login') ?></fieldset>

</div>
