var csrf_token = $("meta[name=csrf-token]")[0].content;

// $(document).ready(function () {
//     $("#logout").on("click", function () {
//         Swal.fire({
//             title: "Konfirmasi",
//             text: "Apakah anda ingin keluar dari aplikasi ?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Keluar Aplikasi",
//             cancelButtonText: "Batal",
//         }).then((result) => {
//             /* Read more about isConfirmed, isDenied below */
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: route("logout"),
//                     type: "post",
//                     data: {
//                         _token: csrf_token,
//                     },
//                     dataType: "json",
//                     success: (response) => {
//                         window.location.href = route("login");
//                     },
//                 });
//             }
//         });
//     });
// });

function confirmation(text, callback) {
    Swal.fire({
        title: "Konfirmasi",
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yakin",
        cancelButtonText: "Batal",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            callback();
        }
    });
}

function success(text, callback) {
    Swal.fire({
        title: "Berhasil",
        text: text,
        icon: "success",
    }).then(() => {
        callback();
    });
}
function warning(text, callback) {
    Swal.fire({
        title: "Pemberitahuan",
        text: text,
        icon: "warning",
    }).then((response) => {
        callback(response);
    });
}
function error_alert(text, callback) {
    Swal.fire({
        title: "Pemberitahuan",
        text: text,
        icon: "warning",
    }).then(() => {
        callback();
    });
}
function info_alert(text, callback) {
    Swal.fire({
        title: "Pemberitahuan",
        text: text,
        icon: "warning",
    }).then(() => {
        callback();
    });
}

function showGambarFancyBox(url) {
    $.fancybox([url], {
        type: "image",
    });
}
