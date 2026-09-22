     <!-- footer content -->
        <footer>
          <div class="copyright-info">
            <p class="pull-right"><?php echo 'Business Panel by ';?>   <?php echo $this->config->item("productName");?>
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
	</div>


  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

        <script src="<?=$this->config->item('adminAssetsPath')?>js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="<?=$this->config->item('adminAssetsPath')?>js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/nicescroll/jquery.nicescroll.min.js"></script>
        

        <script src="<?=$this->config->item('adminAssetsPath')?>js/custom.js"></script>


        <!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/jquery.dataTables.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/dataTables.bootstrap.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/dataTables.buttons.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/buttons.bootstrap.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/jszip.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/pdfmake.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/vfs_fonts.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/buttons.html5.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/buttons.print.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/dataTables.responsive.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?=$this->config->item('adminAssetsPath')?>js/datatables/dataTables.scroller.min.js"></script>


        <!-- pace -->
        <script src="<?=$this->config->item('adminAssetsPath')?>js/pace/pace.min.js"></script>
		
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>
  
</body>

</html>
