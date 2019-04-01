<?php 


function kcn_call_fund() {
    add_menu_page('Danh sách đăng ký gọi vốn', 'Danh sách đăng ký gọi vốn', 'administrator', 'kcn_call_fund', 'kcn_show_fund_registration', '', 10);
}

add_action('admin_menu', 'kcn_call_fund'); 



function kcn_construction_bidding() {
    add_menu_page('Xây dựng', 'Xây dựng', 'administrator', 'kcn_construction_bidding', 'kcn_show_construction_bidding', '', 11);
}

add_action('admin_menu', 'kcn_construction_bidding'); 


function kcn_bat_dong_san() {
    add_menu_page('Bất động sản', 'Bất động sản', 'administrator', 'kcn_bat_dong_san', 'kcn_show_bat_dong_san', '', 12);
}

add_action('admin_menu', 'kcn_bat_dong_san'); 


function kcn_ngan_hang() {
    add_menu_page('Ngân hàng', 'Ngân hàng', 'administrator', 'kcn_ngan_hang', 'kcn_show_ngan_hang', '', 12);
}

add_action('admin_menu', 'kcn_ngan_hang'); 





function kcn_project_registration() {
	add_menu_page('Thành viên đăng ký tư vấn', 'Thành viên đăng ký tư vấn', 'administrator', 'kcn_project_registration', 'kcn_show_registration', '', 20);
}

add_action('admin_menu', 'kcn_project_registration'); 


function kcn_product_bidding() {
	add_menu_page('Đấu giá sản phẩm', 'Đấu giá sản phẩm', 'administrator', 'kcn_product_bidding', 'kcn_show_bidding', '', 20);
}

add_action('admin_menu', 'kcn_product_bidding'); 


function kcn_sharktank_bidding() {
    add_menu_page('Thành viên góp vốn cho Shark', 'Thành viên góp vốn cho Shark', 'administrator', 'kcn_sharktank_bidding', 'kcn_show_sharktank_bidding', '', 20);
}

add_action('admin_menu', 'kcn_sharktank_bidding'); 



function kcn_change_pass() {
    add_menu_page('Thay đổi mật khẩu', 'Thay đổi mật khẩu', 'subscriber', 'kcn_change_pass', 'kcn_show_change_pass', '', 10);
}

add_action('admin_menu', 'kcn_change_pass'); 





// end view

//filer product 


