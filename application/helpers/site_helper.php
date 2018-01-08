<?php

class SiteHelpers {

    public static function menus($position = 'top', $active = '1') {
        $_this = & get_Instance();
        $data = array();
        $menu = self::nestedMenu(0, $position, $active);
        foreach ($menu as $row) {
            $child_level = array();
            $p = json_decode($row->access_data, true);
            if ($row->allow_guest == 1) {
                $is_allow = 1;
            } else {
                $is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
            }
            if ($is_allow == 1) {

                $menus2 = self::nestedMenu($row->menu_id, $position, $active);
                if (count($menus2) > 0) {
                    $level2 = array();
                    foreach ($menus2 as $row2) {
                        $p = json_decode($row2->access_data, true);
                        if ($row2->allow_guest == 1) {
                            $is_allow = 1;
                        } else {
                            $is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
                        }

                        if ($is_allow == 1) {

                            $menu2 = array(
                                'menu_id' => $row2->menu_id,
                                'module' => $row2->module,
                                'menu_type' => $row2->menu_type,
                                'url' => $row2->url,
                                'menu_name' => $row2->menu_name,
                                'menu_icons' => $row2->menu_icons,
                                'childs' => array()
                            );

                            $menus3 = self::nestedMenu($row2->menu_id, $position, $active);
                            if (count($menus3) > 0) {
                                $child_level_3 = array();
                                foreach ($menus3 as $row3) {
                                    $p = json_decode($row3->access_data, true);
                                    if ($row3->allow_guest == 1) {
                                        $is_allow = 1;
                                    } else {
                                        $is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
                                    }
                                    if ($is_allow == 1) {
                                        $menu3 = array(
                                            'menu_id' => $row3->menu_id,
                                            'module' => $row3->module,
                                            'menu_type' => $row3->menu_type,
                                            'url' => $row3->url,
                                            'menu_name' => $row3->menu_name,
                                            'menu_icons' => $row3->menu_icons,
                                            'childs' => array()
                                        );
                                        $child_level_3[] = $menu3;
                                    }
                                }
                                $menu2['childs'] = $child_level_3;
                            }
                            $level2[] = $menu2;
                        }
                    }
                    $child_level = $level2;
                }

                $level = array(
                    'menu_id' => $row->menu_id,
                    'module' => $row->module,
                    'menu_type' => $row->menu_type,
                    'url' => $row->url,
                    'menu_name' => $row->menu_name,
                    'menu_icons' => $row->menu_icons,
                    'childs' => $child_level
                );

                $data[] = $level;
            }
        }
        //echo '<pre>';print_r($data); echo '</pre>'; exit;
        return $data;
    }

