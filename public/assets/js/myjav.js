function hideParentCate() {
    document.getElementById('parentCate').style.display = 'none';
    document.getElementById('parent_id').value = null;
}
function showParentCate() {
    document.getElementById('parentCate').style.display = 'block';
}


$('.show-alert-delete-box').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Are you sure you want move this category to trash can?",
        text: "If you move, it maybe gone forever.",
        icon: "warning",
        type: "warning",
        buttons: ["Cancel", "Yes!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
$('.show-alert-delete-box-1').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Are you sure you want permanently delete this?",
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        type: "warning",
        buttons: ["Cancel", "Yes!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});

$('body').on('click', ".close-img-btn", function (e) {
    $(this).parent().remove();
});