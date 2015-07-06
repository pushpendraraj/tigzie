<div id="content" class="span10">
			<!-- content starts -->
		<?php echo $this->element('adminBreadcrumb'); ?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Booking Urls</h2>
					     </div>
					<div class="box-content">
                        <div class="control-group">
                        <table class="table table-striped table-bordered">
          		<thead>                         
          		<tr>
          		<th><?php echo __('Restaurant Name'); ?></th>
        		<th>Urls</th>							 
          		</tr>
              	</thead>   
            	<tbody>
                  <?php
					if(isset($res)){
						foreach ($res as $rs){ ?>
                           <?php $agent_id=$this->Session->read('User.3.agent_id');?>
							<tr><td><?php echo $rs['Restaurant']['restaurant_name']; $res_name= $rs['Restaurant']['restaurant_name']?></td>
                            <td><a href="<?php echo $this->webroot; ?><?php echo str_replace(' ','-',strtolower($rs['Restaurant']['restaurant_name'])); ?>?agent_id=<?php echo $agent_id?>"><?php echo "http:/"?><?php echo $this->webroot; ?><?php echo str_replace(' ','-',strtolower($rs['Restaurant']['restaurant_name'])); ?><?php echo "?agent_id="?><?php echo $this->Session->read('User.3.agent_id')?></a></td>
                             		<?php }}?>
				</tbody>
                </table>
                           </div>
                             </div>    
                                </div>
                                  </div>
                                    </div>
 




