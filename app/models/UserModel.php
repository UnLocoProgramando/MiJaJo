<?php
require_once 'Model.php';

class UserModel extends Model {
    protected static $table = 'users';
    protected static $primary_key = 'user_id'; // The primary key of the model

}
