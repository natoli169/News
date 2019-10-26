let table;
$(document).ready(function () {
    table = $('#post-table').DataTable({
        "ajax": "scripts/posts/getPosts.php",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"edit\"  type=\"button\" class=\"btn btn-link btn-sm\"><i class=\"fas fa-fw fa-edit\"></i>Edit</button>" +
                " <button id=\"delete\"  type=\"button\" class=\"btn btn-link btn-sm\"><i class=\"fas fa-fw fa-trash\"></i>Delete</button>"
        }],
    });

    $('#post-table tbody').on( 'click', '#delete', function () {
        let data = table.row( $(this).parents('tr') ).data();
        $.post('scripts/posts/deletePost.php',
            { id :  data[0]},
            function(data, status, jqXHR) {
                table.ajax.reload();
            });
        table.ajax.reload();
    } );

    $('#post-table tbody').on( 'click', '#edit', function () {
        let data = table.row( $(this).parents('tr') ).data();
        getCategoriesEdit();
        $('#edit_id').val(data[0]);
        $.get("scripts/posts/getPost.php?id=" + data[0],function(res){
            let post = JSON.parse(res);
            let data = post.data;
            $("#editTitle").val(data[1]);
            $("#editAuthor").val(data[2]);
            $("#editBody").val(data[7]);
            $("#editCategory").val(data[9]);
            $("#editHeadline").val(data[5]);
            $("#id").val(data[0]);
            console.log(data[5]);

        });
        $('#editPostModal').modal('toggle');

    } );

});



function getCategories() {
    $("#category").empty();
    $("#category").append("<option value='0'>---Select One----</option>");
    $.get("scripts/categories/getChildCategories.php",function(res){
        let categories = JSON.parse(res);
        let data = categories.data;
        for (let i = 0; i < data.length; i++) {
            $("#category").append("<option value='"+data[i][0]+"'>"+data[i][1]+"</option>");
        }
    });
}

function getCategoriesEdit() {
    $("#editCategory").empty();
    $("#editCategory").append("<option value='0'>---Select One----</option>");
    $.get("scripts/categories/getChildCategories.php",function(res){
        let categories = JSON.parse(res);
        let data = categories.data;
        for (let i = 0; i < data.length; i++) {
            $("#editCategory").append("<option value='"+data[i][0]+"'>"+data[i][1]+"</option>");
        }
    });
}


function newPost() {
    let errors = [];
    if($("#title").val() == ""){
        errors.push("Title can't be empty!");
    }

    if($("#author").val()  == ""){
        errors.push("Author can't be empty!");
    }

    if($("#body").val()  == ""){
        errors.push("Body can't be empty!");
    }

    if($("#category").val() == 0){
        errors.push("Category Not Selected!");
    }

    if(errors.length === 0) {
        let myData = new FormData($("#newPostForm")[0]);

        $.ajax({
            url: 'scripts/posts/addNewPost.php',
            data: myData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                $("#title").val("");
                $("#author").val("");
                $("#body").val("");
                $("#fileToUpload").val("");
                $(".errors").empty();
                table.ajax.reload();
                $('#newPostModal').modal('toggle');
            }
        });
    }else{
        console.log(errors);
        $(".errors").empty();
        for (let i = 0; i < errors.length; i++) {
            $(".errors").append("<li>" +errors[i] + "</li>");

        }
    }

}

function editPost() {
    let errors = [];
    if ($("#editTitle").val() == "") {
        errors.push("Title can't be empty!");
    }

    if ($("#editAuthor").val() == "") {
        errors.push("Author can't be empty!");
    }

    if ($("#editBody").val() == "") {
        errors.push("Body can't be empty!");
    }

    if ($("#editCategory").val() == 0) {
        errors.push("Category Not Selected!");
    }

    if (errors.length === 0) {
        let myData = new FormData($("#editPostForm")[0]);
        console.log(myData);
        $.ajax({
            url: 'scripts/posts/editPost.php',
            data: myData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                console.log(data);
                table.ajax.reload();
                $('#editPostModal').modal('toggle');
            }
        });
    } else {
        $(".errors #edit").empty();
        for (let i = 0; i < errors.length; i++) {
            $(".errors #edit").append("<li>" + errors[i] + "</li>");

        }
    }
}