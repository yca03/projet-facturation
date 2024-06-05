$(document).ready(function () {
    $('#admin_user_lastname, #admin_user_firstname').on('input', function () {
        const firstName = $('#admin_user_firstname').val().toLowerCase();
        const lastName = $('#admin_user_lastname').val().toLowerCase();
        let prefix;
        if (!lastName) {
            prefix = `${firstName.split(' ')}`
        } else {
            prefix = `${firstName.split(' ')}_${lastName.split(' ')}`
        }
        let length = 8;
        let charset = "0123456789";
        let string = "";
        let i = 0, n = charset.length;

        for (; i < length; ++i) {
            string = charset.charAt(Math.floor(Math.random() * n));
        }
        string += prefix + charset.charAt(Math.floor(Math.random() * n));
        $("#admin_user_username").val(string);
    })
})
