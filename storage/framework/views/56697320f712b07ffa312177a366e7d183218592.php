<div class="row mt-10">
    <div class="col-12">
        <div class="accordion-content-wrapper mt-15" id="chapterAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="tablist" aria-multiselectable="true">
            <?php if(!empty($chapters) and count($chapters)): ?>
                <ul class="draggable-content-lists draggable-lists-chapter-<?php echo e($type); ?>" data-drag-class="draggable-lists-chapter-<?php echo e($type); ?>" data-order-table="webinar_chapters">
                    <?php $__currentLoopData = $chapters->where('type', $type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li data-id="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" data-chapter-order="<?php echo e($chapter->order); ?>" class="accordion-row bg-white rounded-sm panel-shadow mt-20 py-15 py-lg-30 px-10 px-lg-20">
                            <div class="d-flex align-items-center justify-content-between " role="tab" id="chapter_<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>">
                                <div class="d-flex align-items-center" href="#collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" aria-controls="collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" data-parent="#chapterAccordion" role="button" data-toggle="collapse" aria-expanded="true">
                                    <span class="chapter-icon mr-10">
                                        <i data-feather="grid" class=""></i>
                                    </span>
                                    <div class="">
                                        <span class="font-weight-bold text-dark-blue d-block"><?php echo e(!empty($chapter) ? $chapter->title : trans('public.add_new_chapter')); ?></span>
                                        <span class="font-12 text-gray d-block">
                                            <?php echo e(!empty($chapter->$relationMethod) ? count($chapter->$relationMethod) : 0); ?> <?php echo e(trans('public.topic')); ?>


                                            <?php if($chapter->type != \App\Models\WebinarChapter::$chapterFile): ?>
                                                | <?php echo e(convertMinutesToHourAndMinute($chapter->getDuration())); ?> <?php echo e(trans('public.hr')); ?>

                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">

                                    <?php if($chapter->status != \App\Models\WebinarChapter::$chapterActive): ?>
                                        <span class="disabled-content-badge mr-10"><?php echo e(trans('public.disabled')); ?></span>
                                    <?php endif; ?>

                                    <?php if($chapter->type == \App\Models\WebinarChapter::$chapterFile and getFeaturesSettings('new_interactive_file')): ?>

                                   <button type="button" class="add-course-content-btn mr-10" data-webinar-id="<?php echo e($webinar->id); ?>" data-type="new_interactive_file" data-chapter="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo e(trans('update.new_interactive_file')); ?>">
                                        <i data-feather="cast" class=""></i>
                                    </button>

                                    <?php endif; ?>

                                    <button type="button" class="add-course-content-btn mr-10" data-webinar-id="<?php echo e($webinar->id); ?>" data-type="<?php echo e($type); ?>" data-chapter="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" data-toggle="tooltip" data-placement="top" data-html="true" title="<?php echo e(trans('public.add_'.$type)); ?>">
                                        <i data-feather="plus" class=""></i>
                                    </button>

                                    <button type="button" class="js-add-chapter btn-transparent text-gray" data-webinar-id="<?php echo e($webinar->id); ?>" data-type="<?php echo e($type); ?>" data-chapter="<?php echo e($chapter->id); ?>" data-locale="<?php echo e(mb_strtoupper($chapter->locale)); ?>">
                                        <i data-feather="edit-3" class="mr-10 cursor-pointer" height="20"></i>
                                    </button>

                                    <a href="/panel/chapters/<?php echo e($chapter->id); ?>/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                                        <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                                    </a>

                                    <i data-feather="move" class="move-icon mr-10 cursor-pointer text-gray" height="20"></i>

                                    <i class="collapse-chevron-icon feather-chevron-up text-gray" data-feather="chevron-down" height="20" href="#collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" aria-controls="collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" data-parent="#chapterAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
                                </div>
                            </div>

                            <div id="collapseChapter<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" aria-labelledby="chapter_<?php echo e(!empty($chapter) ? $chapter->id :'record'); ?>" class=" collapse show" role="tabpanel">
                                <div class="panel-collapse text-gray">

                                    <div class="accordion-content-wrapper mt-15" id="chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="tablist" aria-multiselectable="true">
                                        <?php if(!empty($chapter->$relationMethod) and count($chapter->$relationMethod)): ?>
                                            <ul class="draggable-content-lists draggable-lists-<?php echo e($type); ?>-chapter-<?php echo e($chapter->id); ?>" data-drag-class="draggable-lists-<?php echo e($type); ?>-chapter-<?php echo e($chapter->id); ?>" data-order-table="<?php echo e($tableName); ?>">
                                                <?php $__currentLoopData = $chapter->$relationMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.'.$includeFileName ,[$variableName => $row , 'chapter' => $chapter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                                                'file_name' => $emptyState['file_name'],
                                                'title' => $emptyState['title'],
                                                'hint' => $emptyState['hint'],
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                    'file_name' => $emptyState['file_name'],
                    'title' => $emptyState['title'],
                    'hint' => $emptyState['hint'],
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>

    </div>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/panel/webinar/create_includes/accordions/chapter.blade.php ENDPATH**/ ?>