        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo URL; ?>addons/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo URL; ?>addons/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo URL; ?>addons/metisMenu/dist/metisMenu.min.js"></script>

    <?php if($_SERVER["REQUEST_URI"] === '/administration/index/') { ?>
        <!-- Morris Charts JavaScript -->
        <script src="<?php echo URL; ?>addons/raphael/raphael-min.js"></script>
        <script src="<?php echo URL; ?>addons/morrisjs/morris.min.js"></script>
        <script src="<?php echo URL; ?>addons/sbadmin/morris/morris-data.js"></script>
    <?php } ?>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo URL; ?>addons/sbadmin/js/sb-admin-2.js"></script>

</body>

</html>
