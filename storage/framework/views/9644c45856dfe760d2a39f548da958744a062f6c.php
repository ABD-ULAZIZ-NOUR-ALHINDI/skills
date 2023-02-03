<?php
    $percent = $course->getProgress(true);
?>

<div class="learning-page-navbar d-flex align-items-center justify-content-between px-15 px-lg-35 py-10">
    <div class="d-flex align-items-lg-center flex-column flex-lg-row flex-grow-1">

        <div class="learning-page-logo-card d-flex align-items-center justify-content-between justify-content-lg-start">
            <a class="navbar-brand mr-0" href="/">
                <?php if(!empty($generalSettings['logo'])): ?>
                    <img src="<?php echo e($generalSettings['logo']); ?>" class="img-cover" alt="site logo">
                <?php endif; ?>
            </a>

            <div class="d-flex align-items-center d-lg-none ml-20">
                <a href="<?php echo e($course->getUrl()); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200 d-none d-md-block"><?php echo e(trans('update.course_page')); ?></a>

                <a href="/panel/webinars/purchases" class="btn learning-page-navbar-btn btn-sm border-gray200 ml-0 ml-md-10"><?php echo e(trans('update.my_courses')); ?></a>
            </div>
        </div>

        <div class="learning-page-progress-card d-flex flex-column">
            <a href="<?php echo e($course->getUrl()); ?>" class="learning-page-navbar-title">
                <span class="font-weight-bold"><?php echo e($course->title); ?></span>
            </a>

            <div class="d-flex align-items-center">
                <div class="progress course-progress d-flex align-items-center flex-grow-1 bg-white border border-gray200 rounded-sm shadow-none mt-5">
                    <span class="progress-bar rounded-sm bg-warning" style="width: <?php echo e($percent); ?>%"></span>
                </div>

                <span class="ml-10 font-weight-500 font-14 text-gray"><?php echo e($percent); ?>% <?php echo e(trans('update.learnt')); ?></span>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center">

        <div class="d-none align-items-center d-lg-flex">
            <a href="<?php echo e($course->getUrl()); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200"><?php echo e(trans('update.course_page')); ?></a>

            <a href="/panel/webinars/purchases" class="btn learning-page-navbar-btn btn-sm border-gray200 ml-10"><?php echo e(trans('update.my_courses')); ?></a>
        </div>

        <button id="collapseBtn" type="button" class="btn-transparent ml-20">
            <i data-feather="menu" width="20" height="20" class=""></i>
        </button>
    </div>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/learningPage/components/navbar.blade.php ENDPATH**/ ?>