function kcn_filter_product() {
    global $wpdb;
    
    $table = $wpdb->prefix . 'user_bookmarks'; 
    $user_id =  get_current_user_id();
    $district_id =  sanitize_text_field($_POST['district_id']);
    $price_range =  sanitize_text_field($_POST['price_range']);

    $grid_head = ' <table>
            <tr>
              <th><img src="' . get_template_directory_uri() . '/images/ico-masanpham.png" alt="" />Mã sản phẩm</th>
              <th><img src="' . get_template_directory_uri() . '/images/ico-diachi.png" alt="" />Quận</th>
              <th><img src="' . get_template_directory_uri() . '/images/ico-giamuonban.png" alt="" />Giá muốn bán</th>
              <th><img src="' . get_template_directory_uri() . '/images/ico-thuongluong.png" alt="" />Thương lượng</th>
              <th class="m-hide"><img src="' . get_template_directory_uri() . '/images/ico-giamuonmua.png" alt="" />Giá muốn mua</th>
              <th class="m-hide"><img src="' . get_template_directory_uri() . '/images/ico-chongiohang.png" alt="" />Chọn giỏ hàng</th>
            </tr>';


    //search 3 cai hot 
    if ($district_id >0 && $price_range >0) {

        $args = array (
            'posts_per_page' => 3,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
       
            'meta_query'    => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'district',
                    'value'     => $district_id,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'khung_gia_san_pham',
                    'value'     => $price_range,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'hot_product',
                    'value'     => 1,
                    'compare'   => '='
                )

            )

     );

    } else if ($district_id > 0 && $price_range ==0) {

        $args = array (
            'posts_per_page' => 3,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
       
            'meta_query'    => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'district',
                    'value'     => $district_id,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'hot_product',
                    'value'     => 1,
                    'compare'   => '='
                )

            )

        );

    } else if ($district_id == 0 && $price_range >0 ) {
        $args = array (
            'posts_per_page' => 3,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
       
            'meta_query'    => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'khung_gia_san_pham',
                    'value'     => $price_range,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'hot_product',
                    'value'     => 1,
                    'compare'   => '='
                )

            )

        );
    } else {
        $args = array (
            'posts_per_page' => 3,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_query'    => array(
                array(
                    'key'       => 'hot_product',
                    'value'     => 1,
                    'compare'   => '='
                )

            )
        );
    }
    

    $hot_products = new WP_Query($args);


    while ($hot_products->have_posts()) : $hot_products->the_post();    

    
              $post_id = get_the_ID();
              $user_id =  get_current_user_id();
              $quan = get_field('district');
              $gia_ban = get_field('sell_price');
              $thuong_luong = (get_field('negotiation') == true) ? 'Thương Lượng'  : 'Cố Định';
              $tra_gia = (get_field('buy_price') <> '') ? get_field('buy_price') . ' tỉ' : '-'  ;
              $id = get_the_ID();
              $masp = get_the_title();

              $check_existed_record = $wpdb->get_results("SELECT * FROM $table WHERE post_id = ".$post_id." and user_id=" . $user_id);

              if($wpdb->num_rows > 0) {
                  $label = "Bỏ lưu";
              } else {
                  $label = "Lưu tin" ; 
              }

              if (is_user_logged_in()) {
                  $link = get_the_permalink();
                  $detail_link = '<a href="' . $link . '"><span class="masp">'. $masp . '</span></a>';
                  $bookmark_button = '<button type="submit" id="'. $id . '" class="bookmark" data-id="' . $id. '">' . $label . '</button>';
              } else {
                  $link = "/wp-login.php";
                  $detail_link = '<a href="' . $link . '" title="Vui lòng đăng nhập để xem"><span class="masp">'. $masp . '</span></a>';
                  $bookmark_button = '<a class="not_login" href="' . $link . '" title="Vui lòng đăng nhập">Lưu tin</a>';
              }

             $grid_hot_row = $grid_hot_row . ' <tr class="hot">
              <td>' .     $detail_link . '</td>
              <td>' . $quan . ' </td>
              <td>' . $gia_ban . ' tỉ</td>
              <td>' . $thuong_luong . '</td>
              <td class="m-hide">' . $tra_gia . '</td>
              <td class="m-hide">' . $bookmark_button . '</td>
            </tr>';

    endwhile; wp_reset_postdata();


    // load cac san pham binh thuong


    if ($district_id >0 && $price_range >0) {

        $args = array (
            'posts_per_page' => -1,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
       
            'meta_query'    => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'district',
                    'value'     => $district_id,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'khung_gia_san_pham',
                    'value'     => $price_range,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'hot_product',
                    'value'     => 0,
                    'compare'   => '='
                )

            )

     );

    } else if ($district_id > 0 && $price_range ==0) {

        $args = array (
            'posts_per_page' => -1,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
       
            'meta_query'    => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'district',
                    'value'     => $district_id,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'hot_product',
                    'value'     => 0,
                    'compare'   => '='
                )

            )

        );

    } else if ($district_id == 0 && $price_range >0 ) {
        $args = array (
            'posts_per_page' => -1,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
       
            'meta_query'    => array(
                'relation'      => 'AND',
                array(
                    'key'       => 'khung_gia_san_pham',
                    'value'     => $price_range,
                    'compare'   => '='
                ),
                array(
                    'key'       => 'hot_product',
                    'value'     => 0,
                    'compare'   => '='
                )

            )

        );
    } else {
        $args = array (
            'posts_per_page' => -1,
            'post_type' => 'products',
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_query'    => array(
                array(
                    'key'       => 'hot_product',
                    'value'     => 0,
                    'compare'   => '='
                )

            )
        );
    }
    

    $normal_products = new WP_Query($args);


    while ($normal_products->have_posts()) : $normal_products->the_post();    

    
              $post_id = get_the_ID();
              $user_id =  get_current_user_id();
              $quan = get_field('district');
              $gia_ban = get_field('sell_price');
              $thuong_luong = (get_field('negotiation') == true) ? 'Thương Lượng'  : 'Cố Định';
             // $tra_gia = get_field('buy_price');
             $tra_gia = (get_field('buy_price') <> '') ? get_field('buy_price') . ' tỉ' : '-'  ;

              $id = get_the_ID();
              $masp = get_the_title();

              $check_existed_record = $wpdb->get_results("SELECT * FROM $table WHERE post_id = ".$post_id." and user_id=" . $user_id);

              if($wpdb->num_rows > 0) {
                  $label = "Bỏ lưu";
              } else {
                  $label = "Lưu tin" ; 
              }

              if (is_user_logged_in()) {
                  $link = get_the_permalink();
                  $detail_link = '<a href="' . $link . '"><span class="masp">'. $masp . '</span></a>';
                  $bookmark_button = '<button type="submit" id="'. $id . '" class="bookmark" data-id="' . $id. '">' . $label . '</button>';
              } else {
                  $link = "/wp-login.php";
                  $detail_link = '<a href="' . $link . '" title="Vui lòng đăng nhập để xem"><span class="masp">'. $masp . '</span></a>';
                  $bookmark_button = '<a class="not_login" href="' . $link . '" title="Vui lòng đăng nhập">Lưu tin</a>';
              }

             $grid_normal_row = $grid_normal_row . ' <tr>
              <td>' .     $detail_link . '</td>
              <td>' . $quan . '</td>
              <td>' . $gia_ban . ' tỉ</td>
              <td>' . $thuong_luong . '</td>
              <td class="m-hide">' . $tra_gia . '</td>
              <td class="m-hide">' . $bookmark_button . '</td>
            </tr>';

    endwhile; wp_reset_postdata();





   header("Content-type: text/html");
    
   echo $grid_head . $grid_hot_row . $grid_normal_row . '</table>';

   //echo $hot_products;


    /*    if ($result == 1) {
            $response = array (
                'response' => 'success',
                'id' => $post_id,
                'action' => ($todo == 'Lưu tin' ? 'booked' : 'unbooked')   
            );
        } else {
            $response = array (
                'response' => 'failed',
                'action' => ($todo == 'Lưu tin' ? 'booked' : 'unbooked')   
            );
        }

    } */

    die;
}