    public static function nestedMenu($parent = 0, $position = 'top', $active = '1') {
        $_this = & get_Instance();
        $active = ($active == 'all' ? "" : "AND active ='1' ");
        $Q = $_this->db->query("
		SELECT 
			tb_menu.*
		FROM tb_menu WHERE parent_id ='" . $parent . "' " . $active . "  AND position ='{$position}'
		GROUP BY tb_menu.menu_id ORDER BY ordering			
		");

        return $Q->result();
    }

    public static function menusMulti($position = 'top', $active = '1') {
        $_this = & get_Instance();
        $data = array();
        $menu = self::nestedMenuMulti(0, $position, $active);
        foreach ($menu as $row) {
            $child_level = array();
            $p = json_decode($row->access_data, true);
            if ($row->allow_guest == 1) {
                $is_allow = 1;
            } else {
                $is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
            }
            if ($is_allow == 1) {

                $menus2 = self::nestedMenuMulti($row->menu_id, $position, $active);
                if (count($menus2) > 0) {
                    $level2 = array();
                    foreach ($menus2 as $row2) {
                        $p = json_decode($row2->access_data, true);
                        if ($row2->allow_guest == 1) {
                            $is_allow = 1;
                        } else {
                            $is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
                        }

                        if ($is_allow == 1) {

                            $menu2 = array(
                                'menu_id' => $row2->menu_id,
                                'module' => $row2->module,
                                'menu_type' => $row2->menu_type,
                                'url' => $row2->url,
                                'menu_name' => $row2->menu_name,
                                'menu_icons' => $row2->menu_icons,
                                'childs' => array()
                            );

                            $menus3 = self::nestedMenuMulti($row2->menu_id, $position, $active);
                            if (count($menus3) > 0) {
                                $child_level_3 = array();
                                foreach ($menus3 as $row3) {
                                    $p = json_decode($row3->access_data, true);
                                    if ($row3->allow_guest == 1) {
                                        $is_allow = 1;
                                    } else {
                                        $is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
                                    }
                                    if ($is_allow == 1) {
                                        $menu3 = array(
                                            'menu_id' => $row3->menu_id,
                                            'module' => $row3->module,
                                            'menu_type' => $row3->menu_type,
                                            'url' => $row3->url,
                                            'menu_name' => $row3->menu_name,
                                            'menu_icons' => $row3->menu_icons,
                                            'childs' => array()
                                        );
                                        $child_level_3[] = $menu3;
                                    }
                                }
                                $menu2['childs'] = $child_level_3;
                            }
                            $level2[] = $menu2;
                        }
                    }
                    $child_level = $level2;
                }

                $level = array(
                    'menu_id' => $row->menu_id,
                    'module' => $row->module,
                    'menu_type' => $row->menu_type,
                    'url' => $row->url,
                    'menu_name' => $row->menu_name,
                    'menu_icons' => $row->menu_icons,
                    'childs' => $child_level
                );

                $data[] = $level;
            }
        }
        //echo '<pre>';print_r($data); echo '</pre>'; exit;
        return $data;
    }

    public static function nestedMenuMulti($parent = 0, $position = 'top', $active = '1') {
        $_this = & get_Instance();
        $active = ($active == 'all' ? "" : "AND active ='1' ");
        $Q = $_this->db->query("
		SELECT 
			tb_menu.*
		FROM tb_menu WHERE parent_id ='" . $parent . "' " . $active . "  AND position IN ({$position})
		GROUP BY tb_menu.menu_id ORDER BY ordering			
		");

        return $Q->result();
    }

    public static function widget($position = 'right', $dynamicPosition = '', $active = '1') {
        $_this = & get_Instance();
        $active = ($active == 'all' ? "" : "AND widget_active ='1' ");
        if (empty($dynamicPosition)) {
            $Q = $_this->db->query("
		SELECT 
			tb_widgets.*
		FROM tb_widgets WHERE 1=1 " . $active . "  AND widget_position ='{$position}'
		GROUP BY tb_widgets.widget_id ORDER BY widget_ordering			
		");
        } else {
            $Q = $_this->db->query("
		SELECT 
			tb_widgets.*
		FROM tb_widgets WHERE 1=1 " . $active . "  AND widget_id IN (" . $dynamicPosition . ")
		GROUP BY tb_widgets.widget_id ORDER BY widget_ordering			
		");
        }
        return $Q->result();
    }

    public static function showUploadedFile($file, $path, $width = 50) {
		
        $file = str_replace('../writereaddata/', '', $file);
        $file = str_replace('./writereaddata/', '', $file);
        $files = str_replace('.', '', $path) . $file;
        if (file_exists('./' . $files) && $file != "") {
            //	echo $files ;
            $info = pathinfo($files);
            if ($info['extension'] == "jpg" || $info['extension'] == "jpeg" || $info['extension'] == "png" || $info['extension'] == "gif") {
                $path_file = str_replace("./", "", $path);
                return '<p><a href="' . site_url('') . $path_file . $file . '" target="_blank" class="previewImage">
				<img src="' . site_url('') . $path_file . $file . '" border="0" width="' . $width . '" class="img-circle" /></a></p>';
            } else {
                $path_file = str_replace("./", "", $path);
                return '<p> <a href="' . site_url('') . $path_file . $file . '" target="_blank"> ' . $file . ' </a>';
            }
        } else {
            $info = pathinfo($files);
            if (isset($info['extension'])) {
                if ($info['extension'] == "jpg" || $info['extension'] == "jpeg" || $info['extension'] == "png" || $info['extension'] == "gif") {
                    $path_file = str_replace("./", "", $path);
                    return "<img src='" . base_url('') . "/uploads/images/no-image.png' border='0' width='" . $width . "' class='img-circle' /></a>";
                }
            } else {
                
            }
        }
    }

    public static function alert($task, $message) {
        if ($task == 'error') {
            $alert = '<div class="alert alert-danger msg"><i class="fa fa-exclamation-circle"></i> ' . $message . ' </div>';
        } elseif ($task == 'success') {
            $alert = '<div class="alert alert-success msg"><i class="fa fa-check-circle"></i> ' . $message . ' </div>';
        } elseif ($task == 'warning') {
            $alert = '<div class="alert alert-warning msg"><i class="fa fa-exclamation-triangle"></i> ' . $message . ' </div>';
        } else {
            $alert = '<div class="alert alert-info msg"><i class="fa fa-info"></i> ' . $message . ' </div>';
        }
        return $alert;
    }

    public static function avatar($width = 75) {
        $_this = & get_Instance();
        $avatar = '<img alt="" src="http://www.gravatar.com/avatar/' . md5($_this->session->userdata('eid')) . '" class="img-circle" width="' . $width . '" />';
        $row = $_this->db->get_where("tb_users", array('id' => $_this->session->userdata('uid')))->row();
        $files = './uploads/users/' . $row->avatar;
        if ($row->avatar != '') {
            if (file_exists($files)) {
                return '<img src="' . site_url() . 'uploads/users' . '/' . $row->avatar . '" border="0" width="' . $width . '" class="img-circle" />';
            } else {
                return $avatar;
            }
        } else {
            return $avatar;
        }
    }

    public static function CF_encode_json($arr) {
        $str = json_encode($arr);
        $enc = base64_encode($str);
        $enc = strtr($enc, 'poligamI123456', '123456poligamI');
        return $enc;
    }

    public static function CF_decode_json($str) {
        $dec = strtr($str, '123456poligamI', 'poligamI123456');
        $dec = base64_decode($dec);
        $obj = json_decode($dec, true);
        return $obj;
    }

    public static function columnTable($table) {
        $columns = array();
        foreach (DB::select("SHOW COLUMNS FROM $table") as $column) {
            //print_r($column);
            $columns[] = $column->Field;
        }


        return $columns;
    }

    public static function encryptID($id, $decript = false, $pass = '', $separator = '-', & $data = array()) {
        $pass = $pass ? $pass : _APP_SECNUMBER;
        $pass2 = CNF_URL;
        $bignum = 200000000;
        $multi1 = 500;
        $multi2 = 50;
        $saltnum = 10000000;
        if ($decript == false) {
            $strA = self::alphaid(($bignum + ($id * $multi1)), 0, 0, $pass);
            $strB = self::alphaid(($saltnum + ($id * $multi2)), 0, 0, $pass2);
            $out = $strA . $separator . $strB;
        } else {
            $pid = explode($separator, $id);


            //    trace($pid);
            $idA = (self::alphaid($pid[0], 1, 0, $pass) - $bignum) / $multi1;
            $idB = (self::alphaid($pid[1], 1, 0, $pass2) - $saltnum) / $multi2;
            $data['id A'] = $idA;
            $data['id B'] = $idB;
            $out = ($idA == $idB) ? $idA : false;
        }
        return $out;
    }

    public static function toForm($forms, $layout) {
        $f = '';
        $block = $layout['column'];
        $format = $layout['format'];
        $display = $layout['display'];
        $title = explode(",", $layout['title']);

        if ($format == 'tab') {
            $f .='<ul class="nav nav-tabs">';

            for ($i = 0; $i < $block; $i++) {
                $active = ($i == 0 ? 'active' : '');
                $tit = (isset($title[$i]) ? $title[$i] : 'None');
                $f .= '<li class="' . $active . '"><a href="#' . trim(str_replace(" ", "", $tit)) . '" data-toggle="tab">' . $tit . '</a></li>
				';
            }
            $f .= '</ul>';
        }

        if ($format == 'tab')
            $f .= '<div class="tab-content">';
        for ($i = 0; $i < $block; $i++) {
            if ($block == 4) {
                $class = 'col-md-3';
            } elseif ($block == 3) {
                $class = 'col-md-4';
            } elseif ($block == 2) {
                $class = 'col-md-6';
            } else {
                $class = 'col-md-12';
            }

            $tit = (isset($title[$i]) ? $title[$i] : 'None');
            // Grid format 
            if ($format == 'grid') {
                $f .= '<div class="' . $class . '">
						<fieldset><legend> ' . $tit . '</legend>
				';
            } else {
                $active = ($i == 0 ? 'active' : '');
                $f .= '<div class="tab-pane m-t ' . $active . '" id="' . trim(str_replace(" ", "", $tit)) . '"> 
				';
            }



            $group = array();

            foreach ($forms as $form) {
                $tooltip = '';
                $required = ($form['required'] != '0' ? '<span class="asterix"> * </span>' : '');
                if ($form['view'] != 0) {
                    if ($form['field'] != 'entry_by') {
                        if (isset($form['option']['tooltip']) && $form['option']['tooltip'] != '')
                            $tooltip = $form['option']['tooltip'];
                        $hidethis = "";
                        if ($form['type'] == 'hidden')
                            $hidethis = 'hidethis';
                        $inhide = '';
                        if (count($group) > 1)
                            $inhide = 'inhide';
                        $show = '';
                        if ($form['type'] == 'hidden')
                            $show = 'style="display:none;"';
                        if ($form['form_group'] == $i) {
                            if ($display == 'horizontal') {
                                $f .= '					
								  <div class="form-group ' . $hidethis . ' ' . $inhide . '" ' . $show . '>
									<label for="' . $form['label'] . '" class=" control-label col-md-4 text-left"> ' . $form['label'] . ' ' . $required . '</label>
									<div class="col-md-8">
									  ' . self::formShow($form['type'], $form['field'], $form['required'], $form['option']) . ' <br />
									  <i> <small>' . $tooltip . '</small></i>
									 </div> 
								  </div> ';
                            } else {
                                $f .= '					
								  <div class="form-group ' . $hidethis . ' ' . $inhide . '" ' . $show . '>
									<label for="ipt" class=" control-label "> ' . $form['label'] . '  ' . $required . ' ' . $tooltip . ' </label>									
									  ' . self::formShow($form['type'], $form['field'], $form['required'], $form['option']) . ' 						
								  </div> ';
                            }
                        }
                    }
                }
            }
            if ($format == 'grid')
                $f .='</fieldset>';
            $f .= '
			</div>
			
			';
        }
        return $f;
    }

    public static function gridClass($layout) {
        $column = $layout['column'];
        $format = $layout['format'];

        if ($block == 4) {
            $class = 'col-md-3';
        } elseif ($block == 3) {
            $class = 'col-md-4';
        } elseif ($block == 2) {
            $class = 'col-md-6';
        } else {
            $class = 'col-md-12';
        }


        if (format == 'tab') {
            $tag_open = '<div class="col-md-">';
            $tag_close = '<div class="col-md-">';
        } elseif ($layout['format'] == 'accordion') {
            
        } else {
            $tag_open = '<div class="col-md-">';
            $tag_close = '</div>';
        }


        return $class;
    }

    public static function formShow($type, $field, $required, $option = array()) {
        $mandatory = '';
        $attribute = '';
        $extend_class = '';
        if (isset($option['attribute']) && $option['attribute'] != '') {
            $attribute = $option['attribute'];
        }
        if (isset($option['extend_class']) && $option['extend_class'] != '') {
            $extend_class = $option['extend_class'];
        }

        $show = '';
        if ($type == 'hidden')
            $show = 'style="display:none;"';

        if ($required == 'required') {
            $mandatory = "required";
        } else if ($required == 'email') {
            $mandatory = "required parsley-type='email' ";
        } else if ($required == 'url') {
            $mandatory = "required parsley-type='url' ";
        } else if ($required == 'date') {
            $mandatory = "'required parsley-type='dateIso' ";
        } else if ($required == 'numeric') {
            $mandatory = "required parsley-type='number' ";
        } else {
            $mandatory = '';
        }

        switch ($type) {
            default;
                $form = "<input type='text' class='form-control' placeholder='' value='<?php echo \$row['{$field}'];?>' name='{$field}'  {$mandatory} />";
                break;

            case 'textarea';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $form = "<textarea name='{$field}' rows='2' id='{$field}' class='form-control {$extend_class}'  
				         {$mandatory} {$attribute} ><?php echo \$row['{$field}'] ;?></textarea>";
                break;

            case 'textarea_editor';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $form = "<textarea name='{$field}' rows='2' id='editor' class='form-control markItUp {$extend_class}'  
						{$mandatory}{$attribute} ><?php echo \$row['{$field}'] ;?></textarea>";
                break;


            case 'text_date';
                $form = "
				<input type='text' class='form-control date' placeholder='' value='<?php echo \$row['{$field}'];?>' name='{$field}'
				style='width:150px !important;'	  {$mandatory} />";
                break;

            case 'text_time';
                $form = "<input  type='text' name='{$field}' id='{$field}' value='{{ \$row['{$field}'] }}' 
						{$mandatory}  {$attribute} style='width:150px !important;'  class='form-control {$extend_class}'
						data-date-format='yyyy-mm-dd'
						 />";
                break;

            case 'text_datetime';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                $form = "
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo \$row['{$field}'];?>' name='{$field}'
				style='width:150px !important;'	  {$mandatory} />";
                break;

            case 'select';
                if ($required != '0') {
                    $mandatory = 'required';
                }
                if ($option['opt_type'] == 'datalist') {
                    $optList = '';
                    $opt = explode("|", $option['lookup_query']);
                    for ($i = 0; $i < count($opt); $i++) {
                        $row = explode(":", $opt[$i]);
                        for ($i = 0; $i < count($opt); $i++) {

                            $row = explode(":", $opt[$i]);
                            $optList .= " '" . trim($row[0]) . "' => '" . trim($row[1]) . "' , ";
                        }
                    }
                    $form = "
					<?php \$" . $field . " = explode(',',\$row['" . $field . "']);
					";
                    $form .=
                            "\$" . $field . "_opt = array(" . $optList . "); ?>
					";

                    if (isset($option['is_multiple']) && $option['is_multiple'] == 1) {

                        $form .= "<select name='{$field}[]' rows='5' {$mandatory} multiple  class='select2 '  > ";
                        $form .= "
						<?php 
						foreach(\$" . $field . "_opt as \$key=>\$val)
						{
							echo \"<option  value ='\$key' \".(in_array(\$key,\$" . $field . ") ? \" selected='selected' \" : '' ).\">\$val</option>\"; 						
						}						
						?>";
                        $form .= "</select>";
                    } else {

                        $form .= "<select name='{$field}' rows='5' {$mandatory}  class='select2 '  > ";
                        $form .= "
						<?php 
						foreach(\$" . $field . "_opt as \$key=>\$val)
						{
							echo \"<option  value ='\$key' \".(\$row['" . $field . "'] == \$key ? \" selected='selected' \" : '' ).\">\$val</option>\"; 						
						}						
						?>";
                        $form .= "</select>";
                    }
                } else {
                    $form = "<select name='{$field}' rows='5' id='{$field}' code='{\${$field}}' 
							class='select2 {$extend_class}'  {$mandatory} {$attribute} ></select>";
                }
                break;

            case 'file';
                if ($required != '0') {
                    $mandatory = 'requred';
                }
                $form = "<input  type='file' name='{$field}' id='{$field}' ";
                $form .= "<?php if(\$row['$field'] =='') echo 'class=\"required\"' ;?> ";
                $form .= "style='width:150px !important;' {$attribute} />
					<?php echo SiteHelpers::showUploadedFile(\$row['{$field}'],'$option[path_to_upload]') ;?>
				";
                break;

            case 'radio';
                if ($required != '0') {
                    $mandatory = 'requred';
                }
                $opt = explode("|", $option['lookup_query']);
                $form = '';
                for ($i = 0; $i < count($opt); $i++) {
                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $form .= "
					<label class='radio radio-inline'>
					<input type='radio' name='{$field}' value ='" . ltrim(rtrim($row[0])) . "' {$mandatory} {$attribute}";
                    $form .= "<?php if(\$row['" . $field . "'] == '" . ltrim(rtrim($row[0])) . "') echo 'checked=\"checked\"';?>";
                    $form .= " > " . $row[1] . " </label>";
                }
                break;

            case 'checkbox';
                if ($required != '0') {
                    $mandatory = 'requred';
                }
                $opt = explode("|", $option['lookup_query']);
                $form = "<?php \$" . $field . " = explode(\",\",\$row['" . $field . "']); ?>";
                for ($i = 0; $i < count($opt); $i++) {

                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $form .= "
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='{$field}[]' value ='" . ltrim(rtrim($row[0])) . "' {$mandatory} {$attribute} class='{$extend_class}' ";
                    $form .= "
					<?php if(in_array('" . trim($row[0]) . "',\$" . $field . ")) echo 'checked';?> 
					";
                    $form .= " /> " . $row[1] . " </label> ";
                }
                break;
        }

        return $form;
    }

    public static function toView($grids) {
        $f = '';
        foreach ($grids as $grid) {
            if (isset($grid['conn']) && is_array($grid['conn'])) {
                $conn = $grid['conn'];
                //print_r($conn);exit;
            } else {
                $conn = array('valid' => 0, 'db' => '', 'key' => '', 'display' => '');
            }

            if ($grid['detail'] == '1') {
                if ($grid['attribute']['image']['active'] == '1') {
                    $val = "<?php echo SiteHelpers::showUploadedFile(\$row['" . $grid['field'] . "'],'" . $grid['attribute']['image']['path'] . "') ;?>";
                } elseif ($conn['valid'] == 1) {
                    $arr = implode(':', $conn);
                    //$arg = "'".$arr['valid'].":".$arr['db'].":".$arr['key'].":".$arr['display']."'";
                    $val = "<?php echo SiteHelpers::gridDisplayView(\$row['" . $grid['field'] . "'],'" . $grid['field'] . "','" . $arr . "') ;?>";
                } else {
                    $val = "<?php echo \$row['" . $grid['field'] . "'] ;?>";
                }
                $f .= "
					<tr>
						<td width='30%' class='label-view text-right'>" . $grid['label'] . "</td>
						<td>" . $val . " </td>
						
					</tr>
				";
            }
        }
        return $f;
    }

    public static function transForm($field, $forms = array(), $bulk = false, $value = '') {
        $_this = & get_Instance();
        $type = '';
        $bulk = ($bulk == true ? '[]' : '');

        $search = $_this->input->get('search');
        if ($search != '') {
            $fields = explode("|", $search);
            foreach ($fields as $f) {
                $array = explode(":", $f);
                if ($array[0] == $field)
                    $value = $array[1];
            }
        }


        $mandatory = '';
        foreach ($forms as $f) {
            if ($f['field'] == $field && $f['search'] == 1) {
                $type = ($f['type'] != 'file' ? $f['type'] : '');
                $option = $f['option'];
                $required = $f['required'];

                if ($required == 'required') {
                    $mandatory = "data-parsley-required='true'";
                } else if ($required == 'email') {
                    $mandatory = "data-parsley-type'='email' ";
                } else if ($required == 'date') {
                    $mandatory = "data-parsley-required='true'";
                } else if ($required == 'numeric') {
                    $mandatory = "data-parsley-type='number' ";
                } else {
                    $mandatory = '';
                }
            }
        }

        switch ($type) {
            default;
                $form = '';
                break;

            case 'text';
                $form = "<input  type='text' name='" . $field . "{$bulk}' class='form-control input-sm' $mandatory value='{$value}'/>";
                break;

            case 'text_date';
                $form = "<input  type='text' name='$field{$bulk}' class='date form-control input-sm' $mandatory value='{$value}'/> ";
                break;

            case 'text_datetime';
                $form = "<input  type='text' name='$field{$bulk}'  class='date form-control input-sm'  $mandatory value='{$value}'/> ";
                break;

            case 'select';


                if ($option['opt_type'] == 'external') {

                    $data = $_this->db->get($option['lookup_table'])->result();
                    $opts = '';
                    foreach ($data as $row):
                        $selected = '';
                    
                        if ($value == $row->{$option['lookup_key']})
                            $selected = 'selected="selected"';
                        $fields = explode("|", $option['lookup_value']);
                        //print_r($fields);exit;
                        $val = "";
                        foreach ($fields as $item => $v) {
                            if ($v != "")
                                $val .= $row->$v . " ";
                        }
                        $opts .= "<option $selected value='" . $row->{$option['lookup_key']} . "' $mandatory > " . $val . " </option> ";
                    endforeach;
                } else {
                    $opt = explode("|", $option['lookup_query']);
                    $opts = '';
                    for ($i = 0; $i < count($opt); $i++) {
                        $selected = '';
                        if ($value == ltrim(rtrim($opt[0])))
                            $selected = 'selected="selected"';
                        $row = explode(":", $opt[$i]);
                        $opts .= "<option $selected value ='" . ltrim(rtrim($row[0])) . "' > " . $row[1] . " </option> ";
                    }
                }
                $form = "<select name='$field{$bulk}'  class='form-control' $mandatory >
							<option value=''> -- Select  -- </option>
							$opts
						</select>";
                break;

            case 'radio';

                $opt = explode("|", $option['lookup_query']);
                $opts = '';
                for ($i = 0; $i < count($opt); $i++) {
                    $checked = '';
                    $row = explode(":", $opt[$i]);
                    $opts .= "<option value ='" . $row[0] . "' > " . $row[1] . " </option> ";
                }
                $form = "<select name='$field{$bulk}' class='form-control' $mandatory ><option value=''> -- Select  -- </option>$opts</select>";
                break;
        }

        return $form;
    }

    public static function viewColSpan($grid) {
        $i = 0;
        foreach ($grid as $t):
            if ($t['view'] == '1')
                ++$i;
        endforeach;
        return $i;
    }

    public static function blend($str, $data) {
        $src = $rep = array();

        foreach ($data as $k => $v) {
            $src[] = "{" . $k . "}";
            $rep[] = $v;
        }

        if (is_array($str)) {
            foreach ($str as $st) {
                $res[] = trim(str_ireplace($src, $rep, $st));
            }
        } else {
            $res = str_ireplace($src, $rep, $str);
        }

        return $res;
    }

    public static function toJavascript($forms, $app, $class) {
        $f = '';
        foreach ($forms as $form) {
            if ($form['view'] != 0) {
                if (preg_match('/(select)/', $form['type'])) {
                    if ($form['option']['opt_type'] == 'external') {
                        $table = $form['option']['lookup_table'];
                        $val = $form['option']['lookup_value'];
                        $key = $form['option']['lookup_key'];
                        $lookey = '';
                        if ($form['option']['is_dependency'])
                            $lookey .= $form['option']['lookup_dependency_key'];
                        $f .= self::createPreCombo($form['field'], $table, $key, $val, $app, $class, $lookey);
                    }
                }
            }
        }
        return $f;
    }

    public static function createPreCombo($field, $table, $key, $val, $app, $class, $lookey = null) {



        $parent = null;
        $parent_field = null;
        if ($lookey != null) {
            $parent = " parent: '#" . $lookey . "',";
            $parent_field = ":{$lookey}:";
        }
        $pre_jCombo = "
		\$(\"#{$field}\").jCombo(\"<?php echo site_url('administrator/{$class}/comboselect?filter={$table}:{$key}:{$val}') ?>$parent_field\",
		{ " . $parent . " selected_value : '<?php echo \$row[\"{$field}\"] ?>' });
		";
        return $pre_jCombo;
    }

    public static function _sort($a, $b) {

        if ($a['sortlist'] == $a['sortlist']) {
            return strnatcmp($a['sortlist'], $b['sortlist']);
        }
        return strnatcmp($a['sortlist'], $b['sortlist']);
    }

    static public function cropImage($nw, $nh, $source, $stype, $dest) {
        $size = getimagesize($source); // ukuran gambar
        $w = $size[0];
        $h = $size[1];
        switch ($stype) { // format gambar
            case 'gif':
                $simg = imagecreatefromgif($source);
                break;
            case 'jpg':
                $simg = imagecreatefromjpeg($source);
                break;
            case 'png':
                $simg = imagecreatefrompng($source);
                break;
        }
        $dimg = imagecreatetruecolor($nw, $nh); // menciptakan image baru
        $wm = $w / $nw;
        $hm = $h / $nh;
        $h_height = $nh / 2;
        $w_height = $nw / 2;
        if ($w > $h) {
            $adjusted_width = $w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
        } elseif (($w < $h) || ($w == $h)) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
        } else {
            imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }
        imagejpeg($dimg, $dest, 100);
    }

    public static function gridDisplay($val, $field, $arr) {
        $_this = & get_Instance();
        if (isset($arr['valid']) && $arr['valid'] == 1) {
            $fields = str_replace("|", ",", $arr['display']);
            $row = $_this->db->query(" SELECT " . $fields . " FROM " . $arr['db'] . " WHERE " . $arr['key'] . " = '" . $val . "' ")->row();
            if (count($row) >= 1) {

                $fields = explode("|", $arr['display']);
                $v = '';
                $v .= (isset($fields[0]) && $fields[0] != '' ? $row->{$fields[0]} . ' ' : '');
                $v .= (isset($fields[1]) && $fields[1] != '' ? $row->{$fields[1]} . ' ' : '');
                $v .= (isset($fields[2]) && $fields[2] != '' ? $row->{$fields[2]} . ' ' : '');


                return $v;
            } else {
                return '';
            }
        } else {
            return $val;
        }
    }

    public static function gridDisplay_array($val, $field, $arr) {
        $_this = & get_Instance();
        if (isset($arr['valid']) && $arr['valid'] == 1) {
            $fields = str_replace("|", ",", $arr['display']);
            $row = $_this->db->query(" SELECT " . $fields . " FROM " . $arr['db'] . " WHERE " . $arr['key'] . " = '" . $val . "' ")->row_array();
            if (count($row) >= 1) {

                $fields = explode("|", $arr['display']);
                $v = '';
                $v .= (isset($fields[0]) && $fields[0] != '' ? $row->$fields[0] . ' ' : '');
                $v .= (isset($fields[1]) && $fields[1] != '' ? $row->$fields[1] . ' ' : '');
                $v .= (isset($fields[2]) && $fields[2] != '' ? $row->$fields[2] . ' ' : '');


                return $v;
            } else {
                return '';
            }
        } else {
            return $val;
        }
    }

    public static function gridDisplayView($val, $field, $arr) 
	{
		
        $arr = explode(':', $arr);
        $_this = & get_Instance();
        if (isset($arr['0']) && $arr['0'] == 1) {
	
            $row = $_this->db->query(" SELECT " . str_replace("|", ",", $arr['3']) . " FROM " . $arr['1'] . " WHERE " . $arr['2'] . " = '" . $val . "' ")->row();
            if (count($row) >= 1) {

                $fields = explode("|", $arr['3']);
                $v = '';
                $v .= (isset($fields[0]) && $fields[0] != '' ? $row->$fields[0] . ' ' : '');
                $v .= (isset($fields[1]) && $fields[1] != '' ? $row->$fields[1] . ' ' : '');
                $v .= (isset($fields[2]) && $fields[2] != '' ? $row->$fields[2] . ' ' : '');
                return $v;
            } else {
                return '';
            }
        } else {
            return $val;
        }
    }

    public static function langOption() {
        $lang = scandir('application/language/');
        $t = array();
        foreach ($lang as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_dir('application/language/' . $value)) {
                $fp = file_get_contents('application/language/' . $value . '/info.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }
        }
        return $t;
    }

    public static function themeOption() {
        $theme_path = base_path() . '/../administrator/themes/';
        $themes = scandir($theme_path);
        $t = array();
        foreach ($themes as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_dir($theme_path . $value) && file_exists($theme_path . $value . '/info.json')) {
                $fp = file_get_contents($theme_path . $value . '/info.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }
        }
        return $t;
    }

    public static function activeLang($label, $l) {
        $activeLang = Session::get('lang');
        $lang = (isset($l[$activeLang]) ? $l[$activeLang] : $label );
        return $lang;
    }

    public static function seoUrl($str, $separator = 'dash', $lowercase = FALSE) {
        if ($separator == 'dash') {
            $search = '_';
            $replace = '-';
        } else {
            $search = '-';
            $replace = '_';
        }

        $trans = array(
            '&\#\d+?;' => '',
            '&\S+?;' => '',
            '\s+' => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace . '+' => $replace,
            $replace . '$' => $replace,
            '^' . $replace => $replace,
            '\.+$' => ''
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }

        return trim(stripslashes(strtolower($str)));
    }

    public static function getHomeData($page_type, $limit = 3) {
        $_this = & get_Instance();
        $Q = $_this->db->query("
		SELECT 
			tb_pages.*
		FROM tb_pages WHERE 1=1 AND status ='enable'  AND page_type ='{$page_type}'
		GROUP BY tb_pages.pageID ORDER BY pageID Limit  {$limit}			
		");
        return $Q->result_array();
    }

    public static function gettableData($table_name, $id, $category_id, $status) {
        $_this = & get_Instance();
        $categoryArray = array();
        $Q = $_this->db->query("
		SELECT 
			{$table_name}.*
		FROM {$table_name} WHERE 1=1 AND {$status} ='enable' 
		GROUP BY {$table_name}.{$id} ORDER BY {$category_id} 			
		");
        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $categoryArray[$value[$category_id]][] = $value;
            }
        }
        return $categoryArray;
    }

    //Function created by Abhishek
    public static function gettable($table_name, $status, $id_key = NULL, $id_value = NULL) {
        $_this = & get_Instance();
        $categoryArray = array();
        if (!empty($id_key) && !empty($id_value)) {
            $Q = $_this->db->query("
		SELECT 
			*
		FROM {$table_name} WHERE " . $id_key . "='" . $id_value . "' and " . $status . "='enable'  			
		");
        } else {
            $Q = $_this->db->query("
		SELECT 
			{$table_name}.*
		FROM {$table_name} where " . $status . "='enable'		
		");
        }
        if (!empty($id_key) && !empty($id_value)) {
            return $Q->row_array();
        } else {

            return $Q->result_array();
        }
    }

    public static function getGames() {
        $_this = & get_Instance();
        $gamesArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_games.*
		FROM tb_games WHERE 1=1 AND game_status ='enable'
		GROUP BY tb_games.game_id ORDER BY game_id 			
		");

        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $gamesArray[$value['game_id']] = $value['game_title'];
            }
        }
        $_this->db->trans_complete();
        return $gamesArray;
    }

    public static function getDistricts() {
        $_this = & get_Instance();
        $districtArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_districts.*
		FROM tb_districts WHERE 1=1 AND districts_status ='enable'
		GROUP BY tb_districts.districts_id ORDER BY districts_id 			
		");

        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $districtArray[$value['districts_id']] = $value['districts_title'];
            }
        }
        $_this->db->trans_complete();
        return $districtArray;
    }

    public static function getCategories() {
        $_this = & get_Instance();
        $categoryArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_categories.*
		FROM tb_categories WHERE 1=1 AND category_status ='enable'
		GROUP BY tb_categories.category_id ORDER BY category_id 			
		");

        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $categoryArray[$value['category_id']] = $value['category_title'];
            }
        }
        $_this->db->trans_complete();
        return $categoryArray;
    }

    public static function getSliderImages($slider_id) {
        $_this = & get_Instance();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_slider_images.*
		FROM tb_slider_images WHERE 1=1 AND slider_image_status ='enable' AND slider_id = '{$slider_id}'
		GROUP BY tb_slider_images.slider_image_id ORDER BY slider_image_id 			
		");
        $_this->db->trans_complete();
        return $Q->result_array();
    }

    public static function getAwardedProfile($awardId) {
        $_this = & get_Instance();
        $awardArray = array();
        if (!empty($awardId)) {
            $is_array = explode(',', $awardId);
            $award = array();
            foreach ($is_array as $keyAward => $valueAward) {
                $Q = $_this->db->query("
		SELECT 
			tb_person_profile.*
		FROM tb_person_profile WHERE 1=1 AND profiler_status='enable' AND profiler_award LIKE '%{$valueAward}%'
		GROUP BY tb_person_profile.profiler_id ORDER BY profiler_id 			
		");
                if ($Q->result_array()) {
                    foreach ($Q->result_array() as $key => $value) {
                        $awardArray[$valueAward][] = $value;
                    }
                }
            }
        }

        return $awardArray;
    }

    public static function getCoachProfileList() {
        $_this = & get_Instance();
        $awardArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_person_profile.*
		FROM tb_person_profile WHERE 1=1 AND profiler_status='enable' AND profiler_type = '2'
		GROUP BY tb_person_profile.profiler_id ORDER BY profiler_id 			
		");
        $_this->db->trans_complete();
        return $Q->result_array();
    }

    public static function getGalleryImages($gallery_id) {
        $_this = & get_Instance();
        $galleryArray = array();
        if (!empty($gallery_id)) {
            $is_array = explode(',', $gallery_id);
            $gallery = array();
            foreach ($is_array as $keyGallery => $valueGallery) {
                $Q = $_this->db->query("
		SELECT 
			tb_gallary_images.*
		FROM tb_gallary_images WHERE 1=1 AND gallary_image_status ='enable' AND gallery_id IN ({$valueGallery})
		GROUP BY tb_gallary_images.gallary_image_id ORDER BY gallary_image_id 			
		");
                if ($Q->result_array()) {
                    foreach ($Q->result_array() as $key => $value) {
                        $galleryArray[$valueGallery][] = $value;
                    }
                }
            }


            return $galleryArray;
        }
    }

    public static function getGalleryVideos($gallery_id) {
        $_this = & get_Instance();
        $galleryArray = array();
        if (!empty($gallery_id)) {
            $is_array = explode(',', $gallery_id);
            $gallery = array();
            foreach ($is_array as $keyGallery => $valueGallery) {
                $Q = $_this->db->query("
		SELECT 
			tb_gallary_videos.*
		FROM tb_gallary_videos WHERE 1=1 AND gallary_video_status ='enable' AND gallery_id IN ({$valueGallery})
		GROUP BY tb_gallary_videos.gallary_video_id ORDER BY gallary_video_id 			
		");
                if ($Q->result_array()) {
                    foreach ($Q->result_array() as $key => $value) {
                        $galleryArray[$valueGallery][] = $value;
                    }
                }
            }


            return $galleryArray;
        }
    }

    public static function getGalleryAudios($gallery_id) {
        $_this = & get_Instance();
        $galleryArray = array();
        if (!empty($gallery_id)) {
            $is_array = explode(',', $gallery_id);
            $gallery = array();
            foreach ($is_array as $keyGallery => $valueGallery) {
                $Q = $_this->db->query("
		SELECT 
			tb_gallary_audios.*
		FROM tb_gallary_audios WHERE 1=1 AND gallary_audio_status ='enable' AND gallery_id IN ({$valueGallery})
		GROUP BY tb_gallary_audios.gallary_audio_id ORDER BY gallary_audio_id 			
		");
                if ($Q->result_array()) {
                    foreach ($Q->result_array() as $key => $value) {
                        $galleryArray[$valueGallery][] = $value;
                    }
                }
            }


            return $galleryArray;
        }
    }

    public static function getGallery($type = 'image') {
        $_this = & get_Instance();
        $galleryArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_galleries.*
		FROM tb_galleries WHERE 1=1 AND galleries_status ='enable' AND galleries_type = '{$type}' 
		GROUP BY tb_galleries.galleries_id ORDER BY galleries_id 			
		");

        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $galleryArray[$value['galleries_id']] = $value['galleries_title'];
            }
        }
        $_this->db->trans_complete();
        return $galleryArray;
    }

    public static function getAwards() {
        $_this = & get_Instance();
        $awardArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_awards.*
		FROM tb_awards WHERE 1=1 AND award_status ='enable'
		GROUP BY tb_awards.award_id ORDER BY award_id 			
		");

        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $awardArray[$value['award_id']] = $value['award_name'];
            }
        }
        $_this->db->trans_complete();
        return $awardArray;
    }

    public static function get_profiler_by_staffposition($staff_id) {
        $_this = & get_Instance();
        $awardArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_person_profile.*
		FROM tb_person_profile WHERE 1=1 AND profiler_status='enable' AND profiler_staff_position=" . $staff_id . "
		GROUP BY tb_person_profile.profiler_id ORDER BY profiler_id 			
		");
        $_this->db->trans_complete();
        return $Q->result_array();
    }

    public static function get_unique_value_from_table($table, $key, $value, $status, $id_key = NULL, $id_val = NULL) {
        $_this = & get_Instance();
        $categoryArray = array();
        if (!empty($id_key) && !empty($id_val)) {
            $_this->db->trans_start();
            $Q = $_this->db->query("
		SELECT 
			*
		FROM {$table} WHERE " . $key . "='" . $value . "' and " . $id_key . "!=" . $id_val . " and " . $status . "='enable'  			
		");
            $_this->db->trans_complete();
        } else {
            $_this->db->trans_start();
            $Q = $_this->db->query("
		SELECT 
			*
		FROM {$table} WHERE " . $key . "='" . $value . "' and " . $status . "='enable'		
		");
            $_this->db->trans_complete();
        }

        return $Q->num_rows();
    }

    public static function getstaffposition() {
        $_this = & get_Instance();
        $districtArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			 staff_position.*
		FROM  staff_position WHERE 1=1 AND staff_position_status ='enable'
		GROUP BY staff_position.staff_position_id ORDER BY staff_position_id 			
		");

        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $districtArray[$value['staff_position_id']] = $value['post_name'];
            }
        }
        $_this->db->trans_complete();
        return $districtArray;
    }

    public static function removeCache() {
        if (ENVIRONMENT == 'development') {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . 'haryanasportscm/application/cache/*');
        } else {
            $files = glob($_SERVER['DOCUMENT_ROOT'] . 'haryanasportscm/application/cache/*');
        }
        foreach ($files as $file) { // iterate files
            $checkFiles = end(explode('.', $file));
            if ($checkFiles == 'htaccess' || $checkFiles == 'html') {
                
            } else {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
    }

    public static function create_alias($value) {
        return str_shuffle(str_replace(' ', '', $value));
    }

    public static function get_profile_data_in_row($table_name, $status, $id_key = NULL, $id_value = NULL) {
        $_this = & get_Instance();
        $categoryArray = array();

        if (!empty($id_key) && !empty($id_value)) {
            $_this->db->trans_start();
            $Q = $_this->db->query("
		SELECT 
			*
		FROM {$table_name} WHERE " . $id_key . "='" . $id_value . "' and " . $status . "='enable'  			
		");
            $_this->db->trans_complete();
        } else {
            $_this->db->trans_start();
            $Q = $_this->db->query("
		SELECT 
			{$table_name}.*
		FROM {$table_name} where " . $status . "='enable'		
		");
            $_this->db->trans_complete();
        }

        return $Q->row();
    }

    public static function get_table_in_id_as_key($table_name, $status_key, $group_key, $order_key) {
        $_this = & get_Instance();
        $resulttArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			" . $table_name . ".*
		FROM " . $table_name . " WHERE 1=1 AND " . $status_key . " ='enable'
		GROUP BY " . $table_name . "." . $group_key . " ORDER BY " . $order_key . " 			
		");
        $_this->db->trans_complete();
        if ($Q->result_array()) {

            foreach ($Q->result_array() as $value) {
                $resulttArray[$value[$order_key]] = $value[$group_key];
            }
        }
        return $resulttArray;
    }
	


    public static function get_calendar($table_name, $status_key, $order_key) {
        $_this = & get_Instance();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			" . $table_name . ".*
		FROM " . $table_name . " WHERE 1=1 AND " . $status_key . " ='enable'
		 ORDER BY " . $order_key . " DESC 			
		");
        $_this->db->trans_complete();
        return $Q->result_array();
    }

    public static function getgroup() {
        $_this = & get_Instance();
        $groupArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_groups.*
		FROM tb_groups WHERE 1=1
		GROUP BY tb_groups.group_id ORDER BY group_id 			
		");
        $_this->db->trans_complete();
        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $groupArray[$value['group_id']] = $value['name'];
            }
        }
        return $groupArray;
    }

    public static function create_meta_data($meta_type, $meta_type_id, $data, $id = NULL) {
        if ($id) {
            $get_meta_row = $this->db->get_where('tb_meta_data', array('meta_type_id' => $id, 'meta_type' => $meta_type))->num_rows();
            if ($get_meta_row > 0) {
                $meta_keys = implode(',', array_keys($data));
                $meta_value = implode(',', array_values($data));
                $insert_meta_data = array(
                    'meta_type' => $meta_type,
                    'meta_type_id' => $meta_type_id,
                    'meta_type_keys' => $meta_keys,
                    'meta_type_values' => $meta_value,
                    'meta_updated_date' => date('Y-m-d h:i:s')
                );
                $this->db->where('meta_type', $meta_type);
                return $this->db->where('meta_type_id', $id)->update('tb_meta_data', $insert_meta_data);
            } else {

                $meta_keys = implode(',', array_keys($data));
                $meta_value = implode(',', array_values($data));
                $insert_meta_data = array(
                    'meta_type' => $meta_type,
                    'meta_type_id' => $id,
                    'meta_type_keys' => $meta_keys,
                    'meta_type_values' => $meta_value,
                );

                return $this->db->insert('tb_meta_data', $insert_meta_data);
            }
        } else {

            $meta_keys = implode(',', array_keys($data));
            $meta_value = implode(',', array_values($data));
            $insert_meta_data = array(
                'meta_type' => $meta_type,
                'meta_type_id' => $meta_type_id,
                'meta_type_keys' => $meta_keys,
                'meta_type_values' => $meta_value,
            );

            return $this->db->insert('tb_meta_data', $insert_meta_data);
        }
    }

    public static function get_meta_data($meta_type_name, $meta_type_id) {
        $this->db->trans_start();
        $meta_data = $this->db->get_where('tb_meta_data', array('meta_type' => $meta_type_name, 'meta_type_id' => $meta_type_id))->row_array();
        $this->db->trans_complete();
        if (!empty($meta_data)) {
            $meta_key = explode(',', $meta_data['meta_type_keys']);
            $meta_data = explode(',', $meta_data['meta_type_values']);
            $get_meta = array();
            foreach ($meta_key as $key => $val) {
                $get_meta[$val] = $meta_data[$key];
            }

            return $get_meta;
        }
    }

    public static function get_decode_data($table, $columns, $jason_column) {
        if (!empty($columns)) {
            $column_name = implode(',', $columns);
        } else {
            $column_name = "*";
        }
        $this->db->trans_start();
        $data = $this->db->get($table)->row_array();
        $this->db->trans_complete();
        if (!empty($data)) {
            $decode_data = json_decode($data['form_data'], true);
            return $decode_data;
        }
    }

    public static function getGallerywithalldata($type = 'image') {
        $_this = & get_Instance();
        $galleryArray = array();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_galleries.*
		FROM tb_galleries WHERE 1=1 AND galleries_status ='enable' AND galleries_type = '{$type}' 
		GROUP BY tb_galleries.galleries_id ORDER BY galleries_id 			
		");
        $_this->db->trans_complete();
        if ($Q->result_array()) {
            foreach ($Q->result_array() as $key => $value) {
                $galleryArray[$value['galleries_id']] = $value;
            }
        }
        return $galleryArray;
    }

    public static function getGalleryImagesbygalleryid($gallery_id) {
        $_this = & get_Instance();
        $galleryArray = array();
        if (!empty($gallery_id)) {
            $_this->db->trans_start();
            $is_array = explode(',', $gallery_id);
            $gallery = array();
            foreach ($is_array as $keyGallery => $valueGallery) {

                $Q = $_this->db->where_in('gallery_id', $valueGallery)->group_by('gallary_image_id')->order_by('gallary_image_id')->get('tb_gallary_images');

                if ($Q->result_array()) {
                    foreach ($Q->result_array() as $key => $value) {
                        $galleryArray[$key] = $value;
                    }
                }
            }

            $_this->db->trans_complete();
            return $galleryArray;
        }
    }

    public static function checkid($id) {
        $_this = & get_Instance();

        if (!empty($id)) {

            $_this->db->trans_start();
            $count = $_this->db->get_where('tb_galleries', array('galleries_status' => 'enable', 'galleries_id' => $id))->num_rows();
            $_this->db->trans_complete();
            if (!empty($count) && $count > 0) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

    public static function get_menu_name($menu_name = null) {
        $get_menu_name = array();
		$active = '';
        $active = ($active == 'all' ? "" : "AND active ='1' ");
        if (!empty($menu_name)) {
            $_this = & get_Instance();
            $_this->db->trans_start();
            $Q = $_this->db->query("SELECT 
				tb_menu.menu_name,tb_menu.parent_id
			FROM tb_menu WHERE tb_menu.module ='" . trim($menu_name) . "' " . $active . "  AND position IN ('top')					
			");
            if ($Q->result()) {
                foreach ($Q->result() as $value) {
                    $get_menu_name[$value->parent_id] = $value->menu_name;
                }
            }
        }
        $_this->db->trans_complete();
        return $get_menu_name;
    }

    public static function get_menu_name_by_parent_id($parent = null) {
        $get_menu_name = '';
        $_this = & get_Instance();
        $active = ($active == 'all' ? "" : "AND active ='1' ");
        $_this->db->trans_start();
        $Q = $_this->db->query("SELECT 
				tb_menu.menu_name
			FROM tb_menu WHERE menu_id ='" . $parent . "' " . $active . "  AND position IN ('top')
				
			");
        if ($Q->result()) {
            foreach ($Q->result() as $value) {
                $get_menu_name = $value->menu_name;
            }
        }
        $_this->db->trans_complete();
        return $get_menu_name;
    }

    public static function get_page_name($pagename = null) {
        $get_page_name = '';
        if (!empty($pagename)) {
            $_this = & get_Instance();
            $_this->db->trans_start();
            $_this->db->select('tb_pages.title');
            $_this->db->where('tb_pages.alias', trim($pagename));
            $Q = $_this->db->get("tb_pages");
            if ($Q->result()) {
                foreach ($Q->result() as $value) {
                    $get_page_name = $value->title;
                }
            }
        }
        $_this->db->trans_complete();
        return $get_page_name;
    }
	
	public static function get_page_name_by_id() {
        $get_page_name = array();
            $_this = & get_Instance();
            $_this->db->trans_start();
            $_this->db->select('tb_pages.pageID,tb_pages.alias');
            $Q = $_this->db->get("tb_pages");
            if ($Q->result()) {
                foreach ($Q->result() as $value) {
                    $get_page_name[$value->pageID] = $value->alias;
                }
            }
        $_this->db->trans_complete();
        return $get_page_name;
    }
	
	public static function pageInfo($pageId = 1, $tableName = 'file') {
        $_this = & get_Instance();
        if (!empty($tableName)) {
		if($pageId == 428){
		 $Q = $_this->db->query("SELECT tb_page_".$tableName.".*	FROM tb_page_".$tableName." WHERE 1=1 AND tb_page_".$tableName."_status = 'Enabled' AND tb_page_".$tableName."_pageId = ".$pageId."  GROUP BY tb_page_".$tableName.".tb_page_".$tableName."_id ORDER BY tb_page_".$tableName.".tb_page_".$tableName."_updated_date,tb_page_".$tableName.".tb_page_".$tableName."_id,tb_page_".$tableName.".tb_page_".$tableName."_title");
		} else {
		 $Q = $_this->db->query("SELECT tb_page_".$tableName.".*	FROM tb_page_".$tableName." WHERE 1=1 AND tb_page_".$tableName."_status = 'Enabled' AND tb_page_".$tableName."_pageId = ".$pageId."  GROUP BY tb_page_".$tableName.".tb_page_".$tableName."_id ORDER BY tb_page_".$tableName.".tb_page_".$tableName."_created_date DESC");
		}
           
			return $Q->result();
        } 
		return null;
       
    }
	
	public static function pageFileInfo($pageId = 1, $tableName = 'file') {
        $_this = & get_Instance();
        if (!empty($tableName)) {
            $Q = $_this->db->query("SELECT tb_page_".$tableName.".*	FROM tb_page_".$tableName." WHERE 1=1 AND tb_page_".$tableName."_status = 'Enabled' AND tb_page_".$tableName."_id = ".$pageId."  GROUP BY tb_page_".$tableName.".tb_page_".$tableName."_id ORDER BY tb_page_".$tableName.".tb_page_".$tableName."_title");
			return $Q->row_array();
        } 
		return null;
       
    }
	
	public static function getTickers() {
        $_this = & get_Instance();
        $_this->db->trans_start();
        $Q = $_this->db->query("
		SELECT 
			tb_ticker.*
		FROM tb_ticker WHERE ticker_status ='enable' 
		GROUP BY tb_ticker.ticker_id ORDER BY ticker_id 			
		");
        $_this->db->trans_complete();
        return $Q->result_array();
    }

}
