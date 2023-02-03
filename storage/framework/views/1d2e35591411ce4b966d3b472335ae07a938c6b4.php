<!-- Modal -->
<div class="d-none" id="webinarChapterModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25"><?php echo e(trans('public.add_new_chapter')); ?></h3>
    <form action="/admin/chapters/store" method="post">
        <input type="hidden" name="webinar_id" value="<?php echo e(!empty($webinar) ? $webinar->id :''); ?>">

        <?php if(!empty(getGeneralSettings('content_translate'))): ?>
            <div class="form-group">
                <label class="input-label"><?php echo e(trans('auth.language')); ?></label>
                <select name="locale" class="form-control ">
                    <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lang); ?>" <?php if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)): ?> selected <?php endif; ?>><?php echo e($language); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['locale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                    <?php echo e($message); ?>

                </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php else: ?>
            <input type="hidden" name="locale" value="<?php echo e(getDefaultLocale()); ?>">
        <?php endif; ?>


        <div class="form-group">
            <label class="input-label"><?php echo e(trans('public.title')); ?></label>
            <input type="text" name="title" class="form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label"><?php echo e(trans('admin/main.type')); ?></label>
            <select class="custom-select" name="type" required>
                <?php $__currentLoopData = \App\Models\WebinarChapter::$chapterTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapterType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($chapterType); ?>"><?php echo e(trans('admin/main.'.$chapterType)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="js-chapter-status form-group mt-3">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="chapterStatusSwitch_record"><?php echo e(trans('admin/main.active')); ?></label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="chapterStatusSwitch_record">
                    <label class="custom-control-label" for="chapterStatusSwitch_record"></label>
                </div>
            </div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveChapter" class="btn btn-primary"><?php echo e(trans('public.save')); ?></button>
            <button type="button" class="btn btn-danger ml-2 close-swl"><?php echo e(trans('public.close')); ?></button>
        </div>
    </form>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/admin/webinars/modals/chapter.blade.php ENDPATH**/ ?>