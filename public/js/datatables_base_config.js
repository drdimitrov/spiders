/**
 * Datatables custom render functions
 *
 */

// Create an object for custom Datatables helper functions
if (typeof dt === "undefined") {
    var dt = {};
}


// No referer redirect url
dt.noRefererUrl = "";



/**
 * convertDateToUserTimezone()
 *
 * @param date
 * @param timezoneName
 *
 * @returns string|null
 */
dt.convertDateToUserTimezone = function(date, timezoneName) {

    // This is to maintain the backwards compatibility
    return dt.convertDateFromUTC(date, timezoneName)

};


/**
 * Convert date from UTC timezone
 *
 * @param date
 * @param timezoneName
 *
 * @returns string|null
 */
dt.convertDateFromUTC = function(date, timezoneName) {

    if (date !== null && date !== '0000-00-00 00:00:00' && date !== undefined) {

        var dateUTC = moment.tz(date, "UTC");
        var dateConverted = dateUTC.clone().tz(timezoneName);

        return dateConverted.format("YYYY-MM-DD HH:mm:ss");

    } else {

        return '';

    }

};


/**
 * Convert date to UTC timezone
 *
 * @param date
 * @param timezoneName
 *
 * @returns string|null
 */
dt.convertDateToUTC = function(date, timezoneName) {

    if (date !== null && date !== '0000-00-00 00:00:00' && date !== undefined) {

        var dateSourceTimezone = moment.tz(date, timezoneName);
        var dateConverted = dateSourceTimezone.clone().tz("UTC");

        return dateConverted.format("YYYY-MM-DD HH:mm:ss");

    } else {

        return '';

    }

};


// Yes/No function
dt.yesNo = function (data, type, row, meta) {

    if (typeof data !== "undefined" && data !== null && data !== "") {

        if (data == '1') {
            return 'Yes';
        } else if (data == '0') {
            return 'No';
        } else {
            return data;
        }

    } else {

        return data;

    }

};


// True/False function
dt.trueFalse = function(data, type, row, meta) {

    if (data !== null) {

        if (data == 1) {
            return "True";
        } else if (data == 0) {
            return "False";
        }

    } else {

        return null;

    }

};


// Url with no referer function
dt.urlNoReferer = function(data, type, row, meta) {

    if (data !== null) {
        return '<a href="' + dt.noRefererUrl + data + '" target="_blank">' + data + '</a>';
    } else {
        return null;
    }

};


// Url function
dt.url = function(data, type, row, meta) {

    if (data !== null) {
        return '<a href="' + data + '" target="_blank">' + data + '</a>';
    } else {
        return null;
    }

};


// Google search function
dt.googleSearch = function(data, type, row, meta) {

    if (data !== null) {
        return '<a href="' + dt.noRefererUrl + 'https://www.google.com/?q=' + data + '" target="_blank">' + data + '</a>';
    } else {
        return null;
    }

};


// Capitalize first letter
dt.capitalizeFirst = function(data, type, row, meta) {

    if (data !== null) {
        return data.substr(0, 1).toUpperCase() + data.substring(1);
    } else {
        return null;
    }

};



/**
 *
 * DataTables default settings that are shared with all pages
 *
 * https://datatables.net/reference/option/
 * https://datatables.net/extensions/index
 * https://datatables.net/plug-ins/index
 *
 */
$.extend(true, $.fn.dataTable.defaults, {

    // False because table goes out of the screen on the right side
    // https://datatables.net/reference/option/autoWidth
    "autoWidth": false,

    // Buttons - https://datatables.net/extensions/buttons/
    "buttons": [
        /*
        {
            "text": '<i class="fa fa-refresh"></i> Reload',
            "action": function (e, dt, node, config) {
                this.draw(false);
            }
        }
        */
    ],

    // https://datatables.net/extensions/colreorder/
    "colReorder": true,

    // https://datatables.net/reference/option/deferRender
    "deferRender": true,

    // https://datatables.net/reference/option/dom
    // "dom": 'Bfltrip',
    "dom": '<"#per-page"l>Bftrip',

    // https://datatables.net/extensions/fixedheader/
    "fixedHeader": {
        "header": true,
        "headerOffset": 0
        // headerOffset: $('.navbar').outerHeight(),
    },

    // https://datatables.net/reference/option/info
    "info": true,

    "language": {

        // https://datatables.net/reference/option/language.decimal
        "decimal": ".",

        // https://datatables.net/reference/option/language.emptyTable
        "emptyTable": "NO DATA AVAILABLE",

        // https://datatables.net/reference/option/language.thousands
        "thousands": ",",

        // https://datatables.net/reference/option/language.info
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",

        // https://datatables.net/reference/option/language.infoEmpty
        "infoEmpty": "",

        // https://datatables.net/reference/option/language.infoFiltered
        "infoFiltered": "",

        // https://datatables.net/reference/option/language.infoPostFix
        "infoPostFix": "",

        // https://datatables.net/reference/option/language.lengthMenu
        "lengthMenu": "Per page: _MENU_",

        // https://datatables.net/reference/option/language.search
        "search": "Search:",
    },

    // https://datatables.net/reference/option/lengthChange
    "lengthChange": true,

    // https://datatables.net/reference/option/lengthMenu
    // [[10, 25, 50, -1], [10, 25, 50, "All"]]
    "lengthMenu": [10, 18, 25, 50, 75, 100, 200, 500, 1000, 2000],

    // https://datatables.net/reference/option/pageLength
    "pageLength": 18,

    // https://datatables.net/reference/option/paging
    "paging": true,

    // https://datatables.net/reference/option/pagingType
    // https://datatables.net/examples/basic_init/alt_pagination.html
    "pagingType": "full_numbers",

    // https://datatables.net/reference/option/processing
    "processing": true,

    // https://datatables.net/extensions/responsive/
    "responsive": true,

    // https://datatables.net/reference/option/searching
    "searching": false,

    // https://datatables.net/reference/option/serverSide
    "serverSide": true,

    // https://datatables.net/extensions/select/
    "select": {
        "blurable": false,
        "info": false,
        "items": "row",
        "style": "os"
    },

    // https://datatables.net/reference/option/stateSave
    "stateSave": false,

    // https://datatables.net/reference/option/stripeClasses
    "stripeClasses": ["strip1", "strip2"],

});


/**
 * Datatables error handler
 *
 */
$.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
    console.error(message);
};