<div class="content-tab p-15 pb-50">
    <?php if(!empty($quizzes) and $quizzes->count()): ?>
        <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('web.default.course.learningPage.components.quiz_tab.quiz',['item' => $quiz, 'type' => 'quiz','class' => 'px-10 border border-gray200 rounded-sm mb-15'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/learningPage/components/quiz_tab/index.blade.php ENDPATH**/ ?>