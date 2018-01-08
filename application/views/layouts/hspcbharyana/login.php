<?php $this->load->view('layouts/' . CNF_THEME . '/header', array('pageAlias' => (!empty($pageAlias)) ? $pageAlias : '', 'pageTitle' => (!empty($pageTitle)) ? $pageTitle : '')); ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8  top-space" id="center">
                <div class="suggestions">       
                    <div class="title-bar green-bar">Login <span id="heading_text">Employee</span></div>     
                    <div class="share-blk"> 
                        <div id="suggestionsuccessfull">
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <form method="post">     
                            <div id="admin_login" style="display:none;">
                                <div class="form-group">          
                                    <input type="text" placeholder="Username" name="username" id="username" class="form-control"> 
                                    <?php echo form_error('username'); ?>
                                </div> 
                                <div class="form-group">   
                                    <input placeholder="Password" name="admin_password" id="admin_login_password" type="password" class="form-control"> 
                                    <?php echo form_error('admin_password'); ?>
                                </div>   
                            </div>
                            <div id="not_admin_login">
                                <div class="form-group">          
                                    <input type="text" placeholder="Enter email" name="email" type="email" id="email" class="form-control"> 
                                    <?php echo form_error('email'); ?>
                                </div>
                                <div class="form-group" id="emp_player_login">
                                    <input placeholder="Mobile Number" name="mobile" id="login_password" type="text" class="form-control"> 
                                    <?php echo form_error('mobile'); ?>
                                </div>   
                            </div>
                            <div class="form-group">
                                <label>Admin</label>
                                <input name="type" type="radio" <?php if (!empty($_POST) && !empty($_POST['type']) && $_POST['type'] == 1) { echo 'checked="checked"';}?> value="1" onclick="javascript:loginAuth(this.value)" />
                                <label>Player</label>
                                <input name="type" type="radio" <?php if (!empty($_POST) && !empty($_POST['type']) && $_POST['type'] == 2) { echo 'checked="checked"';}?>  value="2" onclick="javascript:loginAuth(this.value)" />
                                <label>Employee</label>
                                <input name="type" type="radio" <?php if (!empty($_POST) && !empty($_POST['type']) && $_POST['type'] == 3) { echo 'checked="checked"';}?>  value="3" onclick="javascript:loginAuth(this.value)" />
                                <?php echo form_error('type'); ?>
                            </div>
                            <button class="btn btn-primary ftbtn1" type="submit" id="login_button">Employee Login</button>     
                        </form>
                    </div>      
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4" id="right">
                <div class="row-side" id="sidebar"> <?php $this->load->view('layouts/mango/widget', array('position' => 'right', 'dynamicPosition' => !empty($right_widget) ? $right_widget : '')); ?></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function loginAuth(value) {
        if (value == 1) {
            $('#heading_text').html('Admin');
            $('#login_button').html('Admin Login');
            $('#admin_login').show();
            $('#not_admin_login').hide();
        }
        if (value == 2) {
            $('#heading_text').html('Player');
            $('#login_button').html('Player Login');
            $('#admin_login').hide();
            $('#not_admin_login').show();
        }
        if (value == 3) {
            $('#heading_text').html('Employee');
            $('#login_button').html('Employee Login');
            $('#admin_login').hide();
            $('#not_admin_login').show();
        }

    }

<?php if (!empty($_POST) && empty($_POST['type'])) { ?>
        loginAuth(3)
<?php } ?>
<?php if (!empty($_POST) && !empty($_POST['type'])) { ?>
        loginAuth(<?php echo $_POST['type']; ?>)
<?php } ?>
</script>
<?php $this->load->view('layouts/' . CNF_THEME . '/footer'); ?>   