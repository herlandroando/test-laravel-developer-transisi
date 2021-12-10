$(async function () {
    var $edit = $("#input_company_edit");
    if ($edit.length > 0) {
        var id = $edit.data("search-id");
        await $.ajax({
            url: '/employees/list/company',
            dataType: 'json',
            data: { i: id }
        }).then((data) => {
            $("#input_company_edit").select2({
                data: data.results
            }
            );
        })
        $("#input_company_edit").select2({
            ajax: {
                url: '/employees/list/company',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                }
            }
        });
    }
    $("#input_company_create").select2({
        ajax: {
            url: 'list/company',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                return query;
            }
        }
    });

})
