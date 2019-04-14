<?php
function isAdmin($value)
{
    return $value?"Admin":'Regular user';
}

function status($value)
{
    return $value?"Active":'Deactive';
}

function phone($value)
{
    return $value??'Not Set';
}
