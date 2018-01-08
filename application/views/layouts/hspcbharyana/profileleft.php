<?php $getProfile = $this->Hiceoms_model->get_profiles(0);?>
<table width="550px" border="0" cellpadding="0" cellspacing="0">


    <tbody>

        <tr>
            <td>

                <table align="left" width="" border="0" cellpadding="2" cellspacing="5">

                    <tbody>
					<?php if(!empty($getProfile)) { ?>
					<?php foreach($getProfile as $profile) { ?>
					<tr>

                            <td width="">
                                <table align="" cellpadding="2" cellspacing="5">
                                    <tbody>
                                        <tr>
                                            <td align="center">
											<?php if(!empty($profile['profile_pics'])) { ?>
												<img src="<?php echo base_url();?>uploads/Profiles/<?php echo trim($profile['profile_pics']);?>" width="200" height="260" border="2">
											<?php } ?>
											</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><strong>
											<?php echo trim($profile['profile_name']);?><br>
											<?php echo trim($profile['designation']);?>
											
													</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            
                        </tr>
						<?php } ?>
					<?php } ?>
                    </tbody>
                </table>

            </td>
        </tr>
    </tbody>
</table>