<div class="right_col" role="main">

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Upload Image </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong>Upload Files</strong> <small></small></div>
                            <div class="panel-body">
                                <!-- Standar Form -->
                                <h4>Select files from your computer</h4>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <input type="file" name="files[]" id="js-upload-files" multiple>
                                        </div>
                                        <input type="submit" class="btn btn-sm btn-primary" value="Upload files" name="upload">
                                    </div>
                                </form>

                                <!-- Drop Zone -->
                                <h4>Or drag and drop files below</h4>
                                <div class="upload-drop-zone" id="drop-zone">
                                    Just drag and drop files here
                                </div>

                                <!-- Progress Bar -->
                                <!-- Upload Finished -->
                                <div class="js-upload-finished">
                                    <h3>Processed files</h3>
                                    <div class="list-group">
                                        <?php
                                            if (isset($upload) && is_array($upload))
                                            {
                                                $i = 0;
                                                foreach ($upload as $post)
                                                {
                                                    $i++;
                                                    if ($post['title'] == 'success')
                                                    {
                                                        ?>
                                                            <a class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success </span> statics/upload/<?=$post['text']['file_name']?></a>
                                                        <?php
                                                    }
                                                    elseif ($post['title'] == 'error')
                                                    {
                                                        ?>
                                                            <a class="list-group-item list-group-item-error"><span class="badge alert-error pull-right">error</span><?=$post['text']?></a>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div id="myModal" class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="img01">
                                    <div id="caption"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /container -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    + function($) {
        'use strict';

        // UPLOAD CLASS DEFINITION
        // ======================

        var dropZone = document.getElementById('drop-zone');
        var uploadForm = document.getElementById('js-upload-form');

        var startUpload = function(files) {
            console.log(files)
        }

//        uploadForm.addEventListener('submit', function(e) {
//            var uploadFiles = document.getElementById('js-upload-files').files;
//            e.preventDefault()
//
//            startUpload(uploadFiles)
//        })

        dropZone.ondrop = function(e) {
            e.preventDefault();
            this.className = 'upload-drop-zone';

            startUpload(e.dataTransfer.files)
        }

        dropZone.ondragover = function() {
            this.className = 'upload-drop-zone drop';
            return false;
        }

        dropZone.ondragleave = function() {
            this.className = 'upload-drop-zone';
            return false;
        }

    }(jQuery);
</script>

<!-- /page content -->