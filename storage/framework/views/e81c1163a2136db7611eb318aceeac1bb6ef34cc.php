<div class="content-tab p-15 pb-50">

    <?php if(!empty($course->sessions) and count($course->sessions)): ?>

        <?php if(!empty($sessionsWithoutChapter) and count($sessionsWithoutChapter)): ?>
            <?php $__currentLoopData = $sessionsWithoutChapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.course.learningPage.components.content_tab.content',['item' => $session, 'type' => \App\Models\WebinarChapter::$chapterSession], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($sessionChapters) and count($sessionChapters)): ?>
            <?php echo $__env->make('web.default.course.learningPage.components.content_tab.chapter',[
                'chapters' => $sessionChapters,
                'type' => \App\Models\WebinarChapter::$chapterSession,
                'relationMethod' => 'sessions',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if(!empty($course->files) and count($course->files)): ?>
        <?php if(!empty($filesWithoutChapter) and count($filesWithoutChapter)): ?>
            <?php $__currentLoopData = $filesWithoutChapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.course.learningPage.components.content_tab.content',['item' => $file, 'type' => \App\Models\WebinarChapter::$chapterFile], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($fileChapters) and count($fileChapters)): ?>
            <?php echo $__env->make('web.default.course.learningPage.components.content_tab.chapter',[
                'chapters' => $fileChapters,
                'type' => \App\Models\WebinarChapter::$chapterFile,
                'relationMethod' => 'files',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if(!empty($course->textLessons) and count($course->textLessons)): ?>
        <?php if(!empty($textLessonsWithoutChapter) and count($textLessonsWithoutChapter)): ?>
            <?php $__currentLoopData = $textLessonsWithoutChapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $textLesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.course.learningPage.components.content_tab.content',['item' => $textLesson, 'type' => \App\Models\WebinarChapter::$chapterTextLesson], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($textLessonChapters) and count($textLessonChapters)): ?>
            <?php echo $__env->make('web.default.course.learningPage.components.content_tab.chapter',[
                'chapters' => $textLessonChapters,
                'type' => \App\Models\WebinarChapter::$chapterTextLesson,
                'relationMethod' => 'textLessons',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/learningPage/components/content_tab/index.blade.php ENDPATH**/ ?>