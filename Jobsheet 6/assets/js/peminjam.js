async function loadDataPeminjam() {
    const tbody = document.querySelector("#tabelPeminjamBody");
    const loading = document.querySelector("#loading-indicator");

    try {
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        const response = await fetch("../data/peminjam.json");

        if (!response.ok) {
            throw new Error("Gagal mengambil data peminjam");
        }

        const data = await response.json();

        tbody.innerHTML = "";

        data.forEach(function (peminjam, index) {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${peminjam.kode_peminjam}</td>
                <td>${peminjam.nama_peminjam}</td>
                <td>${peminjam.no_whatsapp}</td>
                <td>${peminjam.alamat}</td>
                <td>${peminjam.status_member}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-hapus">
                        Hapus
                    </button>
                </td>
            `;

            tbody.appendChild(row);
        });

    } catch (error) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center text-danger">
                    Gagal memuat data peminjam.
                </td>
            </tr>
        `;
    } finally {
        loading.style.display = "none";
    }
}

loadDataPeminjam();