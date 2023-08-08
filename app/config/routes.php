<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'homepage/home/index';
$route['404_override'] = '';

$route['trang-([0-9]+)'] = 'homepage/home/index/$1';
$route['xe-bus$'] = 'tour/frontend/home/index';
// Customers
$route['register'] = 'customers/frontend/auth/register';
$route['login'] = 'customers/frontend/auth/login';
$route['logout'] = 'customers/ajax/auth/logout';
$route['recovery'] = 'customers/frontend/auth/recovery';
$route['xac-minh'] = 'customers/ajax/auth/verify';
$route['profile'] = 'customers/frontend/account/information';
$route['password'] = 'customers/frontend/account/password';

$route['order-information'] = 'customers/frontend/account/order_information';
$route['list-post/trang-([0-9]+)$'] = 'customers/frontend/account/orderlist/$1';
$route['list-post$'] = 'customers/frontend/account/orderlist';
$route['edit-post/([0-9]+)$'] = 'customers/frontend/account/edit/$1';
$route['delete-post/([0-9]+)$'] = 'customers/frontend/account/delete/$1';


$route['list-doctor/trang-([0-9]+)$'] = 'customers/frontend/account/listview2/$1';
$route['list-doctor$'] = 'customers/frontend/account/listview2';

$route['list-customers/trang-([0-9]+)$'] = 'customers/frontend/account/listview/$1';
$route['list-customers$'] = 'customers/frontend/account/listview';


/* Đặt mua */
$route['dat-mua'] = 'products/frontend/cart/payment';
$route['dat-mua-thanh-cong'] = 'products/frontend/cart/success';
$route['inquiry'] = 'products/frontend/cart/inquiry';
/* ------------------------------------------------*/

$route['lich-hoc/trang-([0-9]+)$'] = 'lichhoc/frontend/catalogues/view/$2';
$route['lich-hoc$'] = 'lichhoc/frontend/catalogues/view';
$route['([a-zA-Z0-9/-]+)-lh([0-9]+)$'] = 'lichhoc/frontend/lichhoc/view/$2';

$route['dang-ky-truc-tuyen$'] = 'homepage/home/chungchi';


//Tag
$route['tags/([a-zA-Z0-9/-]+)-tag([0-9]+)$'] = 'tags/frontend/articles/view/$2';

/*mailsubricre*/
$route['mailsubricre$'] = 'mailsubricre/frontend/mailsubricre/create';
/*contact*/
$route['contact1$'] = 'contacts/frontend/contacts/create2';
// Sitemap
$route['sitemap'] = 'homepage/home/sitemap';
$route['sitemap.xml'] = 'homepage/home/sitemap/xml';

//Attributes
$route['([a-zA-Z0-9/-]+)-att([0-9]+)/trang-([0-9]+)$'] = 'attributes/frontend/attributes/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-att([0-9]+)$'] = 'attributes/frontend/attributes/view/$2';

// Frontend Articles
$route['([a-zA-Z0-9/-]+)-ac([0-9]+)/trang-([0-9]+)$'] = 'articles/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-ac([0-9]+)$'] = 'articles/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-a([0-9]+)$'] = 'articles/frontend/articles/view/$2';


//Introducts
$route['introducts'] = 'articles/frontend/introducts/view';

// Frontend Projects
$route['([a-zA-Z0-9/-]+)-qh([0-9]+)px([0-9]+)/trang-([0-9]+)$'] = 'projects/frontend/projects/location/$2/$3/$4';
$route['([a-zA-Z0-9/-]+)-qh([0-9]+)px([0-9]+)$'] = 'projects/frontend/projects/location/$2/$3';

$route['([a-zA-Z0-9/-]+)-jc([0-9]+)/trang-([0-9]+)$'] = 'projects/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-jc([0-9]+)$'] = 'projects/frontend/catalogues/view/$2';

$route['([a-zA-Z0-9/-]+)-j([0-9]+)$'] = 'projects/frontend/projects/view/$2';
$route['members/dang-tin$'] = 'projects/frontend/projects/create';

$route['project-search/trang-([0-9]+)$'] = 'projects/frontend/projects/search/$2';
$route['project-search$'] = 'projects/frontend/projects/search/';

