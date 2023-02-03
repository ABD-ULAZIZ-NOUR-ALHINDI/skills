

<?php if((!empty($sessionChapters) and count($sessionChapters)) or (!empty($sessionsWithoutChapter) and count($sessionsWithoutChapter))): ?>
    <section class="mt-20">
        <?php if(!empty($sessionsWithoutChapter) and count($sessionsWithoutChapter)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.sessions' , ['sessions' => $sessionsWithoutChapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($sessionChapters) and count($sessionChapters)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.chapter' , [
                'chapters' => $sessionChapters,
                'fileName' => 'sessions',
                'fileVariable' => 'sessions',
                'relationName' => 'sessions',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php if((!empty($filesWithoutChapter) and count($filesWithoutChapter)) or (!empty($fileChapters) and count($fileChapters))): ?>
    <section class="">

        <?php if(!empty($filesWithoutChapter) and count($filesWithoutChapter)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.files' , ['files' => $filesWithoutChapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($fileChapters) and count($fileChapters)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.chapter' , [
                'chapters' => $fileChapters,
                'fileName' => 'files',
                'fileVariable' => 'files',
                'relationName' => 'files',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

    <?php echo $__env->make('web.default.course.tabs.play_modal.play_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>


<?php if((!empty($textLessonsWithoutChapter) and count($textLessonsWithoutChapter)) or (!empty($textLessonChapters) and count($textLessonChapters))): ?>
    <section class="">
        <?php if(!empty($textLessonsWithoutChapter) and count($textLessonsWithoutChapter)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.text_lessons' , ['textLessons' => $textLessonsWithoutChapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(!empty($textLessonChapters) and count($textLessonChapters)): ?>
            <?php echo $__env->make('web.default.course.tabs.contents.chapter' , [
                'chapters' => $textLessonChapters,
                'fileName' => 'text_lessons',
                'fileVariable' => 'textLessons',
                'relationName' => 'textLessons',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>
<?php endif; ?>


<?php if(!empty($quizzes) and $quizzes->count() > 0): ?>
    <section class="">
        <?php echo $__env->make('web.default.course.tabs.contents.quiz' , ['quizzes' => $quizzes], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php endif; ?>


<?php if(!empty($course->quizzes) and count($course->quizzes)): ?>
    <section class="">
        <?php echo $__env->make('web.default.course.tabs.contents.certificate' , ['quizzes' => $course->quizzes], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php endif; ?>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/tabs/content.blade.php ENDPATH**/ ?>