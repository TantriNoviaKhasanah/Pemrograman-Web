async function loadDataAlat() {
    const tbody = document.querySelector("#tabelAlatBody");
    const loading = document.querySelector("#loading-indicator");

    try {
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        const response = await fetch("../data/alat.json");

        if (!response.ok) {
            throw new Error("Gagal mengambil data alat");
        }

        const data = await response.json();

        tbody.innerHTML = "";

        data.forEach(function (alat, index) {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${alat.kode_alat}</td>
                <td>${alat.nama_alat}</td>
                <td>${alat.kategori}</td>
                <td>Rp ${alat.tarif.toLocaleString("id-ID")}</td>
                <td>${alat.status}</td>
                <td>
                    <button class="btn btn-danger btn-sm btn-hapus">
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
                    Gagal memuat data alat.
                </td>
            </tr>
        `;
    } finally {
        loading.style.display = "none";
    }
}

loadDataAlat();