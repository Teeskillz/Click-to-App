/**
 * Click to Chat - new interface
 */

var url = window.location.href;


// post title
var post_title = ht_ctc_var.post_title;

// is_mobile yes/no
var is_mobile = ht_ctc_var.is_mobile;


/**
 * click 
 */
ht_ctc_click_event();

function ht_ctc_click_event() {

    // chat
    var ht_ctc_chat = document.querySelectorAll('.ht-ctc-chat');
    if (ht_ctc_chat) {
        for(var i = 0; i < ht_ctc_chat.length; i++)
        {
            ht_ctc_chat[i].addEventListener('click', ht_ctc_clicked_chat );
        }
    }
    
    // share
    var ht_ctc_share = document.querySelectorAll('.ht-ctc-share');
    if (ht_ctc_share) {
        for(var i = 0; i < ht_ctc_share.length; i++)
        {
            ht_ctc_share[i].addEventListener('click', ht_ctc_clicked_share );
        }
    }

    // group
    var ht_ctc_group = document.querySelectorAll('.ht-ctc-group');
    if (ht_ctc_group) {
        for(var i = 0; i < ht_ctc_group.length; i++)
        {
            ht_ctc_group[i].addEventListener('click', ht_ctc_clicked_group );
        }
    }

    // var woo = document.querySelector('.ht-ctc-chat-woo');
    // if (woo) {
    //     woo.addEventListener('click', ht_click_clicked);
    // }
}

// return_type
function ht_ctc_clicked_chat() {
    ht_ctc_clicked('chat');
}
function ht_ctc_clicked_share() {
    ht_ctc_clicked('share');
}
function ht_ctc_clicked_group() {
    ht_ctc_clicked('group');
}

// clicked
function ht_ctc_clicked( return_type ) {

    // link
    ht_ctc_link( return_type );

    // analytics
    ht_ctc_analytics( return_type );

}


// link
function ht_ctc_link( return_type ) {


    var base_link = '';


    if (is_mobile == 'yes') {
        // mobile, tab devices
    
        if (return_type == 'group') {
            // group
            var base_link = 'https://chat.whatsapp.com/';
        } else if (return_type == 'share') {
            // share
            var base_link = 'https://api.whatsapp.com/send';
        } else {
            // chat
            // new way added direclty - window.open - using wa.me link
            var base_link = 'https://api.whatsapp.com/send';
        }
    } else {
        // desktop devices
    
        if (return_type == 'group') {
            // group
            var base_link = 'https://chat.whatsapp.com/';
        } else if (return_type == 'share') {
            // share
            var base_link = 'https://web.whatsapp.com/send';
        } else {
            // chat
            // new way added direclty - window.open - using wa.me link
            var base_link = 'https://web.whatsapp.com/send';
        }
    }


    // var width = '10000';
    // var height = '1000';
    // var three = 'noopener';
    // var blank = '';

    // if ( 1 == 10 ) {
    //     // height, width
    //     var three = 'width='+width+',height='+height;
    // } else if ( 1 == 1 ) {
    //     // blank
    //     var blank = "_blank";
    //     if ( 1 == 1 ) {
    //         // noopener
    //         var noopener = "noopener";
    //     }
    // }


    // link
    if (return_type == 'group') {
        // group
        var group_id = ht_ctc_var_group.group_id;
        window.open(base_link + group_id, '_blank', 'noopener');
    } else if (return_type == 'share') {
        // share
        var share_text = ht_ctc_var_share.share_text;
        window.open(base_link + '?text=' + share_text, '_blank', 'noopener');
    } else {
        // chat
        var number = ht_ctc_var_chat.number;
        var pre_filled = ht_ctc_var_chat.pre_filled;

        // web/api.whastapp    or    wa.me
        if ( '1' == ht_ctc_var_chat.webandapi ) {
            // i.e. if web.whatsapp / api.whatsapp is checked
            window.open(base_link + '?phone=' + number + '&text=' + pre_filled, '_blank', 'noopener');
        } else {
            // new way - wa.me link
            var base_link = 'https://wa.me/';
            window.open(base_link + number + '?text=' + pre_filled, '_blank', 'noopener');
        }
        
    }

}


// shortcode link
// know issue - if in link "" are used the link my not work properly.. (prefilled message)
function ht_ctc_shortcode_click(link) {
    data_link = link.getAttribute("data-ctc-link");
    window.open(data_link, '_blank', 'noopener');

    return_type = link.getAttribute("data-ctc-type");

    ht_ctc_analytics( return_type );
}



// Analytics
function ht_ctc_analytics( return_type ){

    // Google Analytics
    var is_ga_enable = ht_ctc_var.is_ga_enable;
    if ( 'yes' == is_ga_enable ) {
        ht_ctc_ga( return_type );
    }

    // FB Analytics
    var is_fb_an_enable = ht_ctc_var.is_fb_an_enable;
    if ( 'yes' == is_fb_an_enable ) {
        ht_ctc_fb_an( return_type );
    }

}

// Google Analytics
function ht_ctc_ga( return_type ) {

    var ga_category = 'Click to Chat for WhatsApp';
    var ga_action = 'return type: ' + return_type ;
    var ga_label = post_title + ', ' + url ;

    // // ga('send', 'event', 'Contact', 'Call Now Button', 'Phone');

    if ("ga" in window) {
    // if ( ga.window && ga.create) {
        tracker = ga.getAll()[0];
        if (tracker) tracker.send("event", ga_category, ga_action, ga_label );
    } else if ("gtag" in window) {
        gtag('event', ga_action, {
            'event_category': ga_category,
            'event_label': ga_label,
        });
    }

}

// FB Analytics
function ht_ctc_fb_an( return_type ) {
    
    var fb_event_name = 'Click to Chat for WhatsApp';

    var params = {};
    params['Category'] = 'Click to Chat for WhatsApp';
    params['Action'] = 'return type: ' + return_type;
    params['Label'] = post_title + ', ' + url ;

    // if fb analytics is not installed, then uncheck fb analytics option from main plugin settings
    FB.AppEvents.logEvent( fb_event_name, null, params);
}