add_action( 'wp_ajax_kcn_filter_product' , 'kcn_filter_product');
add_action( 'wp_ajax_nopriv_kcn_filter_product' , 'kcn_filter_product');







function kcn_bookmark_product() {
    if ($_POST['action'] =='kcn_bookmark_product') {
        global $wpdb;
        $table = $wpdb->prefix . 'user_bookmarks'; 
        $post_id = sanitize_text_field($_POST['id']);
        $user_id =  get_current_user_id();
        $todo = sanitize_text_field($_POST['todo']);


         $data = array(
                'post_id' => $post_id,
                'user_id' => $user_id,
            );

        $format = array(
                    '%d',
                    '%d'
        );

        
        if ($todo  == 'Lưu tin') {
            $result = $wpdb->insert($table, $data, $format);
        } else if($todo == 'Bỏ lưu') {
            $result = $wpdb->delete($table, $data, $format);
        }

       
        
        if ($result == 1) {
            $response = array (
                'response' => 'success',
                'id' => $post_id,
                'action' => ($todo == 'Lưu tin' ? 'booked' : 'unbooked')   
            );
        } else {
            $response = array (
                'response' => 'failed',
                'action' => ($todo == 'Lưu tin' ? 'booked' : 'unbooked')   
            );
        }

    }

    die(json_encode($response));
}

add_action( 'wp_ajax_kcn_bookmark_product' , 'kcn_bookmark_product');
add_action( 'wp_ajax_nopriv_kcn_bookmark_product' , 'kcn_bookmark_product');


//load phuong


function kcn_load_wards() {
    
        global $wpdb;
        $table = $wpdb->prefix . 'wards'; 
        $post_id = sanitize_text_field($_POST['id']);
     
        $danhsachphuong = $wpdb->get_results("SELECT * FROM $table WHERE parent_code = ".$post_id . " ORDER BY name asc", ARRAY_A);

        if (count($danhsachphuong)>0) {
            $response = array (
                'response' => 'success',
                'list_ward' => $danhsachphuong,
                   
            );     
        } else {
            $response = array (
                'response' => 'failed',     
            );    
        }

    die(json_encode($response));
}

add_action( 'wp_ajax_kcn_load_wards' , 'kcn_load_wards');



// end load phuong



if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}


/*  Danh sách đăng ký dự án */
 
class Registration_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'registration',
            'plural' => 'registrations',
        ));
    }


    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
           // 'view' => sprintf('<a href="?page=kcn_project_registration&action=view&id=%s">%s</a>', $item['id'], __('Xem chi tiết', 'kcn')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'] <> '' ? $item['client_name']  : 'Khách vãng lai'   ,
            $this->row_actions($actions)
        );
    }



    function column_project_name($item)
    {
        return  $item['project_name'] ;
    }


    function column_client_phone($item)
    {
        
        return $item['user_id'] > 0 ? $item['client_phone'] : $item['guest_phone'];
    }



    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Số điện thoại', 'kcn'),
            'project_name' => __('Tên dự án', 'kcn'),
            'created' => __('Ngày đăng ký', 'kcn'),
        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', true),
            'project_name' => array('project_name', true),
            'created' => array('created', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'project_register'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_register = $wpdb->prefix . 'project_register';
		$table_project =  $wpdb->prefix . 'posts';
		$table_user = $wpdb->prefix . 'users';

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_register");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created	';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

      //  $sql_query = 	"SELECT R.*, R.id, P.post_title as project_name, U.display_name as client_name from $table_register R inner join $table_project P on R.project_id = P.ID inner join $table_user U on R.user_id = U.id ORDER BY $orderby $order LIMIT %d OFFSET %d". $per_page . $paged ;

       // echo $sql_query;

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  R.id,R.user_id, R.created, P.post_title as project_name, U.display_name as client_name, U.user_login as client_phone, R.user_phone as guest_phone from $table_register R inner join $table_project P on R.project_id = P.ID left join $table_user U on R.user_id = U.id ORDER BY $orderby $order LIMIT %d,  %d", $paged * $per_page, $per_page), ARRAY_A);




        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}






/* End danh sach dang ky du an */



/*  Danh sách đấu giá sản phẩm */
 
class Bidding_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'bidding',
            'plural' => 'biddings',
        ));
    }


    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
            //'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'kcn')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'],
            $this->row_actions($actions)
        );
    }


 function column_client_phone($item)
    {
        
        $client_phone = get_field('so_dien_thoai', 'user_' . $item['user_id']);
      
        return $client_phone;
    }


    function column_product_code($item)
    {
        return  $item['product_code'] ;
    }



    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Số điện thoại', 'kcn'),
            'product_code' => __('Mã sản phẩm', 'kcn'),
            'created' => __('Ngày đấu giá', 'kcn'),
            'bid_price' => __('Trả giá ', 'kcn'),
        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', false),
            'product_code' => array('product_code', true),
            'created' => array('created', true),
            'bid_price' => array('bid_price', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'product_bid'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_bidding = $wpdb->prefix . 'product_bid';
		$table_product =  $wpdb->prefix . 'posts';
		$table_user = $wpdb->prefix . 'users';

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_bidding");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created	';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

      

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  B.id,B.created,B.bid_price, P.post_title as product_code, U.display_name as client_name, U.ID as user_id from $table_bidding B inner join $table_product P on B.product_id = P.ID inner join $table_user U on B.user_id = U.id ORDER BY $orderby $order LIMIT %d , %d", $paged * $per_page, $per_page), ARRAY_A);




        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}






