</div> <!-- layout-content -->
</div> <!-- layout -->

<footer>© 2026 Portfolio Admin</footer>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("toggleSidebar").onclick = function () {
        document.querySelector(".layout").classList.toggle("collapsed");
    };

    document.addEventListener("DOMContentLoaded", function () {
        // Initialize all tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

</body>

</html>