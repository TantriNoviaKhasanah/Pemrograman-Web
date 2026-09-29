function initHapusConfirm() {
    document.addEventListener("submit", function (e) {
        const form = e.target;
        if (!form.classList.contains("form-hapus")) return;

        const row = form.closest("tr");
        const kolomNama = row ? row.querySelectorAll("td")[2] : null;
        const nama = kolomNama ? kolomNama.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (!yakin) {
            e.preventDefault();
        }
    });
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        form.querySelectorAll("[required]").forEach(function (input) {
            if (input.type === "radio") return;

            if (input.value.trim() === "") {
                tampilkanError(input, "Field ini wajib diisi.");
                valid = false;
            } else {
                hapusError(input);
            }
        });

        const tarif = form.querySelector("[name='tarif']");
        if (tarif && tarif.value !== "" && parseInt(tarif.value, 10) < 1000) {
            tampilkanError(tarif, "Tarif minimal Rp 1.000.");
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

document.addEventListener("DOMContentLoaded", function () {
    initHapusConfirm();
    initValidasiForm();
});