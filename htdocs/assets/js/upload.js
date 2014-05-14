$(function(){

    var mainUpload;
    var ul;
    $(document).on('click', ".drop a", function() {
          ul = $(this).parent().parent().find('ul');
          mainUpload = $(this).parent().parent();
          $(this).parent().find('input').click();
          fileupload(mainUpload);
      });

    var clipUpload;
    var ulClip;
    $(document).on('click', "li.clip-item", function(event) {
        ulClip = $(this).parent();
        clipUpload = ulClip.parent();

        var input  = $(this).find('input.clip-input');
        if (!$(event.target).is(input)) {
            input.trigger('click');
            appendEmptyLi();
        }
        fileupload(clipUpload);


        function appendEmptyLi()
        {
            var currentLi = ulClip.find('.blockedImage').last();
            if(currentLi.hasClass('clip-item') || !currentLi.is(':empty')) {
                ulClip.append(
                    '<li >' +
                        '<div class="delete-item">&#10006;</div>' +
                        '<div class="blockedImage"></div>' +
                    '</li>'
                );
            } else {
                console.log(currentLi);
            }

        }

    });

    function appendImage(fileName, obj)
    {
        var filePath = '../../uploads/tmp/' + fileName;
        var blockedImage = obj.find('.blockedImage').last();
        var img ='<img class="tmpImage" src="' + filePath + '"/>';
        blockedImage.append(img);
        blockedImage.show();
    }

    function fileupload(workingForm)
    {
        $(workingForm).fileupload({
            // This element will accept file drag/drop uploading
            // This function is called when a file is added to the queue;
            // either via the browse button, or via drag/drop:

            add: function (e, data) {
            if(workingForm.hasClass('upload')) {


            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
            ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span class="status"></span></li>');

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

            $(this).find('.drop').hide();
            }
            appendImage(data.files[0].name, $(this));

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

       return 'test';

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