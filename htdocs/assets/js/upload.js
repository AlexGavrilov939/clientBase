$(function(){

    var uploadForm;
    var ul;

    $(document).on('click', ".drop a", function() {
        ul = $(this).parent().parent().find('ul');
        uploadForm = $(this).parent().parent();
        $(this).parent().find('input').click();
<<<<<<< HEAD
<<<<<<< HEAD
        var test = fileupload(uploadForm);
        console.log(test);
    });

    function appendImage(filePath, obj)
    {
        var blockedImage = obj.find('.blockedImage');
        var img ='<img src="' + filePath + '"/>';
        blockedImage.append(img);
=======
=======
>>>>>>> 0395e1131f78b5cea73bd6bdaf5dadc2c0b5bacc
        fileupload(uploadForm);
    });

    function appendImage(fileName, obj)
    {
        var filePath = '../../uploads/tmp/' + fileName;
        var blockedImage = obj.find('.blockedImage');
        var img ='<img class="tempImage" src="' + filePath + '"/>';
        blockedImage.html(img);
<<<<<<< HEAD
>>>>>>> frontend
=======
>>>>>>> 0395e1131f78b5cea73bd6bdaf5dadc2c0b5bacc
        blockedImage.show();
    }

    function fileupload(uploadForm)
    {
        $(uploadForm).fileupload({
            // This element will accept file drag/drop uploading

            // This function is called when a file is added to the queue;
            // either via the browse button, or via drag/drop:
            add: function (e, data) {
                var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
<<<<<<< HEAD
<<<<<<< HEAD
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
=======
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span title="Удалить изображение" class="status"></span></li>');
>>>>>>> frontend
=======
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span title="Удалить изображение" class="status"></span></li>');
>>>>>>> 0395e1131f78b5cea73bd6bdaf5dadc2c0b5bacc

                // Append the file name and file size
                tpl.find('p').text(data.files[0].name)
                    .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                // Add the HTML to the UL element
                data.context = tpl.appendTo(ul);

                // Initialize the knob plugin
                tpl.find('input').knob();

                // Listen for clicks on the cancel icon
                tpl.find('span').click(function(){

                    if(tpl.hasClass('working')){
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function(){
                        tpl.remove();
                    });

                });

                // Automatically upload the file once it is added to the queue
                var jqXHR = data.submit();
<<<<<<< HEAD
<<<<<<< HEAD
                $(this).find('.drop').hide();
                console.log(jqXHR);
                console.log(jqXHR.statusText);


                appendImage(jqXHR, $(this));
=======
=======
>>>>>>> 0395e1131f78b5cea73bd6bdaf5dadc2c0b5bacc

                $(this).find('.drop').hide();


                appendImage(data.files[0].name, $(this));
<<<<<<< HEAD
>>>>>>> frontend
=======
>>>>>>> 0395e1131f78b5cea73bd6bdaf5dadc2c0b5bacc

            },

            progress: function(e, data){

                // Calculate the completion percentage of the upload
                var progress = parseInt(data.loaded / data.total * 100, 10);

                // Update the hidden input field and trigger a change
                // so that the jQuery knob plugin knows to update the dial
                data.context.find('input').val(progress).change();

                if(progress == 100){
                    data.context.removeClass('working');
                }
            },

            fail:function(e, data){
                // Something has gone wrong!
                data.context.addClass('error');
            }

        });
<<<<<<< HEAD
<<<<<<< HEAD
        return 'test';
=======
>>>>>>> frontend
=======
>>>>>>> 0395e1131f78b5cea73bd6bdaf5dadc2c0b5bacc
    }


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});