<?php
    function sanitize_output($buffer) {
        $search = array(
            '/(\n|^)(\x20+|\t)/',
            '/(\n|^)\/\/(.*?)(\n|$)/',
            '/\n/',
            '/\<\!--.*?-->/',
            '/(\x20+|\t)/', # Delete multispace (Without \n)
            '/\>\s+\</', # strip whitespaces between tags
            '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
            '/=\s+(\"|\')/'); # strip whitespaces between = "'

        $replace = array(
            "\n",
            "\n",
            " ",
            "",
            " ",
            "><",
            "$1>",
            "=$1");

        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }
    ob_start("sanitize_output");
?>

<!-- Start HTML codes -->
<!DOCTYPE html>
<html>
  <head>
    <title>HTML Minifier</title>
  </head>
  <body>
  </body>
</html>
<!-- End HTML codes -->

<?php ob_end_flush(); ?>
