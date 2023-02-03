<div class="content-tab p-15 pb-50">
    <?php if(!empty($course->quizzes) and count($course->quizzes)): ?>
        <?php $__currentLoopData = $course->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courseQuiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($courseQuiz->certificate): ?>
                <div class="certificate-item cursor-pointer p-10 border border-gray200 rounded-sm mb-15" data-result="<?php echo e($courseQuiz->result ? $courseQuiz->result->id : ''); ?>">
                    <div class="d-flex align-items-center">
                        <span class="chapter-icon bg-gray300 mr-10">
                            <i data-feather="award" class="text-gray" width="16" height="16"></i>
                        </span>

                        <div class="flex-grow-1">
                            <span class="font-weight-500 font-14 text-dark-blue d-block"><?php echo e($courseQuiz->title); ?></span>

                            <div class="d-flex align-items-center">
                                <span class="font-12 text-gray"><?php echo e($courseQuiz->pass_mark); ?>/<?php echo e($courseQuiz->quizQuestions->sum('grade')); ?></span>

                                <?php if(!empty($courseQuiz->result)): ?>
                                    <span class="font-12 text-gray"><?php echo e(dateTimeFormat($courseQuiz->result->created_at, 'j M Y H:i')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/learningPage/components/certificate_tab/index.blade.php ENDPATH**/ ?>