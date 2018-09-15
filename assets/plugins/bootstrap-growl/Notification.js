
function executeNotif(message,type)
{
    var nIcons = "fa fa-check";
        
    var nAnimIn = $(this).attr('data-animation-in');
    var nAnimOut = $(this).attr('data-animation-out');
    
    notify("bottom", "left", nIcons, type, nAnimIn, nAnimOut,message);
}

function notify(from, align, icon, type, animIn, animOut, message){
    newFunction(from, align, icon, type, animIn, animOut, message);

    function newFunction(from, align, icon, type, animIn, animOut, message) {
        $.growl({
            icon: icon,
            title: '',
            message: message,
            url: ''
        }, {
                element: 'body',
                type: type,
                allow_dismiss: true,
                placement: {
                    from: from,
                    align: align
                },
                offset: {
                    x: 50,
                    y: 85
                },
                spacing: 10,
                z_index: 1031,
                delay: 6000,
                timer: 2500,
                url_target: '_blank',
                mouse_over: false,
                animate: {
                    enter: animIn,
                    exit: animOut
                },
                icon_type: 'class',
                template: '<div data-growl="container" class="alert" role="alert">' +
                    '<button type="button" class="close" data-growl="dismiss">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '<span class="sr-only">Close</span>' +
                    '</button>' +
                    '<span data-growl="icon"></span>' +
                    '<span data-growl="title"></span>' +
                    '<span data-growl="message"></span>' +
                    '<a href="#" data-growl="url"></a>' +
                    '</div>'
            });
    }
}
