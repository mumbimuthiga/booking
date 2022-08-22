<?php

function getCrossFieldValue($table, $reffering_field, $reffering_value, $required_field, $operator = "=")
{

    $ci = get_instance();
    $sql_statement =  "SELECT $required_field FROM $table WHERE $reffering_field  LIKE '$reffering_value' ORDER BY id DESC LIMIT 1";
    $query = $ci->db->query($sql_statement);

    if ($query->num_rows()===1)
    {
        $res = $query->result_array();
        return $res[0][$required_field];
    }
    else {
        return  "";
    }

}

function getCrossFieldValueMultiple($table, $reffering_fields, $reffering_values, $required_field, $operators = "=")
{


    $ref_string = "";
    for($x =0; $x < count($reffering_fields); $x++)
    {
        // foreach
        $ref_string .= $reffering_fields[$x]." ".$operators[$x]." '".$reffering_values[$x]."' ";
        $ref_string .= " AND ";
    }

    if ($ref_string !=="")
    {
        $ref_string = substr($ref_string, 0, strlen($ref_string)- 5);
        $ref_string = " WHERE ".$ref_string;
    }


    $ci = get_instance();
    $sql_statement =  "SELECT $required_field FROM $table $ref_string ORDER BY id DESC LIMIT 1";

//    echo "<strong>$sql_statement</strong>";

    $query = $ci->db->query($sql_statement);

    if ($query->num_rows()===1)
    {
        $res = $query->result_array();
        return $res[0][$required_field];
    }
    else {
        return  "";
    }

}
function get_user_email($user_id)
{
    $ci = get_instance();
    $query = "SELECT * FROM web_users WHERE id='$user_id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->email;
    }else{
        return false;
    }

}
function get_user_fullname($user_id)
{
    $ci = get_instance();
    $query = "SELECT * FROM web_users WHERE id='$user_id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->first_name.' '.$result->surname;
    }else{
        return false;
    }

}
function get_user_id($user_id)
{
    $ci = get_instance();
    $query = "SELECT * FROM web_users WHERE id_user='$user_id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->id;
    }else{
        return false;
    }

}
//Dashboard Items
function countbookings($user_id)
{

    $ci = get_instance();
    $sql_query = "SELECT * FROM services WHERE user_id ='$user_id' ORDER by id ASC ";
    $query = $ci->db->query($sql_query);
    return $query->num_rows();
}
function countbookings_admin()
{

    $ci = get_instance();
    $sql_query = "SELECT * FROM services  ORDER by id ASC ";
    $query = $ci->db->query($sql_query);
    return $query->num_rows();
}
function countnotifications($user_id)
{

    $ci = get_instance();
    $sql_query = "SELECT * FROM notifications WHERE role ='$user_id' ORDER by id ASC ";
    $query = $ci->db->query($sql_query);
    return $query->num_rows();
}
function get_status_name($id)
{
    $ci = get_instance();
    $query = "SELECT * FROM booking_status WHERE id='$id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->status;
    }else{
        return false;
    }

}
function get_service_name($id)
{
    $ci = get_instance();
    $query = "SELECT * FROM available_services WHERE id='$id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->service_name;
    }else{
        return false;
    }

}
function get_service_desc($id)
{
    $ci = get_instance();
    $query = "SELECT * FROM available_services WHERE id='$id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->description;
    }else{
        return false;
    }

}
function get_service_venue($id)
{
    $ci = get_instance();
    $query = "SELECT * FROM available_services WHERE id='$id'";
    $result = $ci->db->query($query)->row();
    if (!empty($result)){
        return $result->venue ;
    }else{
        return false;
    }

}
function get_role_name_fron_role_id($user_id)
{

    return get_any_table_field("id" , $user_id,"role_name", "roles ");

}
function get_current_user_logged_in()
{

    $ci = get_instance();
    $web_user_session = $ci->session->userdata('web_user_session');
    return $web_user_session["id_user"];


}
function get_role($id)
{
    return get_any_table_field("id_user" , $id,"role", "web_users");
}




function getWebUserFullDetails($id)
{
    $ci = get_instance();
    $sql_statement = "SELECT * FROM web_users WHERE id='$id' ";
    $query = $ci->db->query($sql_statement);
    return $query->result_array();
}














function get_global_option($option_name)
{

    return get_any_table_field("option_name" , $option_name,"option_value", "global_options");

}











function get_any_table_field($ref_field, $ref_value , $field_requiered, $table, $operator ="LIKE")
{
    /*
Description: Function to get any table field by using the id
Date Created: 2021-08-02
Created By: George G Mbatia
Email: mbatiagithaiga@gmail.com
Notes:
    */
    $ci = get_instance();
    $query = "SELECT $field_requiered FROM $table WHERE $ref_field  $operator '$ref_value' ORDER BY id DESC LIMIT 1 ";
    //   echo "<h1>".$query."</h1>";


    $result = $ci->db->query($query);

    try {
        if ($result) {
            $res = "";
            foreach ($result->result_array() as $r) {
                $res = $r[$field_requiered];
            }
            return $res;
        }
        else
        {
            return null;
        }
    }
    catch (Exception $e)
    {
        return $e->getMessage();
    }

}
function get_module_name($module_id)
{
    return get_any_table_field("id" , $module_id,"module_name", "modules");
}

function get_user_group_name($group_id)
{
    return get_any_table_field("id" , $group_id,"group_name", "user_groups");
}
function get_all_table_fields($ref_field, $ref_value , $field_requiered, $table, $operator ="LIKE")
{
    /*
Description: Function to get any table field by using the id
Date Created: 2021-08-02
Created By: George G Mbatia
Email: mbatiagithaiga@gmail.com
Notes:
    */
    $ci = get_instance();
    $query = "SELECT $field_requiered FROM $table WHERE $ref_field  $operator '$ref_value'";
    //   echo "<h1>".$query."</h1>";

    $result = $ci->db->query($query);

    try {
        if ($result) {
            $res = "";
            foreach ($result->result_array() as $r) {
                $res = $r[$field_requiered];
            }
            return $res;
        }
        else
        {
            return null;
        }
    }
    catch (Exception $e)
    {
        return $e->getMessage();
    }

}
?>