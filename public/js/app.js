new Vue({

    el: '#app',

    mounted() {

        $('#line-form').submit(function (event) {
            event.preventDefault();

            let data = $(this).serialize();
            console.log(data);

            $.post('/user/add-google-line', data, function(response, textStatus, xhr) {
                console.log('Success:', response);

                // new jBox('Notice', {
                //     content: 'Змінено',
                //     color: 'blue',
                //     autoClose: 1000
                // });

            }).fail(function (response) {
                console.log('Error:', response);

            });

        });

    }

});