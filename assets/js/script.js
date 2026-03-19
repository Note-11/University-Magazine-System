document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       NAV TOGGLE
    ========================== */
    const menuicn = document.querySelector(".menuicn");
    const nav = document.querySelector(".navcontainer");

    if (menuicn && nav) {
        menuicn.addEventListener("click", () => {
            nav.classList.toggle("navclose");
        });
    }

    /* =========================
       STUDENT UPLOAD MODAL
    ========================== */
    const uploadModal = document.getElementById("uploadModal");
    const openUploadBtn = document.getElementById("openModalBtn");
    const closeUploadBtn = document.getElementById("closeModalBtn");
    const uploadForm = document.getElementById("uploadForm");

    if (openUploadBtn && uploadModal) {
        openUploadBtn.onclick = function () {
            uploadModal.style.display = "flex";
        };
    }

    if (closeUploadBtn && uploadModal) {
        closeUploadBtn.onclick = function () {
            uploadModal.style.display = "none";
            if (uploadForm) uploadForm.reset();
        };
    }

    /* =========================
       DOCUMENT PREVIEW MODAL
    ========================== */
    const previewModal = document.getElementById("documentPreviewModal");
    const closePreviewBtn = document.getElementById("closePreviewBtn");
    const previewFrame = document.getElementById("previewFrame");
    const previewButtons = document.querySelectorAll(".open-preview-btn");

    previewButtons.forEach(button => {
        button.addEventListener("click", function () {

            if (!previewModal || !previewFrame) return;

            const url = this.getAttribute("data-url");

            // OPTIONAL: smarter preview handling
            if (url.includes("type=doc")) {
                previewFrame.src =
                    "https://docs.google.com/gview?url=" +
                    encodeURIComponent(window.location.origin + "/" + url.replace("../../", "")) +
                    "&embedded=true";
            } else {
                previewFrame.src = url;
            }

            previewModal.style.display = "flex";
        });
    });

    if (closePreviewBtn && previewModal) {
        closePreviewBtn.onclick = function () {
            previewModal.style.display = "none";
            if (previewFrame) previewFrame.src = "";
        };
    }

    /* =========================
       CLICK OUTSIDE TO CLOSE
    ========================== */
    window.addEventListener("click", function (event) {

        if (uploadModal && event.target === uploadModal) {
            uploadModal.style.display = "none";
            if (uploadForm) uploadForm.reset();
        }

        if (previewModal && event.target === previewModal) {
            previewModal.style.display = "none";
            if (previewFrame) previewFrame.src = "";
        }

    });

});