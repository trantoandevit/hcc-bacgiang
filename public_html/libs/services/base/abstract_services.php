<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



abstract class abstract_services {
    abstract protected function member_list();
    abstract protected function synthesis($begin_date,$end_date,$member_code);
    abstract protected function lookup_record_by_id($record_id);
    abstract protected function send_internet_record();
    abstract protected function guide();
    abstract protected function lookup_record($record_status, $record_code, $member_code, $receive_from, $receive_to, $name, $page, $row_per_page);
    abstract protected function spec($member_code);
    abstract protected function record_type($unit_code, $spec_code);
}