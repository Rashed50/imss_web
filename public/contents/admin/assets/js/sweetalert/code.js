$(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure To Delete?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Your imaginary file is safe!");
        }

    });
});

$(document).on("click", "#confirm", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure To Confirm?",
        text: "Once Confirm, you will not go Back Step Again!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Not Confirm!");
        }

    });
});

$(document).on("click", "#processing", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure To Processing?",
        text:  "Once Confirm, you will not go Back Step Again!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Not Confirm!");
        }

    });
});

$(document).on("click", "#order", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure To Confrm?",
        text:  "Once Confirm, you will not go Back Step Again!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Not Confirm!");
        }

    });
});

$(document).on("click", "#cancel", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure To Cancel?",
        text:  "Once Cancel, you will not go Back Step Again!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Not Cancel!");
        }

    });
});

$(document).on("click", "#approved", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure of the approval?",
        text:  "Do you approve this employee iqama expense renewal!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Not Confirm!");
        }

    });
});


$(document).on("click", "#released", function(e){
    e.preventDefault();
    var link = $(this).attr("href");

    swal({
        title: "Are you sure to released this Driver?",
        text:  "Do you released this driver from vehicle records!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location.href = link;

        } else {
            // swal("Not Confirm!");
        }

    });
});
