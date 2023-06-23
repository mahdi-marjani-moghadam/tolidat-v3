        <!-- build:js scripts/vendor-main.js -->
        <!-- bower:js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery-ui.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/bootstrap.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-usefull.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/wow.min.js"></script>
        <!-- endbuild -->

        <!-- summernote text editor -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/summernote.min.js"></script>
        <!-- end summernote text editor -->

        <!-- build:js scripts/vendor-form.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.validate.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/additional-methods.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.autogrowtextarea.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.mask.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/bootstrap-tagsinput.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.multi-select.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/select2.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.selectBoxIt.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-table.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/dataTables.tableTools.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/datatables.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.tablesorter.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.tablesorter.widgets.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.tablesorter.pager.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/dataTables.jqueryui.min.js"></script>
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/cropper.js"></script>
        <!-- endbuild -->

        <!-- build:js scripts/vendor-util.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/holder.js"></script>
        <!-- endbower -->
        <!-- endbuild -->


        <!-- required stilearn template js -->
        <!-- build:js scripts/main.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/fileinput.js"></script>        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/panel-setup.js"></script>
        <!-- endbuild -->

        <!-- This scripts will be reload after pjax or if popstate event is active (use with class .re-execute) -->
        <!-- build:js scripts/initializer.js -->
        <script class="re-execute" src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/bootstrap-setup.js"></script>
        <script class="re-execute" src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jqueryui-setup.js"></script>
        <script class="re-execute" src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/dependencies-setup.js"></script>
        <script class="re-execute" src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/demo-setup.js"></script>
        <!-- endbuild -->

        <!-- persianDatePicker.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>

        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/izitoast/dist/js/iziToast.min.js"></script>

        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
        <!-- custom.js -->
        <script src="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/campains.js"></script>

        <script>
            function backTo() {
                if (document.referrer !== "") {
                    window.history.back();
                }
                else {
                    baseURL = $('#BASE_URL').data('url');
                        window.location.href = baseURL;
                }
            }
        </script>