/* End danh sach dau gia */

/*  Danh sách góp vốn */
 
class SharkTank_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'shark',
            'plural' => 'shanks',
        ));
    }


    function column_default($item, $column_name)
    {   

        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
            //'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'kcn')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'],
            $this->row_actions($actions)
        );
    }


    function column_client_phone($item)
    {
        
        $client_phone = get_field('so_dien_thoai', 'user_' . $item['user_id']);
      
        return $client_phone;
    }

    function column_shark_code($item)
    {
        return  $item['shark_code'] ;
    }



    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Điện thoại', 'kcn'),
            'shark_code' => __('Mã shark', 'kcn'),
            'created' => __('Ngày đấu giá', 'kcn'),
            'bid_price' => __('Giá ', 'kcn'),
        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', true),
            'shark_code' => array('shark_code', true),
            'created' => array('created', false),
            'bid_price' => array('bid_price', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sharktank_bid'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                //echo "DELETE FROM $table_name WHERE id IN($ids)";
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_bidding = $wpdb->prefix . 'sharktank_bid';
    $table_shark =  $wpdb->prefix . 'posts';
    $table_user = $wpdb->prefix . 'users';

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_bidding");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created ';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

      

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  B.id,B.created,B.bid_price, S.post_title as shark_code, U.display_name as client_name, U.ID as user_id from $table_bidding B inner join $table_shark S on B.sharktank_id = S.ID inner join $table_user U on B.user_id = U.id ORDER BY $orderby $order LIMIT %d , %d", $paged * $per_page, $per_page), ARRAY_A);





        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}






/* End danh sach góp vốn */


/*  Danh sách xay dung */
 
class Construction_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'construction',
            'plural' => 'constructions',
        ));
    }


    function column_default($item, $column_name)
    {   

        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
            //'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'kcn')),
           // 'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'] <> '' ? $item['client_name']  : 'Khách vãng lai'   ,
            $this->row_actions($actions)
        );
    }


    function column_client_phone($item)
    {
    
        return $item['user_id'] > 0 ? $item['client_phone'] : $item['guest_phone'];
    }





    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Điện thoại', 'kcn'),
            'created' => __('Ngày yêu cầu', 'kcn'), 
            'nhu_cau' => __('Nhu cầu ', 'kcn'),
        'vi_tri_hem' => __('Vị trí hẻm ', 'kcn'),
        'ban_ve' => __('Bản vẽ ', 'kcn')
        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', true),
            'created' => array('created', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'construction'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_construction = $wpdb->prefix . 'construction';
        $table_user = $wpdb->prefix . 'users';

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_construction");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created ';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

      

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  C.*, U.display_name as client_name, U.user_login as client_phone, C.user_phone as guest_phone from $table_construction C left join $table_user U on C.user_id = U.id ORDER BY $orderby $order LIMIT %d , %d", $paged * $per_page, $per_page), ARRAY_A);

        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}






/* End danh sach xây dựng */



/*  Danh sách đăng ký goi von */
 
class FundRising_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'fundrising',
            'plural' => 'fundrisings',
        ));
    }


    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
            'view' => sprintf('<a href="?page=kcn_call_fund&action=view&id=%s">%s</a>', $item['id'], __('Xem chi tiết', 'kcn')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'],
            $this->row_actions($actions)
        );
    }


    function column_client_phone($item)
    {
        
        return  $item['user_login'] ;
    }



    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Số điện thoại', 'kcn'),
            'total_cost' => __('Giá trị tài sản', 'kcn'),
            'needed_cost' => __('Số tiền cần gọi', 'kcn'),
            'created' => __('Ngày đăng ký', 'kcn'),
            'end_date' => __('Ngày kết thúc', 'kcn'),

        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', true),
            'end_date' => array('end_date', true),
            'created' => array('created', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'funds'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_funds = $wpdb->prefix . 'funds';
        $table_user = $wpdb->prefix . 'users';

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_funds");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created ';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

      //  $sql_query =  "SELECT R.*, R.id, P.post_title as project_name, U.display_name as client_name from $table_register R inner join $table_project P on R.project_id = P.ID inner join $table_user U on R.user_id = U.id ORDER BY $orderby $order LIMIT %d OFFSET %d". $per_page . $paged ;

       // echo $sql_query;

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  F.id,F.created, F.end_date,F.total_cost, F.needed_cost, U.display_name as client_name, U.user_login as user_login from $table_funds F inner join $table_user U on F.user_id = U.id ORDER BY $orderby $order LIMIT %d,  %d", $paged * $per_page, $per_page), ARRAY_A);


        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}






/* End danh sach dang ky du an */


/* BDS */



/*  Danh sách đăng ký goi von */
 
