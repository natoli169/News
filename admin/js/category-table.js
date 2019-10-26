let table;
$(document).ready(function() {

    table = $('#category-table').DataTable( {
        "ajax": "scripts/categories/getCategories.php",
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"edit\"  type=\"button\" class=\"btn btn-link btn-sm\"><i class=\"fas fa-fw fa-edit\"></i>Edit</button>" +
                " <button id=\"delete\"  type=\"button\" class=\"btn btn-link btn-sm\"><i class=\"fas fa-fw fa-trash\"></i>Delete</button>"
        } ],
        'rowCallback': function(row, data, index){
            if(data[2] == "0"){
                // $(row).addClass("bg-secondary text-white");
                $(row).css("background-color","#C2C2C2");
            }
            $("#parent").append("<select>data[]</select>");
        }
    } );

    $('#category-table tbody').on( 'click', '#edit', function () {
        let data = table.row( $(this).parents('tr') ).data();
        let category = data[2];

        $("#parentEdit").empty();
        $("#parentEdit").append("<option value='0'>Parent</option>");
        $.get("scripts/categories/getParentCategories.php",function(res){
            let parents = JSON.parse(res);
            let data = parents.data;
            for (let i = 0; i < data.length; i++) {
                $("#parentEdit").append("<option value='"+data[i][0]+"'>"+data[i][1]+"</option>");
            }
        });


        $('#category-name_edit').val(data[1]);
        $('#edit_id').val(data[0]);
        $('#parentEdit').val("Sports");
        $('#editPostModal').modal('toggle');

    } );

    $('#category-table tbody').on( 'click', '#delete', function () {
        let data = table.row( $(this).parents('tr') ).data();
        $.post('scripts/categories/deleteCategory.php',
            { id :  data[0]},
            function(data, status, jqXHR) {
                table.ajax.reload();
            });
        table.ajax.reload();
    } );
} );

function addCategory() {
    $.post('scripts/categories/addNewCategory.php',
        { category_name : $("#category-name").val(),
            parent : $("#parent").children("option:selected").val() },
        function(data, status, jqXHR) {
            table.ajax.reload();
            $('#newPostModal').modal('toggle');
        });
}
function editCategory() {
    $.post('scripts/categories/editCategory.php',
        {id: $('#edit_id').val(),
            category_name : $("#category-name_edit").val(),
            parent : $("#parentEdit").children("option:selected").val() },
        function (data, status, jqXHR) {
            table.ajax.reload();
            $('#editPostModal').modal('toggle');
        });
}

function getParents() {
     $("#parent").empty();
    $("#parent").append("<option value='0'>Parent</option>");
    $.get("scripts/categories/getParentCategories.php",function(res){
        let parents = JSON.parse(res);
        let data = parents.data;
        for (let i = 0; i < data.length; i++) {
            $("#parent").append("<option value='"+data[i][0]+"'>"+data[i][1]+"</option>");
        }
    });
}