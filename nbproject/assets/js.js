$(document).ready(function () {
    $("input[name=action]").on('input', function (e) {
        var $action = $(this).val();

        $('#team').attr("style", "display: none !important");
        $('#newname').attr("required", "true");
        $('#update').attr("style", "display: none !important");

        if ($action == 'update') {
            $('#team').attr("style", "display: block !important");
            $('#update').attr("style", "display: block !important");
        } else if ($action == 'show') {
            $('#team').attr("style", "display: block !important");
            $('#newname').removeAttr('required');
        }
    });

    $("#contact_form").submit(function (event) {
        event.preventDefault();

        var $form = $(this);
        var $url = $form.attr('action');
        var $action = $("input[name=action]").val()
        $.ajax({
            type: "POST",
            url: $url,
            data: {"action": $("input[name=action]").val(), "team": $('#equipo').val(), "newname": $('#newname').val()},
            success: function ($response) {
                var $equipo = $.parseJSON($response);
                if ($action == 'show') {
                    $.each($equipo, function ($index, $value) {
                        //console.log($('table').children('tr:not(:first)'))
                        $('table tr').remove();
                        $('table').append('<tr><td colspan=3>' + $index + '</td></tr>');

                        $.each($value, function ($i, $v) {
                            $('table').append('<tr><td>' + $v.id + '</td><td>' + $v.nick + '</td><td>' + $v.summoner + '</td></tr>');
                        });
                    });
                } else if ($action == 'update') {
                    alert('updated');
                }

            }
        });
    });
});