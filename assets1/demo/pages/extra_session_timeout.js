/* ------------------------------------------------------------------------------
 *
 *  # Session timeout
 *
 *  Demo JS code for extra_session_timeout.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

const SessionTimeout = function() {


    //
    // Setup module components
    //

    // Session timeout
    const _componentSessionTimeout = function() {
        if (!$.sessionTimeout) {
            console.warn('Warning - session_timeout.min.js is not loaded.');
            return;
        }

        // Session timeout
        $.sessionTimeout({
            title: 'Session Timeout',
            message: 'Your session is about to expire. Do you want to stay connected?',
            ignoreUserActivity: true,
            warnAfter: 1800000,
            redirAfter: 60000,
            redirUrl: 'workfolio_mssp_log.php',
            logoutUrl: 'logout.php'
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentSessionTimeout();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    SessionTimeout.init();
});
