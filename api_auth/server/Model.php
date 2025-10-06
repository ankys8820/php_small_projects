<?php
include_once './db.php';

// for subscribe
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['crud_req']=='signup')
    signup($conn);

// for logout
if($_SERVER['REQUEST_METHOD'] == "GET")
    logout($conn);


// for update
if($_SERVER['REQUEST_METHOD'] == "PATCH")
    update($conn);

// UNSUBSCRIBE

if($_SERVER['REQUEST_METHOD'] == "DELETE")
    unSubscribe($conn);

// for login
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['crud_req']=='login')
    login($conn);



function signup($conn){
    echo "welcome to signup";
}
function login($conn){}
function logout($conn){}
function update($conn){}
function unSubscribe($conn){}

