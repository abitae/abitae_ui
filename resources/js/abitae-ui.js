(function () {
    if (window.AbitaeUi) {
        return;
    }

    window.AbitaeUi = {
        version: '0.1.0',
        init: function () {
            // Placeholder for future component hooks.
        },
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            window.AbitaeUi.init();
        });
    } else {
        window.AbitaeUi.init();
    }
})();