$route['dang-ky-dang-tin-tron-goi$'] = 'projects/frontend/projects/register/';
$route['members/payment$'] = 'projects/frontend/projects/payment/';
$route['members/history$'] = 'projects/frontend/projects/history/';

// $route['tim-kiem/trang-([0-9]+)$'] = 'articles/frontend/search/view/$1';
// $route['tim-kiem'] = 'articles/frontend/search/view';

$route['tin-tuc/trang-([0-9]+)$'] = 'articles/frontend/catalogues/viewnew/$1';
$route['tin-tuc$'] = 'articles/frontend/catalogues/viewnew';

// Frontend Gallerys
$route['([a-zA-Z0-9/-]+)-gc([0-9]+)/trang-([0-9]+)$'] = 'gallerys/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-gc([0-9]+)$'] = 'gallerys/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-g([0-9]+)$'] = 'gallerys/frontend/gallerys/view/$2';

// Frontend Videos
$route['([a-zA-Z0-9/-]+)-vc([0-9]+)/trang-([0-9]+)$'] = 'videos/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-vc([0-9]+)$'] = 'videos/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-v([0-9]+)$'] = 'videos/frontend/videos/view/$2';

// Frontend Products
$route['products/trang-([0-9]+)$'] = 'products/frontend/home/view/$2';
$route['products$'] = 'products/frontend/home/view';

$route['([a-zA-Z0-9/-]+)-pc([0-9]+)/trang-([0-9]+)$'] = 'products/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-pc([0-9]+)$'] = 'products/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-p([0-9]+)$'] = 'products/frontend/products/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-p([0-9]+)$'] = 'products/frontend/products/view/$2';



// Frontend Documents
$route['([a-zA-Z0-9/-]+)-dc([0-9]+)/trang-([0-9]+)$'] = 'documents/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-dc([0-9]+)$'] = 'documents/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-d([0-9]+)$'] = 'documents/frontend/documents/view/$2';


//Frontend Address
$route['documents/trang-([0-9]+)$'] = 'address/frontend/address/index/$2';
$route['documents$'] = 'address/frontend/address/index';
$route['([a-zA-Z0-9/-]+)-ad([0-9]+)$'] = 'address/frontend/address/view/$2';


// Frontend Cart
$route['cart$'] = 'products/frontend/cart/view';
$route['payment$'] = 'products/frontend/cart/payment';
$route['step$'] = 'products/frontend/cart/step';


// Contacts 
$route['feedback$'] = 'contacts/frontend/contacts/view2';
$route['lien-he$'] = 'contacts/frontend/contacts/view';
$route['them-lien-he$'] = 'contacts/frontend/contacts/create';

//DAi lys
$route['dai-ly$'] = 'dailys/frontend/dailys/view';

//Tìm kiếm
// $route['tim-kiem-nang-cao'] = 'products/frontend/advancedsearch/view';

$route['tim-kiem/trang-([0-9]+)$'] = 'products/frontend/search/view/$1';
$route['tim-kiem'] = 'products/frontend/search/view';
$route['xay-dung-cau-hinh'] = 'products/frontend/search/xaydungcauhinh';
$route['chinh-sua-cau-hinh'] = 'products/frontend/search/chinhsuacauhinh';
$route['xem-va-in-cau-hinh'] = 'products/frontend/search/xemvaincauhinh';
$route['luu-tam-cau-hinh'] = 'products/frontend/search/sessionCauhinh';
$route['xem-va-in-cau-hinh-redirect'] = 'products/frontend/search/xemvaincauhinhredirect';
$route['pcbuilder_product_selection'] = 'products/frontend/search/pcbuilder';
$route['filter_product_selection'] = 'products/frontend/search/filter';
$route['export_download'] = 'products/frontend/search/export_download';

// Routers
$route['^([a-zA-Z0-9-]+)/trang-([0-9]+)$'] = 'homepage/routers/index/$1/$2';
$route['^([a-zA-Z0-9-]+)$'] = 'homepage/routers/index/$1';

$route[BACKEND_DIRECTORY] = 'dashboard/home/index';
$route[BACKEND_DIRECTORY.'/login'] = 'users/backend/auth/login';
$route[BACKEND_DIRECTORY.'/recovery'] = 'users/backend/auth/recovery';
$route['translate_uri_dashes'] = FALSE;
