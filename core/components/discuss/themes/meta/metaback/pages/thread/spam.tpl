
<form action="[[~[[*id]]]]thread/spam?thread=[[+id]]" method="post" class="dis-form" id="dis-spam-thread-form">

	<ul class="DataList CategoryList CategoryListWithHeadings">
	
		<li class="Item CategoryHeading Depth1">
	    <div class="ItemContent Category">[[%discuss.thread_spam? &namespace=`discuss` &topic=`post`]]</div>
	    </li>
	</ul>

    <input type="hidden" name="thread" value="[[+id]]" />

    <p>[[%discuss.thread_spam_confirm? &thread=`[[+title]]`]]</p>

    <span class="error">[[+error]]</span>

    <br class="clearfix" />

    <div class="dis-form-buttons">
    <input type="submit" name="spam-thread" class="Button dis-action-btn" value="[[%discuss.thread_spam]]" />
    <input type="button" class="Button dis-action-btn" value="[[%discuss.cancel]]" onclick="location.href='[[+url]]';" />
    </div>
</form>