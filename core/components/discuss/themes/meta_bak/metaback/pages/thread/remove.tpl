
<br />
<form action="[[~[[*id]]]]thread/remove?thread=[[+id]]" method="post" class="dis-form" id="dis-remove-thread-form">
	<ul class="DataList CategoryList CategoryListWithHeadings">
	
		<li class="Item CategoryHeading Depth1">
	    <div class="ItemContent Category">[[%discuss.thread_remove? &namespace=`discuss` &topic=`post`]]</div>
	    </li>
	</ul>
    
    <input type="hidden" name="thread" value="[[+id]]" />
    
    <p>[[%discuss.thread_remove_confirm? &thread=`[[+title]]`]]</p>
    
    <span class="error">[[+error]]</span>
    
    <br class="clearfix" />
    
    <div class="dis-form-buttons">
    <input type="submit" name="remove-thread" class="Button dis-action-btn" value="[[%discuss.thread_remove]]" />
    <input type="button" class="Button dis-action-btn" value="[[%discuss.cancel]]" onclick="location.href='[[+url]]';" />
    </div>
</form>