<footer>
    
    <div class="social-info">
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
    </div>

    <p class="copyright" >&copy; Puutarhaliike Neilikka <?php echo date('Y') ?></p>
</footer>


<!-- Jquery script -->
<script src="assets/jquery.min.js"></script>
<script src="assets/bootstrap.min.js"></script>
<script src="assets/jquery.dataTables.min.js"></script>
<script src="assets/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $("#flash-msg").delay(7000).fadeOut("slow");
});
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
<script src="" async defer></script>
</body>

</html>