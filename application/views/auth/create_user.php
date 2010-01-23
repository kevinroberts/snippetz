

<div class="box">

<p class="intro">You may create new users here.</p>

<p>After creating a user, you will be automatically logged in.</p>
<p>If you want to login as a different user go to the <?php echo html::anchor('auth/login', 'login') ?> page.</p>

<?php echo form::open('auth/create', array('style' => 'width:50%;margin:0 auto;')) ?>


<?php if ( ! empty($errors)): ?>
<ul class="errors">
<?php foreach ($errors as $error): ?>
<li><?php echo $error ?></li><br/>
<?php endforeach ?>
</ul>
<?php endif ?>


<fieldset>
<label><span>Email Address</span><?php echo form::input('email', $post['email']) ?></label><br/>
<label><span>Username</span><?php echo form::input('username', $post['username']) ?></label><br/>
<label><span>Password</span><?php echo form::password('password', $post['password']) ?></label><br/>
<label><span>Confirm Password</span><?php echo form::password('password_confirm', $post['password_confirm']) ?></label><br/>
</fieldset>

<fieldset class="submit"><?php echo form::button(NULL, 'Save User') ?></fieldset>

<?php echo form::close() ?>

</div>
