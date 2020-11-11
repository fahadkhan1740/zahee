<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <?php
        $check =  DB::table('manage_role')
                   ->where('user_types_id',Auth()->user()->role_id)
                   ->first();
        ?>
        <li class="header"><?php echo e(trans('labels.navigation')); ?></li>
        <li class="treeview <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
          </a>
        </li>

      <?php

        if($check != null and $check->language_view == 1){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/languages/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/languages/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/languages/edit/*') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/languages/display')); ?>">
            <i class="fa fa-language" aria-hidden="true"></i> <span> <?php echo e(trans('labels.languages')); ?> </span>
          </a>
        </li>

      <?php } ?>
      <?php
        if($check != null and $check->view_media == 1){
      ?>
      <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?>">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span><?php echo e(trans('labels.media')); ?></span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('admin/media/add')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.media')); ?> </span>
              </a>
          </li>

          <li class="treeview <?php echo e(Request::is('admin/media/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addimages') ? 'active' : ''); ?> <?php echo e(Request::is('admin/uploadimage/*') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('admin/media/display')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Media Setings')); ?> </span>
              </a>
          </li>
        </ul>
      </li>

      <?php } ?>
      <?php

        if($check != null and $check->manufacturer_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/manufacturers/display')); ?>">
            <i class="fa fa-industry" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_manufacturer')); ?></span>
          </a>
        </li>
      <?php }
        if($check != null and $check->products_view == 1 or $check != null and $check->categories_view == 1 ){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editattributes/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo e(trans('labels.link_products')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">

            <?php if($check != null and $check->categories_view == 1): ?>
              <li class="<?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/categories/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_main_categories')); ?></a></li>
            <?php endif; ?>

            <?php if($check != null and $check->products_view == 1): ?>
              <li class="<?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_all_products')); ?></a></li>
            <?php endif; ?>
            <?php if($check != null and $check->products_view == 1): ?>
              <li class="<?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/*') ? 'active' : ''); ?>" ><a href="<?php echo e(URL::to('admin/products/attributes/display' )); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.products_attributes')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/inventory/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.inventory')); ?></a></li>
            <?php endif; ?>
          </ul>
        </li>
      <?php } ?>
      <?php

        if($check != null and $check->news_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/newscategories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/news/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/edit/*') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database" aria-hidden="true"></i>
<span>      <?php echo e(trans('labels.link_news')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          	<li class="<?php echo e(Request::is('admin/newscategories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/newscategories/display')); ?>"><i class="fa fa-circle-o"></i><?php echo e(trans('labels.link_news_categories')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/news/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/news/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_sub_news')); ?></a></li>
          </ul>
        </li>
      <?php } ?>
      <?php
        if($check != null and $check->customers_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/customers/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/customers/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/customers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers/address/display/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers/filter') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/customers/display')); ?>">
            <i class="fa fa-users" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_customers')); ?></span>
          </a>
        </li>
      <?php } ?>
      <?php
      $status_check = DB::table('reviews')->where('reviews_read',0)->first();
        if($check != null and $check->reviews_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/reviews/display')); ?>">
            <i class="fa fa-users" aria-hidden="true"></i> <span><?php echo e(trans('labels.reviews')); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($status_check): ?><span class="label label-success"><?php echo e(trans('labels.new')); ?></span><?php endif; ?>
          </a>
        </li>
      <?php } ?>
      <?php
          if($check != null and $check->tax_location_view == 1){
        ?>
          <li class="treeview <?php echo e(Request::is('admin/countries/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/eidt/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/edit/*') ? 'active' : ''); ?>">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span><?php echo e(trans('labels.link_tax_location')); ?></span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="<?php echo e(Request::is('admin/countries/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/edit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/countries/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_countries')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/zones/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/eidt/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/zones/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_zones')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/tax/taxclass/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/edit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/tax/taxclass/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_tax_class')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/tax/taxrates/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/edit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/tax/taxrates/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_tax_rates')); ?></a></li>
              </ul>
          </li>
        <?php } ?>
        <?php
          if($check != null and $check->coupons_view ==1){
        ?>
        <li class="treeview <?php echo e(Request::is('admin/coupons/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editcoupons/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/coupons/display')); ?>" ><i class="fa fa-tablet" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_coupons')); ?></span></a>
        </li>
      <?php } ?>
      <?php if($check != null and $check->notifications_view == 1): ?>
      <li class="treeview <?php echo e(Request::is('admin/devices/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/devices/viewdevices/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/devices/notifications') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/devices/display')); ?> ">
            <i class="fa fa-bell-o" aria-hidden="true"></i>
<span><?php echo e(trans('labels.link_notifications')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/devices/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/devices/viewdevices/*') ? 'active' : ''); ?>">
          		<a href="<?php echo e(URL::to('admin/devices/display')); ?>"><i class="fa fa-circle-o"></i><?php echo e(trans('labels.link_devices')); ?> </a>
            </li>
            <li class="<?php echo e(Request::is('admin/devices/notifications') ? 'active' : ''); ?> ">
            	<a href="<?php echo e(URL::to('admin/devices/notifications')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_send_notifications')); ?></a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
      <?php

        if($check != null and $check->orders_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/orders/display')); ?>" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span>
          </a>
        </li>
      <?php } ?>
      <?php

        if($check != null and $check->shipping_methods_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/shippingmethods/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shippingmethods/upsShipping/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shippingmethods/flateRate/display') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/shippingmethods/display')); ?>"><i class="fa fa-truck" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_shipping_methods')); ?></span>
          </a>
        </li>
          <?php } ?>
          <?php
            if($check != null and $check->payment_methods_view == 1){
          ?>
            <li class="treeview <?php echo e(Request::is('admin/paymentmethods/index') ? 'active' : ''); ?>">
              <a  href="<?php echo e(URL::to('admin/paymentmethods/index')); ?>"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>
              <?php echo e(trans('labels.link_payment_methods')); ?></span>
              </a>
            </li>
          <?php } ?>
          <?php
            if($check != null and $check->reports_view == 1){
          ?>
        <li class="treeview <?php echo e(Request::is('admin/statscustomers') ? 'active' : ''); ?> <?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?> <?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
  <span><?php echo e(trans('labels.link_reports')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/lowinstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_low_stock')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/outofstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_out_of_stock_products')); ?></a></li>
           <!-- <li class="<?php echo e(Request::is('admin/productsstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/stockin')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.stockin')); ?></a></li>-->
            <li class="<?php echo e(Request::is('admin/statscustomers') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/statscustomers')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_customer_orders_total')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/statsproductspurchased')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_total_purchased')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/statsproductsliked')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_liked')); ?></a></li>
          </ul>
        </li>
      <?php } ?>
      <?php

      $route =  DB::table('settings')
                 ->where('name','is_web_purchased')
                 ->where('value', 1)
                 ->first();
        if($check != null and $check->website_setting_view == 1 and $route != null){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/sliders') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addsliderimage') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editslide/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webpages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addwebpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editwebpage/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/websettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webthemes') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customstyle') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addconstantbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editconstantbanner/*') ? 'active' : ''); ?>" >
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.link_site_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">





































            <li class="<?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/constantbanners')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Banners')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/sliders') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addsliderimage') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editslide/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/sliders')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Sliders')); ?></a></li>



            <li class="<?php echo e(Request::is('admin/webpages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addwebpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editwebpage/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/webpages')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.content_pages')); ?></a></li>

            <!-- <li class="<?php echo e(Request::is('admin/webthemes') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/webthemes')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.website_themes')); ?></a></li> -->






          </ul>
        </li>
      <?php } ?>
      <?php
      $route =  DB::table('settings')
                 ->where('name','is_app_purchased')
                 ->where('value', 1)
                 ->first();

        if($check != null and $check->application_setting_view == 1 and $route != null){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/banners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editbanner/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/pages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editpage/*') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/appSettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/admobSettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/applabel') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addappkey') ? 'active' : ''); ?> <?php echo e(Request::is('admin/applicationapi') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.link_app_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/banners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editbanner/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/banners')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Banners')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/pages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editpage/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/pages')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.content_pages')); ?></a></li>



            <li class="android-hide <?php echo e(Request::is('admin/applabel') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addappkey') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/applabel')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.labels')); ?></a></li>





          </ul>
        </li>
      <?php } ?>
      <?php
        if($check != null and $check->general_setting_view == 1){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/facebooksettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/setting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/pushnotification') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/alertsetting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/filter') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.link_general_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/units')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_units')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/orderstatus')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_order_status')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/trends') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addTrends') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editTrends/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/trends')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Trend')); ?></a></li>
            <!-- <li class="<?php echo e(Request::is('admin/facebooksettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/facebooksettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_facebook')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/googlesettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_google')); ?></a></li> -->
            <li class="<?php echo e(Request::is('admin/pushnotification') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/pushnotification')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_push_notification')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/alertsetting') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/alertsetting')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.alertSetting')); ?></a></li>
            <!-- <li class="<?php echo e(Request::is('admin/setting') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/setting')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_setting')); ?></a></li> -->
            <li class="<?php echo e(Request::is('admin/currencies/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/currencies/filter') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/currencies/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.currency')); ?></a></li>
          </ul>
        </li>
      <?php } ?>
      <?php

        if($check != null and $check->manage_admins_view == 1){
      ?>

         <li class="treeview <?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.Manage Admins')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/admins')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_admins')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/manageroles')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_manage_roles')); ?></a></li>
          </ul>
        </li>
        <?php }
        if($check != null and $check->edit_management == 1){
        ?>

          <!--------create middlewares -------->
        <!-- <li class="treeview <?php echo e(Request::is('admin/managements/merge') ? 'active' : ''); ?> <?php echo e(Request::is('admin/managements/updater') ? 'active' : ''); ?> <?php echo e(Request::is('admin/managements/restore') ? 'active' : ''); ?> <?php echo e(Request::is('admin/managements/backup') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.Managements')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/managements/updater') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/managements/backup')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Back Up / Restore')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/managements/updater') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/managements/import')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Import Data')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/managements/merge') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/managements/merge')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_merge')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/managements/updater') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/managements/updater')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_updater')); ?></a></li>
          </ul>
        </li> -->
        <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH /Users/fkhan/Projects/freelance/zahee/resources/views/admin/common/sidebar.blade.php ENDPATH**/ ?>