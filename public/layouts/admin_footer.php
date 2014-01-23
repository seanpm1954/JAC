</div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Network PC Pro's</div>
<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    var spryUserName1 = new Spry.Widget.ValidationTextField("spryUserName1");
    var spryPassword1 = new Spry.Widget.ValidationTextField("spryPassword1");
    var spryFirst1 = new Spry.Widget.ValidationTextField("spryFirst1");
    var spryLast1 = new Spry.Widget.ValidationTextField("spryLast1");
    var spryEmail1 = new Spry.Widget.ValidationTextField("spryEmail1");

    var spryUserName = new Spry.Widget.ValidationTextField("spryUserName");
    var spryPassword = new Spry.Widget.ValidationTextField("spryPassword");
    var spryFirst = new Spry.Widget.ValidationTextField("spryFirst");
    var spryLast = new Spry.Widget.ValidationTextField("spryLast");
    var spryEmail = new Spry.Widget.ValidationTextField("spryEmail");
</script>
  </body>
</html>
<?php if(isset($db)) { $db->close_connection(); } ?>