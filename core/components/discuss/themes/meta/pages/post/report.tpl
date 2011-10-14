<form action="[[~[[*id]]]]post/report?post=[[+id]]" method="post" class="dis-form" id="dis-report-thread-form">

    <h1>[[%discuss.report_to_mod? &namespace=`discuss` &topic=`post`]]</h1>

    <input type="hidden" name="thread" value="[[+id]]" />

    <p>[[%discuss.report_to_mod_confirm? &thread=`[[+title]]`]]</p>


    <label for="dis-report-message">[[%discuss.message]]:
        <span class="error">[[!+fi.error.message]]</span>
    </label>
    <textarea name="message" id="dis-report-message" cols="80" rows="7">[[!+fi.message]]</textarea>
    <br class="clear" />

    <span class="error">[[+error]]</span>

    <br class="clearfix" />

    <div class="dis-form-buttons">
    <input type="submit" name="report-thread" class="dis-action-btn" value="[[%discuss.report_to_mod]]" />
    <input type="button" class="dis-action-btn" value="[[%discuss.cancel]]" onclick="location.href='[[+url]]';" />
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