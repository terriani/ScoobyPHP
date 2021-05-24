document.addEventListener("DOMContentLoaded", function () {

})

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000,
    onOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
function isOnline(titleFailure, msgFailure, titleSuccess, msgSuccess) {
    window.addEventListener("online", function () {
        Toast.fire(titleSuccess, msgSuccess, "success");
    });
    window.addEventListener("offline", function () {
        Toast.fire(titleFailure, msgFailure, "warning");
    });
}
function deleteConfirm(url, csrfToken = "", redirect = "", data = {}) {
    swal.fire({
        title: "Você esta certo disso?",
        text: "Esta ação não poderá ser revertida!",
        showCancelButton: true,
        confirmButtonText: "Deletar!",
        cancelButtonText: "Cancelar!",
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: "delete",
                url: url,
                data: { csrfToken: csrfToken, data: data },
                success: function (data) { },
            });
            Toast.fire("💔 Deletado!", "Deletado com sucesso.", "success").then(
                function () {
                    window.location.href = redirect;
                }
            );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Toast.fire("Cancelado", "Cancelado com sucesso :)", "error");
        }
    });
}
function logout(token) {
    $.ajax({
        method: "get",
        url: "http://welovemovies.com.br/logout",
        data: { csrfToken: csrfToken },
        success: function (data) {
            console.log(data);
        },
        error: function () {
            console.log("erro");
        },
    });
}
