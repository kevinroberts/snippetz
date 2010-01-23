<?php if($highlight == 'home'): ?>
<ul>
  <li class="active"><a style="color:#DDD;" href="/home">Home</a></li>
  <li><a href="/home/new_snip">New Snip</a></li>
  <li><a href="/home/snip_library">My Snippetz Library </a></li>
  <li><a href="/home/user_settings">Settings</a></li>
</ul>
<?php elseif($highlight == 'settings'): ?>
	<ul>
	  <li><a href="/home">Home</a></li>
	  <li><a href="/home/new_snip">New Snip</a></li>
	  <li><a href="/home/snip_library">My Snippetz Library </a></li>
	  <li class="active"><a style="color:#DDD;" href="/home/user_settings">Settings</a></li>
	</ul>
<?php elseif($highlight == 'new_snip'): ?>
	<ul>
	  <li><a href="/home">Home</a></li>
	  <li class="active"><a style="color:#DDD;" href="/home/new_snip">New Snip</a></li>
	  <li><a href="/home/snip_library">My Snippetz Library </a></li>
	  <li><a href="/home/user_settings">Settings</a></li>
	</ul>
<?php elseif($highlight == 'snip_library'): ?>
	<ul>
	  <li><a href="/home">Home</a></li>
	  <li><a href="/home/new_snip">New Snip</a></li>
	  <li class="active"><a style="color:#DDD;" href="/home/snip_library">My Snippetz Library </a></li>
	  <li><a href="/home/user_settings">Settings</a></li>
		</ul>
<?php elseif($highlight == 'none'): ?>
	<ul>
	  <li><a href="/home">Home</a></li>
	  <li><a href="/home/new_snip">New Snip</a></li>
	  <li><a href="/home/snip_library">My Snippetz Library </a></li>
	  <li><a href="/home/user_settings">Settings</a></li>
	</ul>
<?php endif; ?>