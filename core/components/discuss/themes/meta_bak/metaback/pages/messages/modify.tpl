[[+trail]]

[[!FormIt?
  &submitVar=`dis-message-modify`
  &hooks=`postHook.DiscussModifyMessage`
  &validate=`title:required,message:required:allowTags,participants_usernames:required`
]]


<form action="[[~[[*id]]]]messages/modify?post=[[!+fi.id]]" method="post" class="dis-form" id="dis-modify-message-form" enctype="multipart/form-data">
	<ul class="DataList CategoryList CategoryListWithHeadings">
	
		<li class="Item CategoryHeading Depth1">
	    <div class="ItemContent Category">[[%discuss.message_modify? &namespace=`discuss` &topic=`post`]]</div>
	    </li>
	</ul>

    <input type="hidden" name="post" value="[[!+fi.id]]" />
    <input type="hidden" name="thread" value="[[!+fi.thread]]" />

    <label for="dis-message-title">[[%discuss.title]]:
        <span class="error">[[!+fi.error.title]]</span>
    </label>
    <input type="text" name="title" id="dis-message-title" value="[[!+fi.title]]" />

    <label for="dis-reply-participants">[[%discuss.participants]]:
        <span class="error">[[!+fi.error.participants_usernames]]</span>
        <span class="small">[[%discuss.participants_desc]]</span>
    </label>
    <input type="text" name="participants_usernames" id="dis-reply-participants" value="[[!+fi.participants_usernames]]" />


    <div class="wysi-buttons">[[+buttons]]</div>
    

    <label for="dis-thread-message">
        <span class="error">[[!+fi.error.message]]</span>
    </label>
    <textarea name="message" id="dis-thread-message" cols="80" rows="7">[[!+fi.message]]</textarea>
    <br class="clearfix" />

    <label for="dis-attachment">[[%discuss.attachments]]:
        <span class="small dis-add-attachment"><a href="javascript:void(0);">[[%discuss.attachment_add]]</a>
        <br />([[%discuss.attachments_max? &max=`[[+max_attachments]]`]])</span>
        <span class="error">[[+error.attachments]]</span>
    </label>
    <input type="file" name="attachment[[+attachmentCurIdx]]" id="dis-attachment" />

    <div id="dis-attachments"></div>
    [[+attachments:notempty=`<div class="dis-existing-attachments">
        <ul>[[+attachments]]</ul>
    </div>`]]
    <br class="clearfix" />

    <br class="clearfix" />
    <div class="dis-form-buttons">
        <input type="submit" class="dis-action-btn" name="dis-message-modify" value="[[%discuss.save_changes]]" />
        <input type="button" class="dis-action-btn dis-modify-message-preview-btn" id="dis-modify-message-preview-btn" value="[[%discuss.preview]]" />
        <input type="button" class="dis-action-btn" value="[[%discuss.cancel]]" onclick="location.href='[[~[[*id]]]]messages/view?message=[[+thread]]#dis-post-[[+id]]';" />
    </div>
</form>

<div id="dis-modify-message-preview">[[+preview]]</div>

<div class="dis-thread-posts">
	<ul class="DataList CategoryList CategoryListWithHeadings">
	
		<li class="Item CategoryHeading Depth1">
	    <div class="ItemContent Category">[[%discuss.thread_summary]]</div>
	    </li>
	</ul>
[[+thread_posts:default=`<p>[[%discuss.thread_no_posts]]</p>`]]
</div>




			</div><!-- Close Content From Wrapper -->
[[+bottom]]

				<div id="Panel">
					<div class="PanelBox">
					
						<div class="Box GuestBox">
						   <h4>Welcome back [[+modx.user.username]]</h4>
							<p>Some information. Test.</p>
						</div>
						
						<div class="Box BoxCategories">
							<h4><a href="/categories/all">Categories</a></h4>
							<ul class="PanelInfo PanelCategories">
								<li><span><strong><a href="/discussions">All Discussions</a></strong><span class="Count">[[+totalPosts]]</span></span></li>
								<li class="Heading">Partners</li>
								<li class="Depth2 active"><strong><a href="/categories/-important-news">Sample 1 Active</a></strong><span class="Count">0</span></li>
								<li class="Depth2"><strong><a href="/categories/security-notices">Sample 2</a></strong><span class="Count">0</span></li>
								<li class="Heading">General</li>
								<li class="Depth2 active"><strong><a href="/categories/-important-news">Sample 1 Active</a></strong><span class="Count">0</span></li>
								<li class="Depth2"><strong><a href="/categories/security-notices">Sample 2</a></strong><span class="Count">0</span></li>
								<li class="Heading">Evolution</li>
								<li class="Depth2 active"><strong><a href="/categories/-important-news">Sample 1 Active</a></strong><span class="Count">0</span></li>
								<li class="Depth2"><strong><a href="/categories/security-notices">Sample 2</a></strong><span class="Count">0</span></li>
								<li class="Heading">Revolution</li>
								<li class="Depth2 active"><strong><a href="/categories/-important-news">Sample 1 Active</a></strong><span class="Count">0</span></li>
								<li class="Depth2"><strong><a href="/categories/security-notices">Sample 2</a></strong><span class="Count">0</span></li>
								<li class="Heading">International</li>
								<li class="Depth2 active"><strong><a href="/categories/-important-news">Sample 1 Active</a></strong><span class="Count">0</span></li>
								<li class="Depth2"><strong><a href="/categories/security-notices">Sample 2</a></strong><span class="Count">0</span></li>
							</ul>
						</div>
					</div>
