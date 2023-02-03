<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
<?php $__env->stopPush(); ?>

<?php if($webinar->isWebinar()): ?>
    <section class="mt-50">
        <div class="">
            <h2 class="section-title after-line"><?php echo e(trans('public.sessions')); ?> (<?php echo e(trans('public.optional')); ?>)</h2>
        </div>

        <button type="button" class="js-add-chapter btn btn-primary btn-sm mt-15" data-webinar-id="<?php echo e($webinar->id); ?>" data-type="<?php echo e(\App\Models\WebinarChapter::$chapterSession); ?>"><?php echo e(trans('public.new_chapter')); ?></button>

        <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.chapter',
                    [
                        'chapters' => $webinar->chapters ,
                        'type' => \App\Models\WebinarChapter::$chapterSession,
                        'relationMethod' => 'sessions',
                        'includeFileName' => 'session',
                        'tableName' => 'sessions',
                        'variableName' => 'session',
                        'emptyState' => [
                            'file_name' => 'meet.png',
                            'title' => trans('public.sessions_no_result'),
                            'hint' => trans('public.sessions_no_result_hint'),
                        ]
                    ]
                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <div id="newSessionForm" class="d-none">
        <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.session',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>

<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line"><?php echo e(trans('public.files')); ?> (<?php echo e(trans('public.optional')); ?>)</h2>
    </div>
    <div class="mt-15">
        <p class="font-12 text-gray">- <?php echo e(trans('webinars.files_hint_1')); ?></p>
        <p class="font-12 text-gray">- <?php echo e(trans('webinars.files_hint_2')); ?></p>
    </div>
    <button type="button" class="js-add-chapter btn btn-primary btn-sm mt-15" data-webinar-id="<?php echo e($webinar->id); ?>" data-type="<?php echo e(\App\Models\WebinarChapter::$chapterFile); ?>"><?php echo e(trans('public.new_chapter')); ?></button>

    <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.chapter',
                [
                    'chapters' => $webinar->chapters ,
                    'type' => \App\Models\WebinarChapter::$chapterFile,
                    'relationMethod' => 'files',
                    'includeFileName' => 'file',
                    'tableName' => 'files',
                    'variableName' => 'file',
                    'emptyState' => [
                        'file_name' => 'files.png',
                        'title' => trans('public.files_no_result'),
                        'hint' => trans('public.files_no_result_hint'),
                    ]
                ]
            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<div id="newFileForm" class="d-none">
    <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.file',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div id="newInteractiveFileForm" class="d-none">
    <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.new_interactive_file',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php if($webinar->isTextCourse()): ?>
    <section class="mt-50">
        <div class="">
            <h2 class="section-title after-line"><?php echo e(trans('public.test_lesson')); ?> (<?php echo e(trans('public.optional')); ?>)</h2>
        </div>

        <button type="button" class="js-add-chapter btn btn-primary btn-sm mt-15" data-webinar-id="<?php echo e($webinar->id); ?>" data-type="<?php echo e(\App\Models\WebinarChapter::$chapterTextLesson); ?>"><?php echo e(trans('public.new_chapter')); ?></button>

        <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.chapter',
                    [
                        'chapters' => $webinar->chapters ,
                        'type' => \App\Models\WebinarChapter::$chapterTextLesson,
                        'relationMethod' => 'textLessons',
                        'includeFileName' => 'text-lesson',
                        'tableName' => 'text_lessons',
                        'variableName' => 'textLesson',
                        'emptyState' => [
                            'file_name' => 'files.png',
                            'title' => trans('public.text_lesson_no_result'),
                            'hint' => trans('public.text_lesson_no_result_hint'),
                        ]
                    ]
                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <div id="newTextLessonForm" class="d-none">
        <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.text-lesson',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>

<?php echo $__env->make('web.default.panel.webinar.create_includes.chapter_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>

    <script>
        var requestFailedLang = '<?php echo e(trans('public.request_failed')); ?>';
        var thisLiveHasEndedLang = '<?php echo e(trans('update.this_live_has_been_ended')); ?>';
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/panel/webinar/create_includes/step_4.blade.php ENDPATH**/ ?>