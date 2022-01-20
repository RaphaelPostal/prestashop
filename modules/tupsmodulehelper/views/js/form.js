


(function ($) {

    var formDOM = document.getElementById('mamyfactory__form');

    var AjaxModule = $http('ajax-tab.php');

    LOW.on(formDOM, 'submit', function (event) {
        event.preventDefault();
        return false;
    });


    function callMamies(event) {

        var form = new FormData(formDOM);

        form.append('controller', 'AdminMamyOrderProposal');
        form.append('action', 'CallMamies');
        form.append('ajax', '1');
        form.append('token', mamyfactoryToken);

        AjaxModule.post(form, true).then(function (data) {
            data = JSON.parse(data);
            showSuccessMessage(data.message);
        }).catch(function (error) {
            var data = JSON.parse(error);
            showErrorMessage(data.message);
        })

    }

    function jobsMamies(event) {

        var form = new FormData(formDOM);

        form.append('controller', 'AdminMamyOrderProposal');
        form.append('action', 'JobsMamies');
        form.append('ajax', '1');
        form.append('token', mamyfactoryToken);

        AjaxModule.post(form, true).then(function (data) {
            data = JSON.parse(data);
            showSuccessMessage(data.message);
        }).catch(function (error) {
            var data = JSON.parse(error);
            showErrorMessage(data.message);
        })

    }

    window.mamy = {
        jobsMamies : jobsMamies,
        callMamies : callMamies
    }




})(jQuery);
