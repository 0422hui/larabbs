<?php

    function route_class(){
        return str_replace('.','_',Route::currentRouteName());
    }
    function category_nav_active($category_id){
        return active_class((if_route('categories.show')&&if_route_param('category',$category_id)));
    }
