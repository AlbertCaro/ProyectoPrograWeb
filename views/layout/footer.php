<?php
/**
 * Created by Alberto Caro Navarro using IntelliJ IDEA.
 * Email: albertcaronava@gmail.com
 * Date: 27/04/2018
 * Time: 09:48 AM
 */
?>
<!-- Footer -->
<section id="footer">
    <div class="inner" align="center">
        <div id="sessionResponse"></div>
        <header class="major">
            <h3>International Music database</h3>
            <span>Powered by Dynamite Enterprise</span>
            <br><br>
        </header>
        <div class="copyright">
            &copy; <?php echo date('Y') ?> Alberto Caro Navarro. Template by: <a href="https://templated.co/">TEMPLATED</a>.
        </div>
    </div>
</section>
<!-- Scripts -->
<script src="<?php echo $dots ?>assets/js/skel.min.js"></script>
<script src="<?php echo $dots ?>assets/js/util.js"></script>
<script src="<?php echo $dots ?>assets/js/main.js"></script>
<script>
    function logout(event) {
        event.preventDefault();
        sendDataDiv({
            'count' : <?php echo count($array) ?>,
            'func' : 'logout'
        }, '<?php if (isset($_SESSION['valid'])) echo $dots ?>login/controller/',
        "#sessionResponse");
    }
</script>
</body>
</html>
<?php
require_once "../../models/Connection.php";
Connection::destroy();
?>