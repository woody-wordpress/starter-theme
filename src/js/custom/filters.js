import WoodyFilter from 'woody-library/assets/js/filter';

// disabled close menu when scrolling down
WoodyFilter.add('scroll_hide_menu_modifier', function() {
    return false;
});

// Disable padding calc in JS on the body
WoodyFilter.add('padding_menu_calc_disable', function() {
    return true;
});