<?php
function isAdmin($value)
{
    return $value?"Admin":'Regular user';
}

function status($value)
{
    return $value?"Active":'Deactive';
}

function isVerified($value)
{
    return $value?"Verified":'Unverified';
}

function paymentType($value)
{
    return $value?"Bank":'Cash';
}

function phone($value)
{
    return $value??'Not Set';
}
