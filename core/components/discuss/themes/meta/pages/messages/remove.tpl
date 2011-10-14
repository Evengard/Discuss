

<form action="[[~[[*id]]]]messages/remove?thread=[[+id]]" method="post" class="dis-form" id="dis-remove-message-form">

	<ul class="dis-list">
	
	<h1>[[%discuss.message_remove? &namespace=`discuss` &topic=`post`]]</h1>

    <input type="hidden" name="thread" value="[[+id]]" />

    <p>[[%discuss.message_remove_confirm? &thread=`[[+title]]`]]</p>

    <span class="error">[[+error]]</span>

    <br class="clearfix" />

    <div class="dis-form-buttons">
    <input type="submit" name="remove-message" class="dis-action-btn" value="[[%discuss.message_remove]]" />
    <input type="button" class="dis-action-btn" value="[[%discuss.cancel]]" onclick="location.href='[[~[[*id]]]]messages/view?message=[[+id]]';" />
    </div>
</form>


			</div><!-- Close Content From Wrapper -->
[[+bottom]]

<aside>
				
    <div class="PanelBox">


		<div class="Box GuestBox">
		    <h4>Play Nice</h4>
			<p>Be nice, respectful and patient. Inflamatory or inappropriate posts will get your post nuked and flood your life with bans and bad karma.</p>
		</div>
  
		<div class="Box GuestBox">
			<h4>Help Us Help You</h4>
			<p>Use a title that gives insight into your post and limit your posts to 1. If you're experiencing problems, please supply adequate technical details.</p>
		</div>


</aside>