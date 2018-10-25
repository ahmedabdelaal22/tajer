<?php

if (!function_exists('pr')) {

    function pr($data) {
        echo "<pre>";
        print_r($data, true);
        echo "</pre>";
    }

}
if (!function_exists('gender_types')) {

    function gender_types() {
        $gender_types = array('f' => 'female',
            'm' => 'male');
        return $gender_types;
    }

}
if (!function_exists('remove_non_numerics')) {
    function remove_non_numerics($str)
{ 
      $str= explode('.',$str)  ;
    $temp       = trim($str[0]);

    $result  = "";
    $pattern    = '/[^0-9]*/';
    $result     = preg_replace($pattern, '', $temp);

    return $result.'.'.@$str[1];
}
}
if (!function_exists('my_asset')) {

    function user_auth() {
        $sess_user_obj = session('user_obj');
        return $sess_user_obj;
    }

}
if (!function_exists('includeAsJsString')) {

    function includeAsJsString($template) {
        $string = view($template);
        return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string) $string), "\0..\37'\\")));
    }

}
if (!function_exists('includeAsJsString1')) {

    function includeAsJsString1($template, $admin_data) {
        $locale = App::getLocale();
        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';


        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'admin_data' => $admin_data,
            'locale_title' => $locale_title,
            'locale' => $locale,
        ];
        $string = view($template)->with($data);
        return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string) $string), "\0..\37'\\")));
    }

}
if (!function_exists('get_category')) {

    function get_category() {
        $locale = App::getLocale();
        $all_category = DB::table('categories')->where('active', 1)
                        ->select($locale . '_title as title', 'id', 'image')
                        ->orderBy('position', 'ASC')->get();


        return $all_category;

//
    }

}
// if (!function_exists('get_category_position_one')) {
//     function get_category_position_one() {
//         $locale = App::getLocale();
//         $all_category = DB::table('categories')->where('active', 1)
//                         ->select($locale . '_title as title', 'id','image')
//                         ->orderBy('position','ASC')->get();
//         return $all_category;
// //
//     }
// }


if (!function_exists('get_category_array')) {

    function get_category_array() {
        $locale = App::getLocale();
        $all_category = DB::table('categories')->where('active', 1)
                        ->select($locale . '_title as title', 'id')
                        ->orderBy('position', 'ASC')->get()->toArray();


        return $all_category;

//
    }

}
//

if (!function_exists('feature')) {

    function feature() {


        $all_feature = DB::table('items')->where('active', 1)->where('feature', 1)
                        ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')
                        ->orderByRaw("RAND()")->take(4)->get();


        return $all_feature;
    }

}

if (!function_exists('onsale')) {

    function onsale() {


        $all_sale = DB::table('items')->where('active', 1)->where('ratio', '>', 0)
                        ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')->
                        orderByRaw("RAND()")->take(4)->get();


        return $all_sale;
    }

}


