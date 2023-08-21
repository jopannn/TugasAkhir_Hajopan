<?php
session_start();
ob_start();
?>
<page>
    <style>
    @page {
        size: A4;
        margin: 2px 3px 0px 3px;
    }

    @media print {
        body {
            margin: 0;
            page-break-after: always;
        }
    }

    
    </style>
    
    <div id="body">
        <?php
        include 'laporan.php';
        ?>
    </div>
    <page_footer id="footer"></page_footer>
</page>
<script>
window.onload = function() {
    window.print();
}
</script>