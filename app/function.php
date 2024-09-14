<?php
function alert($msg, $type = "danger")
{
    return "<P class = \"alert alert-$type d-flex justify-content-between\">$msg <button class 
    = \" btn-close\" data-bs-dismiss = \"alert\"></button> </P>";
};

function old($v_name)
{

    return $_POST["$v_name"] ?? "";
};
function reset_data()
{

    return $_POST = [];
};
