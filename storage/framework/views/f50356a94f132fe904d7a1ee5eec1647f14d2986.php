<?php
    if (!empty($itemValue) and !is_array($itemValue)) {
        $itemValue = json_decode($itemValue, true);
    }
?>

<div class="tab-pane mt-3 fade" id="features" role="tabpanel" aria-labelledby="features-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="/admin/settings/features" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="page" value="general">
                <input type="hidden" name="features" value="features">

                <div class="mb-5">
                    <h5><?php echo e(trans('update.agora')); ?> <?php echo e(trans('admin/main.settings')); ?></h5>

                    <div class="form-group">
                        <label><?php echo e(trans('update.agora')); ?> <?php echo e(trans('update.resolution')); ?></label>

                        <select class="form-control" name="value[agora_resolution]">
                            <option value=""><?php echo e(trans('admin/main.select')); ?> <?php echo e(trans('update.resolution')); ?></option>

                            <?php $__currentLoopData = getAgoraResolutions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resolution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($resolution); ?>" <?php echo e(((!empty($itemValue) and !empty($itemValue['agora_resolution']) and $itemValue['agora_resolution'] == $resolution) or old('value[agora_resolution]') == $resolution) ? 'selected' : ''); ?>><?php echo e(str_replace('_',' x ', $resolution)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(trans('update.max_bitrate')); ?></label>
                        <input type="text" name="value[agora_max_bitrate]" value="<?php echo e((!empty($itemValue) and !empty($itemValue['agora_max_bitrate'])) ? $itemValue['agora_max_bitrate'] : old('agora_max_bitrate')); ?>" class="form-control "/>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(trans('update.min_bitrate')); ?></label>
                        <input type="text" name="value[agora_min_bitrate]" value="<?php echo e((!empty($itemValue) and !empty($itemValue['agora_min_bitrate'])) ? $itemValue['agora_min_bitrate'] : old('agora_min_bitrate')); ?>" class="form-control "/>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(trans('update.frame_rate')); ?></label>
                        <input type="text" name="value[agora_frame_rate]" value="<?php echo e((!empty($itemValue) and !empty($itemValue['agora_frame_rate'])) ? $itemValue['agora_frame_rate'] : old('agora_frame_rate')); ?>" class="form-control "/>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_live_streaming]" value="0">
                            <input type="checkbox" name="value[agora_live_streaming]" id="agoraStreamSwitch" value="1" <?php echo e((!empty($itemValue) and !empty($itemValue['agora_live_streaming']) and $itemValue['agora_live_streaming']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraStreamSwitch"><?php echo e(trans('update.agora_live_streaming')); ?></label>
                        </label>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_chat]" value="0">
                            <input type="checkbox" name="value[agora_chat]" id="agoraChatSwitch" value="1" <?php echo e((!empty($itemValue) and !empty($itemValue['agora_chat']) and $itemValue['agora_chat']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraChatSwitch"><?php echo e(trans('update.agora_chat')); ?></label>
                        </label>
                    </div>


                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_in_free_courses]" value="0">
                            <input type="checkbox" name="value[agora_in_free_courses]" id="agoraInFreeCoursesSwitch" value="1" <?php echo e((!empty($itemValue) and !empty($itemValue['agora_in_free_courses']) and $itemValue['agora_in_free_courses']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraInFreeCoursesSwitch"><?php echo e(trans('update.agora_in_free_courses')); ?></label>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5><?php echo e(trans('update.new_interactive_file')); ?> <?php echo e(trans('admin/main.settings')); ?></h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[new_interactive_file]" value="0">
                            <input type="checkbox" name="value[new_interactive_file]" id="newInteractiveFileSwitch" value="1" <?php echo e((!empty($itemValue) and !empty($itemValue['new_interactive_file']) and $itemValue['new_interactive_file']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="newInteractiveFileSwitch"><?php echo e(trans('update.interactive_feature_toggle')); ?></label>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5><?php echo e(trans('update.timezone')); ?> <?php echo e(trans('admin/main.settings')); ?></h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[timezone_in_register]" value="0">
                            <input type="checkbox" name="value[timezone_in_register]" id="timezoneInRegisterSwitch" value="1" <?php echo e((!empty($itemValue) and !empty($itemValue['timezone_in_register']) and $itemValue['timezone_in_register']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="timezoneInRegisterSwitch"><?php echo e(trans('update.timezone_in_register')); ?></label>
                        </label>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[timezone_in_create_webinar]" value="0">
                            <input type="checkbox" name="value[timezone_in_create_webinar]" id="timezoneInCreateWebinarSwitch" value="1" <?php echo e((!empty($itemValue) and !empty($itemValue['timezone_in_create_webinar']) and $itemValue['timezone_in_create_webinar']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="timezoneInCreateWebinarSwitch"><?php echo e(trans('update.timezone_in_create_webinar')); ?></label>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo e(trans('admin/main.save_change')); ?></button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/admin/settings/general/features.blade.php ENDPATH**/ ?>