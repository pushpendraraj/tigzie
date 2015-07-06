<div id="content" class="span10"><?php ?>
			<!-- content starts -->
	<?php echo $this->element('adminBreadcrumb'); ?>
			<div class="sortable row-fluid">
				<a class="well span3 top-block" href="<?php echo $this->webroot; ?>/admin/restaurants">
					<span class="icon32 icon-color icon-star-on"></span>
					<div>Total Restaurants</div>
					<div><?php echo $restaurant_count; ?></div>
				</a>
				
                <a class="well span3 top-block" href="<?php echo $this->webroot; ?>/admin/agents">
					<span class="icon32 icon-red icon-user"></span>
					<div>Total Agents</div>
					<div><?php echo $agent_count; ?></div>
				</a>
				
			</div>
			</div>