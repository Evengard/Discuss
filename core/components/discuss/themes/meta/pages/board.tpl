[[+top]]

[[+aboveBoards]]

	    [[+pagination]]
<ul class="dis-list" style="[[+boards_toggle]]">
[[+boards]]
</ul>

[[+belowBoards]]

<div class="dis-threads">

	<ul class="dis-list">
		<li><h1>[[+name]]</h1></li>
		[[+posts]]
	</ul>


	    [[+pagination]]
</div>


</div><!-- Close Content From Wrapper -->

[[+bottom]]



<aside>
				<hr class="line" />
    <div class="PanelBox">
        [[!+discuss.user.id:notempty=`<div class="Box">
            <h4>Actions</h4>
			<p>[[+actionbuttons]]</p>
			<p>[[+moderators]]</p>
	    </div>`]]
        [[!+discuss.user.id:is=``:then=`<div class="Box">
		    <h4>Actions</h4>
			<p><a href="[[~[[*id]]]]login" class="Button">Login to Post</a></p>
		</div>`]]

		[[!$post-sidebar?disection=`dis-support-opt`]]


    </aside>
