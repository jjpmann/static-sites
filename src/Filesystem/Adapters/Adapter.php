<?php

namespace StaticSites\Filesystem\Adapters;

class Adapter
{
    protected $config;

    public function __construct($config = null)
    {
        $this->config = $config;
    }

    public function validate()
    {
        if (!isset($this->config['type']) && $this->config['type'] == $this->type) {
            throw new AdapterException('Error Processing Request', 1);
        }

        // if ($this->type == 'sftp') {
        //     echo "<pre>".__FILE__.'<br>'.__METHOD__.' : '.__LINE__."<br><br>"; var_dump( $this->required, $this->config ); exit;

        // }

        foreach ($this->required as $r) {
            if (is_array($r) && $this->oneRequired($r)) {
                continue;
            }

            if (!$this->settings($r)) {
                throw new AdapterException('Missing Required Fields', 1);
            }
        }

        //$this->driverValidate();

        return true;
    }

    protected function oneRequired($items)
    {
        $count = collect($items)->filter(function ($item) {
            return $this->settings($item);
        })->count();

        if ($count == 0) {
            throw new AdapterException('Missing Required Fields', 1);
        }

        return true;
    }

    protected function settings($var, $default = false)
    {
        return isset($this->config[$var]) ? $this->config[$var] : $default;
    }
}
