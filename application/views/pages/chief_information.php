<?php $getProfile = $this->Hiceoms_model->get_profiles(0);?>
<table width="550px" border="0" cellpadding="0" cellspacing="0">


    <tbody>
        <tr bgcolor="#075480">
            <td colspan="3" align="center"><font color="#eeeeee"><strong>  Profile of Chief Information Commissioner</strong>
                </font>
				</td>
        </tr>
        <tr>
            <td>

                <table align="left" width="550px" border="0" cellpadding="2" cellspacing="5">

                    <tbody>
					<?php if(!empty($getProfile)) { ?>
					<?php foreach($getProfile as $profile) { ?>
					<tr>
                            <td width="200px">
                                <table align="center" cellpadding="2" cellspacing="5">
                                    <tbody>
                                        <tr>
                                            <td align="center">
											<?php if(!empty($profile['profile_pics'])) { ?>
												<img src="<?php echo base_url();?>uploads/Profiles/<?php echo trim($profile['profile_pics']);?>" width="110" height="143" border="2">
											<?php } ?>
											</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><strong>
											<?php echo trim($profile['profile_name']);?>
											<?php if(!empty($profile['profile_bio_data'])) { ?>
                                                    <br> <a href="<?php echo base_url();?>uploads/Profiles/<?php echo trim($profile['profile_bio_data']);?>" style="text-decoration:none;" target="_new ">Curriculum Vitae></a>
													<?php } ?>
													</strong>
													</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="380px" align="left" cellpadding="2" cellspacing="5">
                                    <tbody>
                                        <tr>
                                            <td align="left"><b>Name</b>
                                            </td>
                                            <td>:</td>
                                            <td align="left" width="250px;"><?php echo trim($profile['profile_name']);?></td>
                                        </tr>

                                        <tr>
                                            <td align="left"><b>Designation</b>
                                            </td>
                                            <td>:</td>
                                            <td align="left" width="250px;"><?php echo trim($profile['designation']);?></td>
                                        </tr>

                                        <tr>
                                            <td align="left"><b>E-mail</b>
                                            </td>
                                            <td>:</td>
                                            <td align="left" width="250px;"><a href="mailto:<?php echo trim($profile['profile_email']);?>"><?php echo trim($profile['profile_email']);?></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left"><b>Phone </b>
                                            </td>
                                            <td>:</td>
                                            <td align="left" width="50px;" style="word-break:break-all;"><?php echo trim($profile['profile_phone']);?></td>
                                        </tr>

                                        <tr>
                                            <td align="left"><b>FAX No</b>
                                            </td>
                                            <td>:</td>
                                            <td align="left" width="50px;"><?php echo trim($profile['profile_fax']);?></td>
                                        </tr>

                                        <!--<tr>
                                            <td align="left" width="150px" valign="top"><b>Contact
                                                    Address</b>
                                            </td>
                                            <td>:</td>
                                            <td align="left" width="250px;" valign="top"><?php echo trim($profile['profile_contact_address']);?></td>
                                        </tr>-->



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