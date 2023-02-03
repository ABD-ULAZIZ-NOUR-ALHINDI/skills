<?php if(!empty($chapters) and count($chapters)): ?>
    <div class="accordion-content-wrapper mt-15" id="chapterAccordion_<?php echo e($type); ?>" role="tablist" aria-multiselectable="true">
        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="accordion-row bg-white rounded-sm border border-gray200 mb-2">
                <div class="d-flex align-items-center justify-content-between p-10" role="tab" id="chapter_<?php echo e($chapter->id); ?>">
                    <div class="d-flex align-items-center" href="#collapseChapter<?php echo e($chapter->id); ?>" aria-controls="collapseChapter<?php echo e($chapter->id); ?>" data-parent="#chapterAccordion_<?php echo e($type); ?>" role="button" data-toggle="collapse" aria-expanded="true">
                        <span class="chapter-icon mr-10">
                            <i data-feather="grid" class="" width="20" height="20"></i>
                        </span>

                        <div class="">
                            <span class="font-weight-bold font-14 text-dark-blue d-block"><?php echo e($chapter->title); ?></span>

                            <span class="font-12 text-gray d-block">
                                <?php
                                    $topicCount = 0;

                                    if (!empty($chapter->$relationMethod)) {
                                        $topicCount = count($chapter->$relationMethod);
                                    }

                                    if (!empty($chapter->quizzes)) {
                                        $topicCount += count($chapter->quizzes);
                                    }
                                ?>

                                <?php echo e($topicCount); ?> <?php echo e(trans('public.topic')); ?>

                            </span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <i class="collapse-chevron-icon feather-chevron-down text-gray" data-feather="chevron-down" height="20" href="#collapseChapter<?php echo e($chapter->id); ?>" aria-controls="collapseChapter<?php echo e($chapter->id); ?>" data-parent="#chapterAccordion_<?php echo e($type); ?>" role="button" data-toggle="collapse" aria-expanded="true"></i>
                    </div>
                </div>

                <div id="collapseChapter<?php echo e($chapter->id); ?>" aria-labelledby="chapter_<?php echo e($chapter->id); ?>" class="collapse" role="tabpanel">
                    <div class="panel-collapse text-gray">

                        <?php if(!empty($chapter->$relationMethod) and count($chapter->$relationMethod)): ?>
                            <?php $__currentLoopData = $chapter->$relationMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('web.default.course.learningPage.components.content_tab.content',['item' => $session, 'type' => $type], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if(!empty($chapter->quizzes) and count($chapter->quizzes)): ?>
                            <?php $__currentLoopData = $chapter->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('web.default.course.learningPage.components.quiz_tab.quiz',['item' => $quiz, 'type' => 'quiz'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/learningPage/components/content_tab/chapter.blade.php ENDPATH**/ ?>