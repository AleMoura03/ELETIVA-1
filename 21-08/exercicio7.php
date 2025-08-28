
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = $_POST["valor1"];
            $multiplicar = ($valor1 - 32) / 1.8;
            echo "<p> Convertendo: $valor1 ºF = $multiplicar ºC</p>";
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>