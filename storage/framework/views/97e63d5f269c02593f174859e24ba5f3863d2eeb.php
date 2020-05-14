
<header>
    <div class="headerTop">
        <div class="container">
            <div class="headerTopLeft"></div>
            <div class="headerTopRight">
                            <div class="navbar-lang">
                                <!--  CHANGE LANGUAGE CODE SECTION -->
                                <?php if(count($languages) > 1): ?>
                                    <div class="dropdown">
                                        <a href= "#" class="dropdown-toggle"  data-toggle="dropdown" >

                                            <?php echo e(session('language_name')); ?>

                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li  <?php if(session('locale')==$language->code): ?> style="background:lightgrey;" <?php endif; ?>>
                                                    <button  onclick="myFunction1(<?php echo e($language->languages_id); ?>)" style="background:none;">
                                                        <span><?php echo e($language->name); ?></span>
                                                    </button>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <?php echo $__env->make('web.common.scripts.changeLanguage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>
            </div>
        </div>
    </div>
    <div class="headerBottom">
        <div class="container">
            <div class="headerBottomLeft">
                <!-- <a href="index.html" class="site-logo"><img src="images/logo.png" alt="logo.png" /></a> -->
            </div>
            <div class="headerBottomRight">
                <div class="search-wrap">
                    <form>
                        <div class="input-field">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" placeholder="Search" />
                        </div>
                    </form>
                </div>
                <div class="account-wrap">
                    <ul>
                    <?php if(auth()->guard('customer')->check()): ?>
                        <li>
                                <a href="<?php echo e(url('/profile')); ?>">
                                        <span><?php if(auth()->guard('customer')->check()){ ?><?php echo app('translator')->get('website.Welcome'); ?>&nbsp;! <?php echo e(auth()->guard('customer')->user()->first_name); ?> <?php }?>
                                        </span>
                                </a>
                        </li>
                        <?php else: ?>
                        <li><a href="<?php echo e(url('/login')); ?>"><i class="fa fa-user" aria-hidden="true"></i><?php echo app('translator')->get('website.Login/Register'); ?></a></li>
                  <?php endif; ?>
                  </li>
                        <li class="cart-header dropdown head-cart-content">
                            <?php echo $__env->make('web.headers.cartButtons.cartButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md">
        <div class="container">
            <div class="logo-wrap">
                <a href="<?php echo e(URL::to('/')); ?>" class="site-logo"><img src="<?php echo e(asset('web/images/cus/logo.png')); ?>" alt="logo1.png" /></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="<?php echo e(Request::is('/all-category') ? 'nav-item active' : 'nav-item'); ?>">
                        <a class="nav-link" href="<?php echo e(URL::to('/all-category')); ?>"><?php echo app('translator')->get('website.All Categories'); ?></a>
                    </li>
                    <?php $__currentLoopData = $result['commonContent']['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/shop?category='.$category->slug)); ?>"><?php echo e($category->name); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php /**PATH /var/www/html/resources/views/web/headers/headerOne.blade.php ENDPATH**/ ?>