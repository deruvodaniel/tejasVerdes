<?php  

class data {
    public $status;
    public $message;

    public function updateStatus($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

}