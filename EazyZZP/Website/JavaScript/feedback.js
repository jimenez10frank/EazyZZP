// fancy feedback
let FDB = $('.mess, .messInvalid');
if (FDB !== null) {
    FDB.fadeIn(1000);
}



if (FDB.children().length != null) {
    setTimeout(() => {
        FDB.slideUp(1200);
        FDB.css({
            'display': 'block',
            'animation': 'ease-out 0.3s',
            'transition': 'box-shadow 13s ease-out',
        });
    }, 5000);

    setTimeout(() => {
        FDB.remove();
    }, 6500);
}

// Container waarop effect wordt uitgevoerd
// # Dropdown effect 
let stuff = $('.contain');

// effect voor container
if($(document).ready(() => {
    // content load effecten     
    stuff.slideDown(1000);
   
    stuff.css('display', 'flex');

}));
