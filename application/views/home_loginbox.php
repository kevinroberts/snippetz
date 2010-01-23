<?php
// If not logged in => Guest Login | else => show user login info
if (!isset($user)):
?>
<h3 id="username_heading">Welcome Guest,</h3>
<div> 
<a href="/home/login">Login</a>| <a href="/home/register">Register</a>
</div>
<img id="profile_pic" src="/files/guestPic.png" />
<?php endif; ?>
<?php if(isset($user)): ?>
<h3 id="username_heading">Welcome <?php echo $user->username ?>,</h3>
<div> 
	<a href="/home/logout">Logout</a>
</div>
	<?php // Check if the user has a profile picture
	 if(strlen($user->profile_pic) < 1): ?>
		<img id="profile_pic" src="/files/guestPic.png" />
	<?php else: ?>
		<img id="profile_pic" style="width:150px; height:150px;" src="<?= $user->profile_pic ?>" />
	<?php endif; ?>
<?php endif; ?>
