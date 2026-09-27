function initNavbar() {
    const button = document.querySelector(".navbar-toggler");
    const nav = document.querySelector("#navMenu");

    if (button && nav) {
        button.addEventListener("click", function () {
            nav.classList.toggle("nav-open");
        });
    }
}

function initValidasiForm() {
    const form = document.querySelector("form");

    if (!form) {
        return;
    }

    form.addEventListener("submit", function (event) {
        const inputWajib = form.querySelectorAll("[required]");

        inputWajib.forEach(function (input) {
            if (input.value.trim() === "") {
                event.preventDefault();

                const pesan = document.createElement("div");
                pesan.className = "text-danger small mt-1";
                pesan.textContent = "Field ini wajib diisi.";

                input.insertAdjacentElement("afterend", pesan);
            }
        });

        const tarif = document.querySelector("#tarif");

        if (tarif && tarif.value < 1000) {
            event.preventDefault();

            const pesan = document.createElement("div");
            pesan.className = "text-danger small mt-1";
            pesan.textContent = "Tarif minimal Rp 1.000.";

            tarif.insertAdjacentElement("afterend", pesan);
        }
    });
}
function initTableFilter() {
    const inputAlat = document.querySelector("#cariAlat");
    const tabelAlat = document.querySelector("#tabelAlat");

    const inputPeminjam = document.querySelector("#cariPeminjam");
    const tabelPeminjam = document.querySelector("#tabelPeminjam");

    if (inputAlat && tabelAlat) {
        inputAlat.addEventListener("keyup", function () {
            const kataKunci = inputAlat.value.toLowerCase();
            const baris = tabelAlat.querySelectorAll("tbody tr");

            baris.forEach(function (row) {
                const data = row.textContent.toLowerCase();

                if (data.includes(kataKunci)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }

    if (inputPeminjam && tabelPeminjam) {
        inputPeminjam.addEventListener("keyup", function () {
            const kataKunci = inputPeminjam.value.toLowerCase();
            const baris = tabelPeminjam.querySelectorAll("tbody tr");

            baris.forEach(function (row) {
                const data = row.textContent.toLowerCase();

                if (data.includes(kataKunci)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }
}
function initHapusConfirm() {
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("btn-hapus")) {
            const yakin = confirm("Apakah kamu yakin ingin menghapus data ini?");

            if (yakin) {
                const baris = event.target.closest("tr");
                baris.remove();
            }
        }
    });
}
initNavbar();
initValidasiForm();
initTableFilter();
initHapusConfirm();