<a class="mainnav-toggle" data-toggle="collapse" data-target=".mainnav-collapse">
    <span class="sr-only">Toggle navigation</span>
    <i class="fa fa-bars"></i>
</a>
<nav class="collapse mainnav-collapse" role="navigation">
    <form class="mainnav-form pull-right" role="search">
        <input type="text" class="form-control input-md mainnav-search-query" placeholder="Search">
        <button class="btn btn-sm mainnav-form-btn"><i class="fa fa-search"></i></button>
    </form>
    <ul class="mainnav-menu">
		<li class="dropdown active">
			<a href="index-2.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
          		Menu Manager
          		<i class="mainnav-caret"></i>
          	</a>
          	<ul class="dropdown-menu" role="menu">
            	<li><a href="<?php echo $this->webroot; ?>restaurants/add_menu"><span class="hidden-tablet"><i class="fa fa-plus-square"></i> Add Menu</span></a></li>
            	<li><a href="<?php echo $this->webroot; ?>restaurants/list_menu"><span class="hidden-tablet"><i class="fa fa-list"></i> List Menu</span></a></li>                <li><a href="<?php echo $this->webroot; ?>restaurants/add_category"><span class="hidden-tablet"><i class="fa fa-plus-square"></i> Add New Category </span></a></li>
                <li><a href="<?php echo $this->webroot; ?>restaurants/list_category"><span class="hidden-tablet"><i class="fa fa-list"></i> List All Categories </span></a></li>
          	</ul>
		</li>
        <li class="dropdown ">
        	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
        		Deals Manager
        		<i class="mainnav-caret"></i>					
        	</a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $this->webroot; ?>deals/create_deal"><span class="hidden-tablet"><i class="fa fa-plus-square"></i> Create New Deal</span></a></li>
                <li><a href="<?php echo $this->webroot; ?>deals/list_deals"><span class="hidden-tablet"><i class="fa fa-list"></i> List Deals</span></a></li>	  
            </ul>
        </li>
        <li class="dropdown ">
        	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
        		Orders
        		<i class="mainnav-caret"></i>
        	</a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $this->webroot; ?>restaurants/create_order"><span class="hidden-tablet"><i class="fa fa-plus-square"></i> Create Order</span></a></li>
                <li><a href="<?php echo $this->webroot; ?>restaurants/list_orders"><span class="hidden-tablet"><i class="fa fa-list"></i> List All Orders</span></a></li> 
            </ul>
        </li>
        <li class="dropdown ">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                Agents
                <i class="mainnav-caret"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
            	<li><a href="<?php echo $this->webroot; ?>restaurants/my_agents"><span class="hidden-tablet"><i class="fa fa-list"></i> My Agents</span></a></li>
            	<li><a href="<?php echo $this->webroot; ?>restaurants/agentRequests"><span class="hidden-tablet"><i class="fa fa-list"></i> Agent Requests</span></a></li> 
            </ul>
        </li>
	</ul>
</nav>