window.pageAlert = (function () {
    let timeoutId = null;

    function hideAlert() {
        clearTimeout(timeoutId);
        const container = $('#pageAlertContainer');
        const alert = $('#pageAlert');

        alert.stop(true, true).slideUp(200, function () {
            container.addClass('d-none');
            alert.removeClass('show');
        });
    }

    function show(type, title, message, duration = 5000) {
        const container = $('#pageAlertContainer');
        const alert = $('#pageAlert');
        const titleEl = $('#pageAlertTitle');
        const messageEl = $('#pageAlertMessage');

        alert.removeClass('alert-success alert-warning alert-danger alert-info');
        alert.addClass(`alert-${type}`);
        titleEl.text(title);
        messageEl.text(message);

        clearTimeout(timeoutId);
        container.removeClass('d-none');
        alert.stop(true, true).slideDown(200).addClass('show');

        timeoutId = setTimeout(hideAlert, duration);

        alert.find('.close').off('click').on('click', function () {
            hideAlert();
        });
    }

    return { show };
})();

window.showAlert = function (
    type,
    title,
    message,
    duration = 5000
) {

    window.pageAlert.show(
        type,
        title,
        message,
        duration
    );
};