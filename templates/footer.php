<?php
/*
 * File: footer.php
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 27-Jan-2016 00:35:03
 * 
 * Purpose: footer template - copyright etc.
 * 
 * Modification History:
 * 
 */
?>
<?php

function auto_copyright($year = 'auto') { ?>
    <?php
    if (intval($year) == 'auto') {
        $year = date('Y');
    }
    ?>
    <?php
    if (intval($year) == date('Y')) {
        echo intval($year);
    }
    ?>
    <?php
    if (intval($year) < date('Y')) {
        echo intval($year) . ' - ' . date('Y');
    }
    ?>
    <?php
    if (intval($year) > date('Y')) {
        echo date('Y');
    }
    ?>
<?php } ?>
<footer>
    Copyright &copy; <?php auto_copyright(); ?> Computer Solutions
</footer>
</div>
</body>
</html>


