 <tr class="sag_remove_container<?php $val->id; ?>">
					<td><input type="checkbox" class="sag_checkbox" multiple="multiple" value="<?php echo $val->id;?>" ></td>
					<td><?=$val->title;?></td>
					<td><img src="<?=$this->config->item('upload_folder').'templates/'.'template'.$val->template_id.'.png';?>" style="height:50px; width:50px"/></td>
					<td><?php if($val->type=='y') { echo 'Youtube'; } else if($val->type=='v') { 'Vimeo'; } else { echo 'VideoWhizz'; } ?></td>
					<td><?php echo date("d-m-Y", strtotime($val->schedule_on));?></td>
					<td><?php  if($val->type=='PP'){ echo "profitpage";}else { echo "profitmozo";} ?></td>
					<td>
					<?php if($view_per=='yes') { ?>
					  <a href="javascript:" class="btn btn-primary btn-xs viewlink" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="<?=$val->id?>"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View" ></i> </a>
					  <?php } ?>
					   <?php if($edit_per=='yes') { ?>
                      <a href="<?=$this->config->item('spanel_url').'edit-socialmozo/'.$val->id?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
					  <?php } ?>
					  
					   <?php if($delete_per=='yes') { ?>
                      <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-socialmozo/'.$val->id?>"><i class="fa fa-trash-o"></i> </a>
					  <?php } ?>
				  </td>
                </tr>