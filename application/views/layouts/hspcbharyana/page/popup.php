<div class="title-bar green-bar"><?php echo $searchdata['tb_page_'.$tablename.'_title'];?></a></div>
<?php if(!empty($tablename) && ($tablename == 'file' || $tablename == 'pdf')) { ?>
<iframe width="1000px" height="1000px" src="<?php echo base_url();?>uploads/<?php echo $tablename;?>/<?php echo $searchdata['tb_page_'.$tablename.'_path'];?>"></iframe>
<?php } else { ?>
<img src="<?php echo base_url();?>uploads/<?php echo $tablename;?>/<?php echo $searchdata['tb_page_'.$tablename.'_path'];?>" class="img-responsive" />
<?php } ?>