<style type="text/css" media="screen">
	.rowElem {
		padding-bottom: 10px;
	}
	.btnRow {
		margin-top:-20px;
	}
</style>
<div id="content_box">

<h1 class="title_center">Account Settings</h1>

<p>You may <?php echo html::anchor('home/logout', 'log out') ?>. If no longer want this account, <?php echo html::anchor('auth/delete/'.$user->username, 'delete it') ?>.</p>

<script language="javascript">
	$(function(){
		$('#password').val('');
	});
</script>
<?php if ( ! empty($errors)): ?>
<ul class="errors">
<?php foreach ($errors as $error): ?>
<li><?php echo $error; ?></li><br/>
<?php endforeach ?>
</ul>
<?php endif ?>
<form id="myform" action="/home/user_settings" method="POST">
	<div class="rowElem"><label>&lt;-- Profile pic (url)<br />ideal dimensions 150x150px </label>
		<?php // Check if the user has a profile picture
		 if(strlen($user->profile_pic) < 1): ?>
			<input size="45" value="http://www.sample.com/mypic.jpg" type="text" id="profile_pic" name="profile_pic"/>
		<?php else: ?>
			<input size="45" value="<?= $user->profile_pic ?>" type="text" id="profile_pic" name="profile_pic"/> 
		<?php endif; ?>
		</div>
	<div class="rowElem"><label style="padding-right:107px;">Username:</label><input type="text" value="<?= $user->username ?>" id="username" name="username"/></div>
	<div class="rowElem"><label style="padding-right:130px;">Email: </label><input value="<?= $user->email ?>" size="25" type="text" id="email" name="email"/></div>
	<br /><br />
	<div>Change your password</div>
	<div class="rowElem"><label style="padding-right:77px;">New Password:</label><input type="password" name="password" id="password" /></div>
	<div class="rowElem"><label style="padding-right:55px;">Confirm Password:</label><input type="password" name="password_confirm" id="password_confirm" /></div>
	<br /><br />
	<div class="rowElem btnRow"><label style="padding-right:75px;">&nbsp;</label><input type="submit" name="submit" value="Submit Changes" /></div>

</form>


</div>
