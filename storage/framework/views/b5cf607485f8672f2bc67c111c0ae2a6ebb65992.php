<div class="row">
    <div class="col-12">
        <div class="accordion-content-wrapper" id="chaptersAccordion<?php echo e($fileName); ?>" role="tablist" aria-multiselectable="true">
            <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="accordion-row rounded-sm border mt-20 p-15">
                    <div class="d-flex align-items-center justify-content-between" role="tab" id="chapter_<?php echo e($chapter->id); ?>">
                        <div class="js-chapter-collapse-toggle d-flex align-items-center" href="#collapseChapter<?php echo e($chapter->id); ?>" aria-controls="collapseChapter<?php echo e($chapter->id); ?>" data-parent="#chaptersAccordion<?php echo e($fileName); ?>" role="button" data-toggle="collapse" aria-expanded="true">
                            <span class="chapter-icon mr-15">
                                <i data-feather="grid" class=""></i>
                            </span>

                            <span class="font-weight-bold text-secondary font-14"><?php echo e($chapter->title); ?></span>
                        </div>

                        <div class="d-flex align-items-center">
                            <span class="mr-15 font-14 text-gray">
                                <?php echo e($chapter->getTopicsCount()); ?> <?php echo e(trans('public.parts')); ?>


                                <?php if($fileName != 'files'): ?>
                                    - <?php echo e(convertMinutesToHourAndMinute($chapter->getDuration())); ?> <?php echo e(trans('public.hr')); ?>

                                <?php endif; ?>
                            </span>

                            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" aria-controls="collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" data-parent="#chaptersAccordion<?php echo e($fileName); ?>" role="button" data-toggle="collapse" aria-expanded="true"></i>
                        </div>
                    </div>

                    <div id="collapseChapter<?php echo e($chapter->id); ?>" aria-labelledby="chapter_<?php echo e($chapter->id); ?>" class=" collapse" role="tabpanel">
                        <div class="panel-collapse">
                            <?php if(!empty($chapter->{$relationName})): ?>
                                <?php echo $__env->make('web.default.course.tabs.contents.'.$fileName , [$fileVariable => $chapter->{$relationName}], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

                            <?php if(!empty($chapter->quizzes) and count($chapter->quizzes)): ?>
                                <?php echo $__env->make('web.default.course.tabs.contents.quiz' , ['quizzes' => $chapter->quizzes, 'isChapterQuiz' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/course/tabs/contents/chapter.blade.php ENDPATH**/ ?>