class BatDongSan_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'bds',
            'plural' => 'bdss',
        ));
    }


    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
            'view' => sprintf('<a href="?page=kcn_bat_dong_san&action=view&id=%s">%s</a>', $item['id'], __('Xem chi tiết', 'kcn')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'] <> '' ? $item['client_name']  : 'Khách vãng lai'   ,
            $this->row_actions($actions)
        );
    }


    function column_client_phone($item)
    {
        
        return ($item['user_id'] > 0 ? $item['client_phone'] : $item['guest_phone']);
    }



    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Số điện thoại', 'kcn'),
            'gia_ban' => __('Giá bán', 'kcn'),
            'dien_tich' => __('Diện tích', 'kcn'),
            'created' => __('Ngày đăng ký', 'kcn'),

        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', true),
            'end_date' => array('end_date', true),
            'created' => array('created', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'bds'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_funds = $wpdb->prefix . 'bds';
        $table_user = $wpdb->prefix . 'users';

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_funds");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created ';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';

      //  $sql_query =  "SELECT R.*, R.id, P.post_title as project_name, U.display_name as client_name from $table_register R inner join $table_project P on R.project_id = P.ID inner join $table_user U on R.user_id = U.id ORDER BY $orderby $order LIMIT %d OFFSET %d". $per_page . $paged ;

       // echo $sql_query;

        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  BDS.id,BDS.user_id, BDS.created, BDS.gia_ban, BDS.dien_tich,  U.display_name as client_name, U.user_login as client_phone, BDS.user_phone as guest_phone from $table_funds BDS left join $table_user U on BDS.user_id = U.id   ORDER BY $orderby $order LIMIT %d,  %d", $paged * $per_page, $per_page), ARRAY_A);


        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}




/* END BDS */



/*  Danh sách đăng ký goi von */
 
class NganHang_List_Table extends WP_List_Table
 { 
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => 'nganhang',
            'plural' => 'nganhangs',
        ));
    }


    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }



     function column_client_name($item)
    {

        $actions = array(
            'view' => sprintf('<a href="?page=kcn_ngan_hang&action=view&id=%s">%s</a>', $item['id'], __('Xem chi tiết', 'kcn')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Xóa', 'kcn')),
        );

        return sprintf('%s %s',
            $item['client_name'] <> '' ? $item['client_name']  : 'Khách vãng lai'   ,
            $this->row_actions($actions)
        );
    }


    function column_client_phone($item)
    {
        
        return ($item['user_id'] > 0 ? $item['client_phone'] : $item['guest_phone']);
    }



    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', 
            'client_name' => __('Tên khách hàng', 'kcn'),
            'client_phone' => __('Số điện thoại', 'kcn'),
            'so_tien_vay' => __('Số tiền vay', 'kcn'),
            'gia_tri_tai_san' => __('Giá trị tài sản', 'kcn'),
            'so_tien_tra_hang_thang' => __('Số tiền trả hàng tháng', 'kcn'),
            'created' => __('Ngày đăng ký', 'kcn')

        );
        return $columns;
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'client_name' => array('client_name', true),
            'end_date' => array('end_date', true),
            'created' => array('created', false),
        );
        return $sortable_columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'bank'; 

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items()
    {
        global $wpdb;


        $table_bank = $wpdb->prefix . 'bank';
        $table_user = $wpdb->prefix . 'users';
   

        $per_page = 10; 

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
       
        $this->process_bulk_action();

        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_bank");


        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'created ';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';


        $this->items = $wpdb->get_results($wpdb->prepare("SELECT  nganhang.id,nganhang.created, nganhang.so_tien_tra_hang_thang, nganhang.so_tien_vay, nganhang.gia_tri_tai_san, nganhang.user_id,  U.display_name as client_name,  U.user_login as client_phone, nganhang.user_phone as guest_phone from $table_bank nganhang left join $table_user U on nganhang.user_id = U.id   ORDER BY $orderby $order LIMIT %d,  %d", $paged * $per_page, $per_page), ARRAY_A);


        $this->set_pagination_args(array(
            'total_items' => $total_items, 
            'per_page' => $per_page,
            'total_pages' => ceil($total_items / $per_page) 
        ));
    }
}







function kcn_show_registration() { 
	 global $wpdb;

    $table = new Registration_List_Table();
    $table->prepare_items();

    $message = '';
   
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    } else if('view' === $table->current_action()) { ?>
       
        <div class="formdata">      
         <h2><?php _e('Danh sách đăng ký tư vấn', 'wpbc')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=kcn_project_registration');?>"><?php _e('<< Quay lại', 'wpbc')?></a>
    </h2>
    <form >
        <p>         
            <label for="name"><?php _e('Chào:', 'wpbc')?></label>
        <br>    
            <input id="name" name="name" type="text" style="width: 60%" value="<?php echo esc_attr($item['name'])?>"
                    required>
        </p><p> 
            <label for="lastname"><?php _e('Last Name:', 'wpbc')?></label>
        <br>
            <input id="lastname" name="lastname" type="text" style="width: 60%" value="<?php echo esc_attr($item['lastname'])?>"
                    required>
        </p><p>
            <label for="email"><?php _e('E-Mail:', 'wpbc')?></label> 
        <br>    
            <input id="email" name="email" type="email" style="width: 60%" value="<?php echo esc_attr($item['email'])?>"
                   required>
        </p><p>   
            <label for="phone"><?php _e('Phone:', 'wpbc')?></label> 
        <br>
            <input id="phone" name="phone" type="tel" style="width: 60%" value="<?php echo esc_attr($item['phone'])?>">
        </p><p>
            <label for="address"><?php _e('Address:', 'wpbc')?></label> 
        <br>
            <textarea id="address" name="address" cols="100" rows="3" maxlength="240"><?php echo esc_attr($item['address'])?></textarea>
        </p><p>  
            <label for="notes"><?php _e('Notes:', 'wpbc')?></label>
        <br>
            <textarea id="notes" name="notes" cols="100" rows="3" maxlength="240"><?php echo esc_attr($item['notes'])?></textarea>
        </p>
        </form>
        </div>
<?php 
        exit; 
} ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Danh sách đăng ký tư vấn', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php 

} 


