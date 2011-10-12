<form class="registerForm dis-form" action="[[~[[*id]]]]" method="post">
<ul class="DataList CategoryList CategoryListWithHeadings">
	<li class="Item CategoryHeading Depth1 Category-Meta Watch Boards" id="dis-category-1">
    <div class="ItemContent Category Read">Register</div>

</li>
</ul>
    
    
 <div class="register">
    <div class="registerMessage">[[!+reg.error.message]]</div><br class="clearfix" />
        <input type="hidden" name="nospam" value="[[!+reg.nospam]]" /><br class="clearfix" />
 
        <label for="username">[[%register.username? &namespace=`login` &topic=`register`]]
            <span class="error">[[!+reg.error.username]]</span>
        </label><br class="clearfix" />
        <input type="text" name="username" id="username" value="[[!+reg.username]]" /><br class="clearfix" />
 
        <label for="password">[[%register.password]]
            <span class="error">[[!+reg.error.password]]</span>
        </label><br class="clearfix" />
        <input type="password" name="password" id="password" value="[[!+reg.password]]" /><br class="clearfix" />
 
        <label for="password_confirm">[[%register.password_confirm]]
            <span class="error">[[!+reg.error.password_confirm]]</span>
        </label><br class="clearfix" />
        <input type="password" name="password_confirm" id="password_confirm" value="[[!+reg.password_confirm]]" /><br class="clearfix" />
 
        <label for="fullname">[[%register.fullname]]
            <span class="error">[[!+reg.error.fullname]]</span>
        </label><br class="clearfix" />
        <input type="text" name="fullname" id="fullname" value="[[!+reg.fullname]]" /><br class="clearfix" />
 
        <label for="email">[[%register.email]]
            <span class="error">[[!+reg.error.email]]</span>
        </label><br class="clearfix" />
        <input type="text" name="email" id="email" value="[[!+reg.email]]" /><br class="clearfix" />
 
 
        <div class="form-buttons">
            <input type="submit" name="registerbtn" value="Register" />
        </div>
	</div>
</form>

 

 

 

