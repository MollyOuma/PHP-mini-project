<?php
$temp =new test();
echo "test A:" . test::$static_property . "<br>";
echo "test B: " . $temp->get_sp();
echo "<br>";
echo "test C: " . $TEMP->static_property . "<br>";

class trait_exists{
    static$static_property="im static";
    function get_sp()
    {
        return self::$static_property;
    }
}
?>