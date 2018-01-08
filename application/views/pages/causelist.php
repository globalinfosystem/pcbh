<style>
.ftbtn1 {
    background-color: #f39c12 !important;
    border: medium none;
    color: #fff !important;
    margin-top: 0;
    padding: 2px 29px !important;
}
</style>


<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>design/datepick/css/jquery.datepick.css"> 
<script type="text/javascript" src="<?php echo base_url() ?>design/datepick/js/jquery.plugin.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>design/datepick/js/jquery.datepick.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
		$('.DatePicker').datepick({dateFormat: 'yyyy-mm-dd'});
	});
</script> 
<div class="title-bar dark-blue">Cause List </div>
<div class="main-box">
    <div class="collapse-box">
        <div class="top-space">
            <form method="post" action="<?php echo base_url();?>page/get_couse_list" id="couselist" class="form-horizontal">
                <input type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>">
               <div class="form-group">

						<label class="col-sm-2 control-label">From Date</label>
						<div class="col-sm-4">
							<input type="text" class="form-control DatePicker" name="fromdate" value=""  id="fromdate">
						</div>
						 <label class="col-sm-2 control-label">To Date</label>
						<div class="col-sm-4">
							<input type="text" class="form-control DatePicker" name="todate" value=""  id="todate">
						</div>

					<!--<label class="col-sm-1 control-label">Year</label>
                    <div class="col-sm-3">
						<select id="yearVal" name="yearVal" class="form-control">
						<option value="0">--Select--</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option selected="selected" value="2017">2017</option>
						</select>
                    </div>-->
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Select Commissioner</label>
                    <div class="col-sm-5">
						<select name="commissioner" class="form-control">
							<option value="0">--ALL--</option>
							<?php if(!empty($commissioner)){ ?> 
								<?php foreach($commissioner as $commissionerKey => $commissionerArray){ ?> 
									<option value="<?php echo $commissionerKey;?>"><?php echo $commissionerArray['emp_name'];?></option>
								<?php } ?>
							<?php } ?>
						</select>
                    </div>
					 <div class="col-sm-3">
                        <input type="submit" value="Submit" class="btn ftbtn1 btn-blue" name="submit_player">
                    </div>
                </div>
            </form>
            <script type="text/javascript">

                $('#couselist').submit(function (event) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    event.preventDefault();
                    var formData = $(this).serialize();
                    call_page_loader(1);
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: formData,
                        success: function (data) {
                            $('#showData').html(data);
                            $('html, body').animate({
                                scrollTop: $('#showData').offset().top
                            }, 2000);
                            call_page_loader(2);
                        },
                        error: function () {
                            alert('error in ajax form submission');
                        }
                    });
                    return false;
                });
            </script>
        </div>

    </div>

    <div id="showData" class="top-space">
		<?php //Page::get_decisions_hic_without_post();?>
    </div>
</div>