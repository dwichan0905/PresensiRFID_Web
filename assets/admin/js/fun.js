function deldsn(base, nidn, nama) {
    if (confirm('Yakin ingin menghapus dosen ' + nama + '?')) {
        $.ajax({
            url: base + "actions/del_dosen/" + nidn,
            type: 'GET',
            complete: function () {
                location.reload();
            }
        });
    }
}

function delmhs(base, nim, nama) {
    if (confirm('Yakin ingin menghapus mahasiswa ' + nama + '?')) {
        $.ajax({
            url: base + "actions/del_mahasiswa",
            type: 'GET',
            data: "nim=" + nim,
            complete: function () {
                location.reload();
            }
        });
    }
}

function deldev(base, id, nama) {
    if (confirm('Yakin ingin menghapus perangkat ' + nama + '?')) {
        $.ajax({
            url: base + "actions/del_dev/" + id,
            type: 'GET',
            complete: function () {
                location.reload();
            }
        });
    }
}