function kcn_show_bidding() { 
	 global $wpdb;

    $table = new Bidding_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Danh sách đấu giá', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php } 



function kcn_show_sharktank_bidding() { 
     global $wpdb;

    $table = new SharkTank_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Danh sách góp vốn', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php }

function kcn_show_construction_bidding() { 
     global $wpdb;

    $table = new Construction_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('XÂY DỰNG', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php } 


function kcn_show_fund_registration() { 
     global $wpdb;

    $table = new FundRising_List_Table();
    $table->prepare_items();

    $table_name = $wpdb->prefix . 'funds'; 
    $table_user = $wpdb->prefix . 'users'; 

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    } else if ('view' === $table->current_action()) {

        $default = array(
        'id' => 0,
        'client_name' => '',
        'user_login' => '',
        'created' => '',
        'fund_description' => '',
        'total_cost' => '',
        'needed_cost' => '',
        'hinh_tai_san_0' => '',
        'hinh_tai_san_1' => '',
        'hinh_tai_san_2' => '',
        'hinh_tai_san_3' => '',
        'end_date' => ''
        );


        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT F.*, U.display_name as client_name, U.user_login as client_phone  FROM $table_name F inner join $table_user U on F.user_id = U.id   WHERE F.id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'kcn');
            } else { ?>

                 <h2><?php _e('Chi tiết thông tin ĐĂNG KÝ GỌI VỐN', 'kcn')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=kcn_call_fund');?>"><?php _e('<< Quay lại', 'wpbc')?></a>
    </h2>

                <style>
                    div.formdata {width: 98%; margin: 10px 0px 50px 0px; background-color: #fff;border: 1px solid #e5e5e5;}
                    div.formdata p {  border-top: 1px solid #e5e5e5;  padding: 5px 10px 0px 10px;    font-weight: bold;     margin: 10px 5px; 
                    }

                    div.formdata p a img {
                        display: inline-block;
                        margin-right: 10px;
                        width: 200px;
                    }

                    div.formdata p:first-child {
                        border-top: 0px solid #e5e5e5; 
                    }

                  
                    

                    div.formdata p span { font-weight: normal; }


                </style>

                <div class="formdata">      
                    <p>         
                        <?php _e('Tên khách hàng:', 'kcn')?>
                        <span><?php echo esc_attr($item['client_name'])?></span>
                    </p>
                    <p> 
                        <?php _e('Số điện thoại:', 'kcn')?>
                        <span><?php echo esc_attr($item['client_phone'])?></span>
                    </p>

                     <p> 
                        <?php _e('Ngày đăng:', 'kcn')?>
                        <span><?php echo esc_attr(date("d-m-Y",strtotime($item['created'])))?></span>
                    </p>

                      <p> 
                        <?php _e('Ngày kết thúc:', 'kcn')?>
                        <span><?php echo esc_attr(date("d-m-Y",strtotime($item['end_date'])))?></span>
                    </p>

                     <p> 
                        <?php _e('Giá trị tài sản:', 'kcn')?>
                        <span><?php echo esc_attr($item['total_cost'])?></span>
                    </p>

                     <p> 
                        <?php _e('Số tiền gọi vốn:', 'kcn')?>
                        <span><?php echo esc_attr($item['needed_cost'])?></span>
                    </p>

                     <p> 
                        <?php _e('Phương án gọi vốn: ', 'kcn')?>
                        <br>
                        <span><?php echo esc_attr($item['fund_description'])?></span>
                    </p>

                     <p> 
                        <?php _e('Hình tài sản: ', 'kcn')?>
                     </p>

                     <p class="hinh_minh_hoa">

                        <?php 
                           $uploads = wp_upload_dir();
                           $upload_path = $uploads['baseurl'] . '/tai-san/'; 


                            if (strlen($item['hinh_tai_san_0'] >0)) { ?>
                             
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_0']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_0']  ?>" ></a>  
                        
                        <?php } ?>



                         <?php 
                         
                            if (strlen($item['hinh_tai_san_1'] >0)) { ?>
                             
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_1']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_1']  ?>" ></a>  
                        
                        <?php } ?>


                         <?php 
                          

                            if (strlen($item['hinh_tai_san_2'] >0)) { ?>
                             
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_2']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_2']  ?>" ></a>  
                        
                        <?php } ?>

                         <?php 
                         

                            if (strlen($item['hinh_tai_san_3'] >0)) { ?>
                            
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_3']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_3']  ?>"></a>  
                        
                        <?php } ?>





                    </p>


                </div>    



            <?php     
                exit;
            }
        }

      }  //show detail fund //
