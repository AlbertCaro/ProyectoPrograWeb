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
        <header class="major">
            <h3>Centro Universitario de los Valles</h3>
            <span>Universidad de Guadalajara</span>
            <br><br>
        </header>
        <div class="copyright">
            &copy; Untitled Design: <a href="https://templated.co/">TEMPLATED</a>. Images <a href="https://unsplash.com/">Unsplash</a>
        </div>
    </div>
    <br/><br/><br/><br/><br/><br/><br/>
</section>

<!-- Scripts -->
<script src="<?php echo $dots ?>assets/js/skel.min.js"></script>
<script src="<?php echo $dots ?>assets/js/util.js"></script>
<script src="<?php echo $dots ?>assets/js/main.js"></script>
<script>
    function logout(event) {
        event.preventDefault();
        sendData({
            'count' : <?php echo count($array) ?>
        }, '<?php if (isset($_SESSION['valid'])) echo $dots ?>interactors/session/logout.php');
    }
</script>
</body>
</html>