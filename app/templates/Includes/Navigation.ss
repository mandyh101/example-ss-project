<nav class="primary">
	<button class="nav-open-button">²</button>
	<ul>
		<% loop $Menu(1) %>
			<li class="$LinkingMode"><a href="$Link" title="$Title">$MenuTitle</a></li>
		<% end_loop %>
	</ul>
</nav>
