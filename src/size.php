<?php
require_once('workflows.php');

class Size extends Workflows
{
    public function calculate($chars)
    {
        $querystring = preg_split('/\s+/', trim(stripslashes($chars)));
        $oper = $querystring[0];
        $argNum = count($querystring);
        if ($argNum != 2) {
            $this->result('0', 'null', $title, $detail, 'tip.png');
            return $this->toxml();
        }

        $v = $querystring[1];
        $k = 0;

        switch ($oper) {
            case 'b':
                $k = $v/1024;
                break;
            case 'k':
                $k = $v;
                break;
            case 'm':
                $k = $v*1024;
                break;
            case 'g':
                $k = $v*1024*1024;
                break;
            default:
                $this->notice();
                break;
        }

        $b = $k*1024;
        $this->result(0, "null", $b."B", "", '');
        $this->result(1, "null", $k."K", "", '');
        $m = $k/1024;
        $this->result(2, "null", $m."M", "", '');
        $g = $m/1024;                
        $this->result(3, "null", $g."G", "", '');
        
        if (count($this->results())>0) {
            return $this->toxml();
        }
    }
}