?>
        
    
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Danh sách đăng ký gọi vốn', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>

<?php } ?>




<?php 

function kcn_show_bat_dong_san() { 
     global $wpdb;

    $table = new BatDongSan_List_Table();
    $table->prepare_items();

    $table_name = $wpdb->prefix . 'bds'; 
    $table_user = $wpdb->prefix . 'users'; 
    $table_district = $wpdb->prefix . 'districts'; 

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    } else if ('view' === $table->current_action()) {

        $default = array(
        'id' => 0,
        'client_name' => '',
        'user_login' => '',
        'created' => '',
        'mo_ta' => '',
        'dien_tich' => '',
        'hinh_tai_san_0' => '',
        'hinh_tai_san_1' => '',
        'hinh_tai_san_2' => '',
        'hinh_tai_san_3' => '',
        'thuong_luong' => ''
        );


        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT BDS.*, U.display_name as client_name, U.user_login as client_phone, BDS.user_phone as guest_phone FROM $table_name BDS left join $table_user U on BDS.user_id = U.id   WHERE BDS.id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'kcn');
            } else { ?>

                 <h2><?php _e('Chi tiết thông tin BẤT ĐỘNG SẢN', 'kcn')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=kcn_bat_dong_san');?>"><?php _e('<< Quay lại', 'wpbc')?></a>
    </h2>

               <style>
                    div.formdata {width: 98%; margin: 10px 0px 50px 0px; background-color: #fff;border: 1px solid #e5e5e5;}
                    div.formdata p {  border-top: 1px solid #e5e5e5;  padding: 5px 10px 0px 10px;    font-weight: bold;     margin: 10px 5px; 
                    }

                    div.formdata p a img {
                        display: inline-block;
                        margin-right: 10px;
                        width: 200px;
                    }

                    div.formdata p:first-child {
                        border-top: 0px solid #e5e5e5; 
                    }

                  
                    

                    div.formdata p span { font-weight: normal; }


                </style>

                <div class="formdata">      
    
                    <p>         
                        <?php _e('Tên khách hàng:', 'kcn')?>
                        <span><?php echo $item['user_id'] > 0 ? esc_attr($item['client_name']) : 'Khách vãng lai'?></span>
                    </p>
                    <p> 
                        <?php _e('Số điện thoại:', 'kcn')?>
                        <span><?php echo $item['user_id'] > 0 ? esc_attr($item['client_phone']) : esc_attr($item['guest_phone'])   ?></span>
                    </p>

                     <p> 
                        <?php _e('Ngày đăng:', 'kcn')?>
                        <span><?php echo esc_attr(date("d-m-Y",strtotime($item['created'])))?></span>
                    </p>

                      <p> 
                        <?php _e('Mô tả:', 'kcn')?>
                        <br>
                        <span><?php echo esc_attr($item['mo_ta'])?></span>
                    </p>

                     <p> 
                        <?php _e('Giá bán:', 'kcn')?>
                        <span><?php echo esc_attr($item['gia_ban'])?></span>
                    </p>

                     <p> 
                        <?php _e('Diện tích:', 'kcn')?>
                        <span><?php echo esc_attr($item['dien_tich'])?></span>
                    </p>

                

                      <p> 
                        <?php _e('Thương lượng: ', 'kcn')?>
                        <span><?php echo esc_attr($item['thuong_luong'] == 1 ? 'Có' : 'Không')?></span>
                    </p>

                     <p> 
                        <?php _e('Hình tài sản: ', 'kcn')?> </p>

                      <p class="hinh_minh_hoa">  

                        <?php 
                           $uploads = wp_upload_dir();
                           $upload_path = $uploads['baseurl'] . '/tai-san/'; 


                            if (strlen($item['hinh_tai_san_0'] >0)) { ?>
                           

                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_0']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_0']  ?>" width="400px"></a>  
                        
                        <?php } ?>



                         <?php 
                         
                            if (strlen($item['hinh_tai_san_1'] >0)) { ?>
                            
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_1']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_1']  ?>" width="400px"></a>  
                        
                        <?php } ?>


                         <?php 
                          

                            if (strlen($item['hinh_tai_san_2'] >0)) { ?>
                              
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_2']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_2']  ?>" width="400px"></a>  
                        
                        <?php } ?>

                         <?php 
                         

                            if (strlen($item['hinh_tai_san_3'] >0)) { ?>
                             
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_3']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_3']  ?>" width="400px"></a>  
                        
                        <?php } ?>





                    </p>


                </div>    



            <?php     
                exit;
            }
        }

      }  //show detail fund //
    ?>
        
    
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('BẤT ĐỘNG SẢN', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php 
} 
?>








<?php 

