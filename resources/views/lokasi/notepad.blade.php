\
<script>
function destroyUser(id) {
    const url = "{{ url('lokasi/delete') }}/"+id;

    fetch(url, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
                iziToast.success({
                    title: 'Success',
                    message: data.message,
                    position: 'topRight'
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'Eror '+message,
                    position: 'topRight'
            });
            }
        })
        .catch(error => {
            iziToast.error({
                title: 'Error',
                message: 'Terjadi kesalahan menghapus lokasi '+error,
                position: 'topRight'
            });
        });
}

function deleteConfirmLocation(id) {
    swal({
        title: 'Apakah Anda Yakin?',
        text: "Anda Ingin Menghapus User",
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then((result) => {
        if (result) {
            destroyUser(id)
        }
    })
}
storeBtnLokasi
</script>
