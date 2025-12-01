<!-- Footer kecil full kiri kanan -->
<footer class="footer-fixed">
    <div class="footer-card text-white small text-center">
        © Kasir Restoran <?= date("Y"); ?>  
        <p class="mb-0">Dibuat oleh Rayhan Fadhil</p>
    </div>
</footer>

<style>
    .footer-fixed {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 1; /* cukup di depan background, tapi tetap di belakang sidebar */
    }

    .footer-card {
        background: #005ea7; /* biru sesuai pilihan */
        width: 100%;
        padding: 10px 10px;
        box-sizing: border-box;
    }


</style>
