<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <!--[if IE]><![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<base href="[[!++site_url]]">
    <title>Metawatch | [[*pagetitle]]</title>
    <meta name="title" content="Metawatch Forums">    
    <meta name="author" content="MODX Systems, LLC">

	[[*cssjs]]
	<!-- [[~[[*id]]]] -->
</head>
<body>
<div id="header">
	<header class="container">
				
		<nav id="global">
			[[+discuss.user.id:is=``:then=`<a href="[[~[[*id]]]]login">Login</a> | <a href="[[~[[*id]]]]register">Register</a>`]]
			[[+discuss.user.id:notempty=`Welcome, <a href="[[~[[*id]]]]user/?user=[[+discuss.user.id]]">[[+modx.user.username]]</a> | <a href="[[~[[*id]]]]logout">Logout</a>`]]
			
		</nav>  
          	
		<nav id="logo">
			<a title="Metawatch" href="/forums/">Metawatch</a>
		</nav>

		<nav id="logo_search">
			<div id="search">		
	                <form action="search-results/" method="get" accept-charset="utf-8">
						<label for="search_form_input" class="hidden">Search</label>
						<input id="search_form_input" placeholder="Search keyphrase..." name="search" value="" title="Start typing and hit ENTER" type="text">
						<input value="Go" type="submit">
					</form>   
	        </div><!-- #search -->
		</nav>
			
			
	</header>
</div>



	
<!-- end header -->

<div>
	<div id="section_wrap">
		<header class="container">
			<nav id="section">
				<ul>
					[[+discuss.user.id:is=``:then=`<li class="first level1">
						<a href="[[~[[*id]]]]register" class="first level1"><span class="Title">Register</span>Sign Up with the Metawatch Community</a></li>
				
            		<li class="level1"><a href="[[~[[*id]]]]login" class="first level1"><span class="Title">Login</span>&nbsp;</a></li>`]]
				
				
					[[+discuss.user.id:notempty=`<li class="first level1 parent">
						<a href="[[~[[*id]]]]thread/unread" class="first level1 parent"><span class="Title">View Unread Posts</span> All Discussion Categories</a>
						<ul class="inner">
							<li class="first level2 parent"><a href="[[~[[*id]]]]thread/unread_last_visit" class=""><span class="Title">View New</span>Posts Since Last Visit</a></li>
							<li class="first level2 parent"><a href="[[~[[*id]]]]thread/new_replies_to_posts" class=""><span class="Title">New Replies</span>[[%discuss.new_replies_to_posts]]</a></li>
							<li class="first level2 parent"><a href="[[~[[*id]]]]thread/recent" class=""><span class="Title">Recent Posts</span>My Latest Posts</a></li>
						</ul>
					</li>
					
					<li class="level1">
					<a href="[[~[[*id]]]]messages/" class="level1"><span class="Title">Private Discussions</span> All Private Messages</a>
					</li>`]]
				</ul>   
			</nav>
		</header>
[[+trail]]
	</div>
	
		<div id="Frame">
		
			<div id="Body">
			
				<div id="Content">
					[[+content]]
					
				<!-- Close Content Inside home.tpl -->
			
				</div>
			</div>
			
	    </div>
	    
    <div class="clearfix">&nbsp;</div>
							
	<footer>
        <div class="clearfix container">
           <div id="copyright">Copyright 2011 Meta Watch Ltd. All rights reserved. Powered by <a href="http://modx.com">MODX</a>. <p></p></div>
        </div>
	</footer>
</div>



</body>
</html>