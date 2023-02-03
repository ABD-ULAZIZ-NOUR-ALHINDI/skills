<div class="tab-item p-10 cursor-pointer <?php echo e($class ?? ''); ?>" data-type="<?php echo e($type); ?>" data-id="<?php echo e($item->id); ?>">
    <div class="d-flex align-items-center">
        <span class="chapter-icon bg-gray300 mr-10">
            <i data-feather="award" class="text-gray" width="16" height="16"></i>
        </span>

        <div class="flex-grow-1">
            <span class="font-weight-500 font-14 text-dark-blue d-block"><?php echo e($item->title); ?></span>

            <div class="d-flex align-items-center justify-content-between">
                <span class="font-12 text-gray d-block">
                    <?php echo e($item->time .' '. trans('public.min')); ?>

                    <?php echo e(($item->quizQuestions ? ' | ' . $item->quizQuestions->count() .' '. trans('public.questions') : '')); ?>

                </span>

                <?php if(!empty($quiz->result_status)): ?>
                    <?php if($quiz->result_status == 'passed'): ?>
                        <span class="font-12 text-primary"><?php echo e(trans('quiz.passed')); ?></span>
                    <?php elseif($quiz->result_status == 'failed'): ?>
                        <span class="font-12 text-danger"><?php echo e(trans('quiz.failed')); ?></span>
                    <?php elseif($quiz->result_status == 'waiting'): ?>
                        <span class="font-12 text-warning"><?php echo e(trans('quiz.waiting')); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/learningPage/components/quiz_tab/quiz.blade.php ENDPATH**/ ?>