
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard') ?>"> Dashboard</a></li>
            <li><a href="<?php echo site_url('administrator/pages') ?>"><?php echo $pageTitle ?></a></li>
            <li class="active"> Add </li>
        </ul>
    </div>

    <div class="page-content-wrapper m-t">
        <?php echo $this->session->flashdata('message'); ?>
        <form enctype="multipart/form-data" class="form-vertical row " action="<?php echo site_url('administrator/pages/save/' . $row['pageID']); ?>" method="post" novalidate parsley-validate>

            <div class="col-sm-8 ">
                <div class="sbox">
                    <div class="sbox-title">Page Content </div>	
                    <div class="sbox-content">				

                        <div class="form-group  " >

                            <div class="" style="background:#fff;">
                                <textarea name='content' rows='35' id='content'    class='form-control markItUp'><?php echo $content ?></textarea> 
                            </div> 
                        </div> 	
                    </div>
                </div>	
                <!--<div class="sbox">
                    <div class="sbox-title">Short Content </div>	
                    <div class="sbox-content">				

                        <div class="form-group  " >
                            <div class="" style="background:#fff;">
                                <textarea name='short_content' rows='35' id='short_content'    class='form-control markItUp'  
                                          ><?php echo $row['short_content']; ?>
                                </textarea> 
                            </div> 
                        </div> 	
                    </div>
                </div>	-->
            </div>
            <div class="col-sm-4 ">
                <div class="sbox">
                    <div class="sbox-title">Page Info </div>	
                    <div class="sbox-content">						
                        <div class="form-group hidethis " style="display:none;">
                            <label for="ipt" class=""> PageID </label>

                            <?php echo form_input(array('name' => 'pageID', 'value' => $row['pageID'], 'class' => 'form-control')); ?>

                        </div> 					
                        <div class="form-group  " >
                            <label for="ipt" > Title </label>
                            <?php echo form_input(array('name' => 'title', 'value' => $row['title'], 'class' => 'form-control')); ?>

                        </div> 					
                        <div class="form-group  " >
                            <label for="ipt" > Alias </label>
                            <?php echo form_input(array('name' => 'alias', 'value' => $row['alias'], 'class' => 'form-control')); ?>

                        </div> 					
                        <div class="form-group  " >
                            <label for="ipt" > Filename </label>

                            <input name="filename" type="text" class="form-control" value="<?php echo $row['filename'] ?>" 
                                   <?php if ($row['pageID'] != '') echo 'readonly="1"'; ?> required
                                   />

                        </div> 
                        <div class="form-group  " >
                            <label for="ipt" > Feature Image </label>

                            <input  type='file' name='feature_image' id='feature_image' <?php if (empty($row['feature_image']) && $row['feature_image'] == '') echo 'class="required"'; ?> style='width:150px !important;'  />
                            <?php echo SiteHelpers::showUploadedFile($row['feature_image'], '/uploads/featureImage/'); ?>

                        </div> 

						<div class="form-group " >
							<label for="ipt" > Header Image</label>
							<input  type='file' name='header_image' id='header_image'  style='width:150px !important;'  />
							<?php echo SiteHelpers::showUploadedFile($row['header_image'], '/uploads/headerImage/'); ?>
						</div> 
						
                        <div class="form-group  " >
                            <label for="ipt"> Who can view this page ? </label>
                            <?php foreach ($groups as $group): ?> 
                                <label class="checkbox">					
                                    <input  type='checkbox' name='group_id[<?php echo $group['id'] ?>]'    value="<?php echo $group['id'] ?>"
                                    <?php if ($group['access'] == 1 or $group['id'] == 1) echo 'checked' ?>
                                            /> 
                                            <?php echo $group['name'] ?>
                                </label>  
                            <?php endforeach; ?>	
                        </div> 
                        <div class="form-group" >
                            <label for="ipt">Page Layout</label>

                            <select name="page_layout" class="form-control">
                                <option value="">Select Display Layout</option>
                                <option value="5" <?php if ($row['page_layout'] == 5) echo 'selected'; ?>>Empty Layout</option>
                                <option value="1" <?php if ($row['page_layout'] == 1) echo 'selected'; ?>>One column Layout</option>
                                <option value="2" <?php if ($row['page_layout'] == 2 || $row['page_layout'] == 'NULL' || $row['page_layout'] == '') echo 'selected'; ?>>Two column Layout With Right</option>
                                <option value="3" <?php if ($row['page_layout'] == 3) echo 'selected'; ?>>Two column Layout With Left</option>
                                <option value="4" <?php if ($row['page_layout'] == 4) echo 'selected'; ?>>Three column Layout</option>
                            </select>

                        </div> 

                        <div class="form-group  " >
                            <label> Show for Guest ? unlogged  </label>
                            <label class="checkbox"><input  type='checkbox' name='allow_guest' 
                                                            <?php if ($row['allow_guest'] == 1) echo 'checked'; ?> value="1"	/> Allow Guest ?  </lable>
                        </div>

                        <div class="form-group  " >
                            <label> Status </label>
                            <label class="radio">					
                                <input  type='radio' name='status'  value="enable" required
                                <?php if ($row['status'] == 'enable') echo 'checked'; ?>				  
                                        /> 
                                Enable
                            </label> 
                            <label class="radio">					
                                <input  type='radio' name='status'  value="disabled" required
                                <?php if ($row['status'] == 'disabled') echo 'checked'; ?>				  
                                        /> 
                                Disabled
                            </label> 					 
                        </div> 

                        <div class="form-group  " style="display:none;">
                            <label> Template </label>
                            <label class="radio">					
                                <input  type='radio' name='template'  value="frontend" required
                                        <?php //if ($row['template'] == 'frontend') echo 'checked'; ?>	checked="checked"

                                        /> 
                                Frontend
                            </label> 
                            <label class="radio">					
                                <input  type='radio' name='template'  value="backend" required	
                                <?php if ($row['template'] == 'backend') echo 'checked'; ?>			  
                                        /> 
                                Backend
                            </label> 					 
                        </div> 				  
                         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                        <div class="form-group">
						
                            <input type="submit" name="apply" class="btn btn-info btn-sm" value="Apply" />
                            <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit " />
                            <a href="<?php echo site_url('administrator/pages'); ?>" class="btn btn-sm btn-warning">Back To List </a>		 

                        </div> 
                    </div>
                </div>				  				  

            </div>



        </form>
    </div>
</div>	
<script type="text/javascript">
  
                $(function () {
                $("[name=title]").keyup(function ()
                {
                    var yourInput = $(this).val();
                    re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
                    var isSplChar = re.test(yourInput);
                    if (isSplChar)
                    {
                        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                        $(this).val(no_spl_char);
                    }
                });
                
                
                
                
                   $("[name=alias]").keyup(function ()
                {
                    var yourInput = $(this).val();
                    re = /[`<\>(\)]/gi;
                    var isSplChar = re.test(yourInput);
                    if (isSplChar)
                    {
                        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                        $(this).val(no_spl_char);
                    }
                });
                
                
                 $("[name=filename]").keyup(function ()
                {
                    var yourInput = $(this).val();
                    re = /[`<\>(\)]/gi;
                    var isSplChar = re.test(yourInput);
                    if (isSplChar)
                    {
                        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                        $(this).val(no_spl_char);
                    }
                });
            });

</script>
<style type="text/css">
    .note-editor .note-editable { height:500px;}
</style>			 	 