$(document).ready(function() {

    let notification = $("#alert");
    notification.css({
        position: 'fixed',
        bottom: '65px',
        right: '20px',
        backgroundColor: 'whitesmoke',
        color: 'black',
        padding: '10px 20px',
        borderRadius: '5px',
        zIndex: '1000',
        opacity: '1',
        transition: 'opacity 1s ease-in-out'
    });
    $('body').append(notification);
    setTimeout(function () {
        notification.css('opacity', '0');
        setTimeout(function () {
            notification.remove();
        }, 1000);
    }, 1000);

});
