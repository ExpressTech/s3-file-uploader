<?php

session_start();

include('config.php');

if($password != '') {

    if(!isset($_SESSION['password'])) {
        echo "<form method='POST'><input type='password' name='password' ><input type='submit'></form>";

        if(isset($_POST['password']) ) {
            if($password == $_POST['password']) {
                $_SESSION['password'] = $password;
            } else {
                die('Invalid password');
            }
            
        } else {
            exit;
        }
    }
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multi File Uploader</title>
    <link href="all.fine-uploader/fine-uploader-gallery.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="config.js""></script>
    <script src="all.fine-uploader/all.fine-uploader.min.js""></script>
    <center> <img src="img/icon.png"> <h3> Multi File Uploader</h3></center>
    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Upload a file</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <div class="qq-thumbnail-wrapper">
                        <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                    </div>
                    <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                    <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                        <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                        Retry
                    </button>

                    <div class="qq-file-info">
                        <div class="qq-file-name">
                            <span class="qq-upload-file-selector qq-upload-file"></span>
                            <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>
                        </div>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                            <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                            <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                            <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                        </button>
                    </div>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>

    <title>CMS Launcher Fine Uploader</title>
</head>
<body>
    <div id="uploader"></div>
    <script>

        function makeid()
        {
            return Math.random().toString(36).substring(7);
        }

        // Some options to pass to the uploader are discussed on the next page

        if(endpointType == 's3') {
            var uploader = qq.s3.FineUploader;
        } else {
            var uploader = qq.FineUploader;
        }
        // alert(endpoint);
        var uploader = new uploader({
            request: {
                endpoint: endpoint,
                accessKey: accessKey,
                params : {
                    'Cache-Control': 'max-age=86400'
                }
            },
            element: document.getElementById("uploader"),
            debug: true,
            signature: {
                endpoint: actionsEndpoint,
                version : 4
            },
            uploadSuccess: {
                endpoint: actionsEndpoint + "?success"
            },
            iframeSupport: {
                localBlankPagePath: "success.html"
            },
            chunking: {
                enabled: true,
                concurrent: {
                    enabled: true
                }
            },
            // autoUpload: false,
            resume: {
                enabled: true
            },
            retry: {
                enableAuto: true,
                showButton: true
            },
            deleteFile: {
                enabled: true,
                endpoint: actionsEndpoint
            },

            callbacks : {
                onComplete : function(id, currentFile, obj) {
                    // alert(id);
                    console.log(currentFile);
                    console.log(obj);

                    if(endpointType == 's3') {
                        var url = obj.tempLink;

                        if(typeof cloudFrontUrl !== 'undefined' && cloudFrontUrl != '') {
                            var filename = url.split('/').pop();
                            filename = filename.split('?')[0];
                            url = cloudFrontUrl + filename;
                        }
                        

                        $('.qq-file-id-' + id  + ' .qq-upload-file-selector').html('<a href="'+url+'">'+currentFile+'</a>');
                    } else {

                        var url = 'files/' + obj.uuid + '/' + obj.uploadName;
                        
                        console.log(url);

                        $('.qq-file-id-' + id  + ' .qq-upload-file-selector').html('<a href="'+url+'">'+currentFile+'</a>');
                    }

                    
                }
            },
            objectProperties: {
                key: function (fileId) {

                    var filename = uploader.getName(fileId);
                    var uuid = uploader.getUuid(fileId);
                    var ext = filename.substr(filename.lastIndexOf('.') + 1); 

                   return  makeid() + '-' + filename;
                },
                region : region,
                bucket: bucket
            }
            
        });


    </script>
</body>
</html>