<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item"><?php echo e($pageTitle); ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">



                            <div class="empty-state mx-auto d-block"  data-width="900" >
                                <img class="img-fluid col-md-6" src="/assets/default/img/lic.svg" alt="image">
                                <h3 class="mt-3">Please activate your license!</h3>
                                <h5 class="lead">
                                You can activate your license by <strong><a href="mailto:rocketsoftsolutions@gmail.com">contacting support</a></strong> or checking <strong><a href="https://crm.rocket-soft.org">CRM</a></strong>  </h5>                              </p>
                              </div>


                            
                        </div>

                      

                    </div>
                </div>
            </div>
        </div>
    </section>





<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>