if (!function_exists('toprates')) {

    function toprates() {
        $all_sale = array();

        $all_sale = DB::table('items')
                        ->join('reviews', 'items.id', '=', 'reviews.items_id')
                        ->where('active', 1)
                        ->select('title', 'items.id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price', DB::raw('avg(reviews.rate) AS average'))
                        ->groupBy('reviews.items_id')
                        ->orderBy('average', 'desc')
                        ->orderByRaw("RAND()")
                        ->take(4)->get();


        return $all_sale;
    }

}
if (!function_exists('get_sub_category')) {

    function get_sub_category($cat_id) {

        $lang = App::getLocale();
        $all_sub_category = DB::table('sub_categories')->where('active', 1)->where('categories_id', $cat_id)
                        ->select($lang . '_title  as title', 'id')
                        ->orderBy('id')->get();


        return $all_sub_category;
    }

}
if (!function_exists('get_brands')) {

    function get_brands($sub_cat_id) {

        $locale = App::getLocale();
        $all_brands = DB::table('brands')
                        ->join('items', 'brands.id', '=', 'items.brands_id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                        ->where('brands.active', '1')
                        ->where('sub_categories.id', $sub_cat_id)
                        ->select('brands.' . $locale . '_title as title', 'brands.id as id', DB::raw('count(*) as total'))
                        ->groupBy('brands.id')
                        ->distinct()->get();


        return $all_brands;
    }

}
if (!function_exists('get_coloers')) {

//select distinct `items_colors`.`color`, count(*) as total from `items_colors` inner join `items` on `items`.`id` = `items_colors`.`item_id` inner join `sub_categories` on `sub_categories`.`id` = `items`.`sub_categories_id` inner join `categories` on `categories`.`id` = `sub_categories`.`categories_id` where `items_colors`.`active` = 1 and `sub_categories`.`id` = 771807094 group by items_colors.color
    function get_coloers($sub_cat_id) {

        $locale = App::getLocale();
//        $all_colors = DB::table('items_colors')
//                        ->join('items', 'items.id', '=','items_colors.item_id')
//                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
//                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
//                        ->where('items_colors.active', '1')
//                        ->where('sub_categories.id', $sub_cat_id)
//                        ->select('items_colors.color', DB::raw('count(*) as total'))
//                           ->groupBy('items_colors.color')
//                        ->distinct()->get();
//
//        foreach ($all_colors as $row){
//            $color_name = DB::table('items_colors')->where('items_colors.active', '1')->where('items_colors.color', $row->color)
//
//                        ->select('items_colors.color_name')
//
//                        ->take(1)->get();
//
//           $row->color_name=$color_name[0]->color_name;
//        }
//
//        return $all_colors;

        $all_colors = DB::table('items_colors')
                        ->join('colors', 'colors.id', '=', 'items_colors.color_id')
                        ->join('items', 'items.id', '=', 'items_colors.item_id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                        ->where('colors.active', '1')
                        ->where('sub_categories.id', $sub_cat_id)
                        ->select('colors.' . $locale . '_name as title', 'colors.id as id', DB::raw('count(*) as total'))
                        ->groupBy('colors.id')
                        ->distinct()->get();


        return $all_colors;
    }

}

if (!function_exists('get_sub_category_filter')) {

    function get_sub_category_filter($cat_id) {

        $locale = App::getLocale();
        $all_brands = DB::table('sub_categories')
                        ->join('items', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                        ->where('sub_categories.active', '1')
                        ->where('categories.id', $cat_id)
                        ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id', DB::raw('count(*) as total'))
                        ->groupBy('sub_categories.id')
                        ->distinct()->get();


        return $all_brands;
    }

}
if (!function_exists('lang_url')) {

    function lang_url($path) {
        $locale = App::getLocale();
        return url($locale . '/' . $path);
    }

}



if (!function_exists('get_countries_cities')) {

    function get_countries_cities() {
        $locale = App::getLocale();

        $all_countries = DB::table('countries')
                        ->select($locale . '_name', 'id')
                        ->orderBy('id')->get();
        $first_country_id = 0;
//        $countries = array();
        $countries = array('' => trans('cpanel.select_country'));
        $locale_name = $locale . '_name';
        foreach ($all_countries as $country) {
            if ($first_country_id <= 0) {
                $first_country_id = $country->id;
            }
            $countries[$country->id] = $country->$locale_name;
        }



        $states = array();
        $all_states = DB::table('cities')
                ->select($locale . '_name', 'id')
                ->where('country_id', '=', $first_country_id)
                ->get();
        foreach ($all_states as $state) {
            $states[$state->id] = $state->$locale_name;
        }


        $data = [
            'countries' => $countries,
            'states' => $states,
        ];
        return $data;
    }

}

if (!function_exists('get_user_permissions')) {

    function get_user_permissions() {
        $array_user_permissions = array();
//        if (auth()->user()) {
//            $user_id = auth()->user()->id;
//            $user_permissions = DB::table('user_permissions')
//                    ->join('permissions', 'permissions.id', '=', 'user_permissions.permission_id')
//                    ->where('user_permissions.user_id', '=', $user_id)
//                    ->select('permissions.key', 'permissions.id')
//                    ->get();
//            if (!empty($user_permissions)) {
//                foreach ($user_permissions as $value) {
//                    $array_user_permissions[$value->id] = $value->key;
//                }
//            }
//        }
        return $array_user_permissions;
    }
    if (!function_exists('setActive')) {
    function setActive($path)
    {
        $locale = App::getLocale();
        $path= $locale.'/'.$path;
        return Request::is($path . '*') ? 'active' :  '';
    }
}
}
