<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Patient Management System</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo CDN_LINK ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/quill/quill.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?php echo CDN_LINK ?>assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo CDN_LINK ?>assets/js/main.js"></script>

<script>
    function deleteConfirmation(link) {
        console.log(`request for delete = ${link}`)
        const confirmation = confirm("Are you sure?");

        if (confirmation) {
            window.location.href = link;
        } else {
            console.log("Link not followed."); // Or perform another action here
        }
    }

    function openInWindow(link) {
        window.open(link, '_blank')
    }

    function removeCollapsed(id) {
        document.getElementById(id).className =
            document.getElementById(id).className.replace("collapsed", "")
    }

    function navActive(id) {
        document.getElementById(id).className = "active";
    }

    function ageCalculator(dob) {
        let year = new Date().getFullYear() - new Date(dob).getFullYear();
        const month = new Date().getMonth() - new Date(dob).getMonth();
        // if (month > 6) {
        //     year++;
        // } else if (month < 3) {
        //     year--;
        // }
        return year;
    }
</script>

