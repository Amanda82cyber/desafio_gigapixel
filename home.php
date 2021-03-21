<?php include("menu.php"); ?>

        <script>
            $(document).ready(function(){
                if(screen.width < screen.height) {
                    $("#img_bem_vindo").attr("src", "bem_vindo_celular.png");
                }else{
                    $("#img_bem_vindo").attr("src", "bem_vindo.jpg");
                }
            });
            
        </script>

        <img id = "img_bem_vindo" style = "display: block; margin: 30px auto;" />

    </body>
</html>