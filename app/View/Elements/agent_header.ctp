<!-- user dropdown starts -->
				<div class="btn-group pull-right push" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $AgentUser['username'];?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<!--<li><a href="#">Profile</a></li>-->
						<li class="divider"></li>
						<li><a href="<?php echo $this->webroot; ?>users/logout/2">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<!--<div class="top-nav nav-collapse push">
					<ul class="nav">
						
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div>--><!--/.nav-collapse -->