function kcn_show_ngan_hang() { 
     global $wpdb;

    $table = new NganHang_List_Table();
    $table->prepare_items();

    $table_name = $wpdb->prefix . 'bank'; 
    $table_user = $wpdb->prefix . 'users'; 
   

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'kcn'), count($_REQUEST['id'])) . '</p></div>';
    } else if ('view' === $table->current_action()) {

        $default = array(
        'id' => 0,
        'client_name' => '',
        'user_login' => '',
        'created' => '',
        'so_tien_vay' => '',
        'gia_tri_tai_san' => '',
        'phap_ly_tai_san' => '',
        'so_tien_tra_hang_thang' => '',
        'hinh_tai_san_0' => '',
        'hinh_tai_san_1' => '',
        'hinh_tai_san_2' => '',
        'hinh_tai_san_3' => ''
        );


        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT B.*, U.display_name as client_name, U.user_login as client_phone, B.user_phone as guest_phone FROM $table_name B left join $table_user U on B.user_id = U.id WHERE B.id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'kcn');
            } else { ?>

                 <h2><?php _e('Chi tiết thông tin NGÂN HÀNG', 'kcn')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=kcn_ngan_hang');?>"><?php _e('<< Quay lại', 'wpbc')?></a>
    </h2>

                 <style>
                    div.formdata {width: 98%; margin: 10px 0px 50px 0px; background-color: #fff;border: 1px solid #e5e5e5;}
                    div.formdata p {  border-top: 1px solid #e5e5e5;  padding: 5px 10px 0px 10px;    font-weight: bold;     margin: 10px 5px; 
                    }

                    div.formdata p a img {
                        display: inline-block;
                        margin-right: 10px;
                        width: 200px;
                    }

                    div.formdata p:first-child {
                        border-top: 0px solid #e5e5e5; 
                    }

                  
                    

                    div.formdata p span { font-weight: normal; }


                </style>

                <div class="formdata">      
    
                    <p>         
                        <?php _e('Tên khách hàng:', 'kcn')?>
                        <span><?php echo $item['user_id'] > 0 ? esc_attr($item['client_name']) : 'Khách vãng lai' ?></span>
                    </p>
                    <p> 
                        <?php _e('Số điện thoại:', 'kcn')?>
                        <span><?php echo $item['user_id'] > 0 ? esc_attr($item['client_phone']) : esc_attr($item['guest_phone'])   ?></span>
                    </p>

                     <p> 
                        <?php _e('Ngày đăng:', 'kcn')?>
                        <span><?php echo esc_attr(date("d-m-Y",strtotime($item['created'])))?></span>
                    </p>

                      <p> 
                        <?php _e('Số tiền vay:', 'kcn')?>
                 
                        <span><?php echo esc_attr($item['so_tien_vay'])?></span>
                    </p>

                     <p> 
                        <?php _e('Giá trị tài sản:', 'kcn')?>
                        <span><?php echo esc_attr($item['gia_tri_tai_san'])?></span>
                    </p>

                    

                    

             <p> 
                        <?php _e('Số tiền trả hàng tháng: ', 'kcn')?>
                        <span><?php echo esc_attr($item['so_tien_tra_hang_thang'])?></span>
                    </p>



           

                     <p> 
                        <?php _e('Hình tài sản: ', 'kcn')?> </p>

                      <p class="hinh_minh_hoa">  
                        <?php 
                           $uploads = wp_upload_dir();
                           $upload_path = $uploads['baseurl'] . '/tai-san/'; 


                            if (strlen($item['hinh_tai_san_0'] >0)) { ?>
                             

                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_0']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_0']  ?>" width="400px"></a>  
                        
                        <?php } ?>



                         <?php 
                         
                            if (strlen($item['hinh_tai_san_1'] >0)) { ?>
                             
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_1']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_1']  ?>" width="400px"></a>  
                        
                        <?php } ?>


                         <?php 
                          

                            if (strlen($item['hinh_tai_san_2'] >0)) { ?>
                            
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_2']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_2']  ?>" width="400px"></a>  
                        
                        <?php } ?>

                         <?php 
                         

                            if (strlen($item['hinh_tai_san_3'] >0)) { ?>
                             
                              <a target="_blank" href="<?php echo $upload_path . $item['hinh_tai_san_3']  ?>"><img src="<?php echo $upload_path . $item['hinh_tai_san_3']  ?>" width="400px"></a>  
                        
                        <?php } ?>





                    </p>


                </div>    



            <?php     
                exit;
            }
        }

      }  //show detail fund //
    ?>
        
    
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('NGÂN HÀNG', 'kcn')?> 
    </h2>
    <?php echo $message; ?>

    <form  method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php 
} 



function kcn_show_change_pass() { ?>



<h2><?php _e('Đổi mật khẩu', 'kcn')?> </h2>

                 <style>
                    div.formdata {width: 98%; margin: 10px 0px 50px 0px; background-color: #fff;border: 1px solid #e5e5e5;}
                    div.formdata p {  border-top: 1px solid #e5e5e5;  padding: 5px 10px 0px 10px;    font-weight: bold;     margin: 10px 5px; 
                    }

                    div.formdata p a img {
                        display: inline-block;
                        margin-right: 10px;
                        width: 200px;
                    }

                    div.formdata p:first-child {
                        border-top: 0px solid #e5e5e5; 
                    }


                    #your-profile label+a, fieldset label {
                        display: inline-block;
                        width: 100px;
                    }

                    #pippin_password_submit {
                        margin-left: 105px;
                    }

                    .success span {
                        margin-left: 15px;
                        display:inline-block;
                    }
                    

                    div.formdata p span { font-weight: normal; }


                </style>


            <div class="formdata">      
    
            <?php  echo do_shortcode('[password_form]') ; ?>     
  

            </div>

    

    
<?php } ?>
